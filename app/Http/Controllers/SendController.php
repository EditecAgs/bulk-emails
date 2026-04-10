<?php
// app/Http/Controllers/SendController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendGenericMail;
use App\Services\MailTypeRegistry;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendController extends Controller
{
    public function index()
    {
        return view('send.index', [
            'mailTypes' => MailTypeRegistry::options(),
        ]);
    }

public function import(Request $request)
{
    $request->validate([
        'archivo'   => 'required|file|mimes:csv,txt',
        'mail_type' => 'required|string',
    ]);

    $type = MailTypeRegistry::get($request->mail_type);
    
    if (!$type) {
        return back()->withErrors(['mail_type' => 'Tipo de envío no válido.']);
    }

    // Leer CSV
    $file = $request->file('archivo');
    $handle = fopen($file->getRealPath(), 'r');
    
    // 🔥 FUNCIÓN PARA LIMPIAR CARACTERES INVISIBLES
    $cleanString = function($str) {
        $str = preg_replace('/^\xEF\xBB\xBF/', '', $str);
        $str = preg_replace('/[\x00-\x1F\x7F-\x9F]/u', '', $str);
        $str = trim($str);
        return $str;
    };
    
    // Leer encabezados
    $headers = fgetcsv($handle);
    
    if (!$headers) {
        return back()->withErrors(['archivo' => 'El archivo CSV está vacío o es inválido.']);
    }
    
    // Limpiar encabezados
    $headers = array_map($cleanString, $headers);
    $headersLower = array_map('strtolower', $headers);
    
    // 🔥 IMPORTANTE: Normalizar las columnas esperadas a minúsculas
    $expectedColumns = array_map('strtolower', $type['columns']);
    
    // 🔥 Verificar columnas faltantes (solo para este tipo de envío)
    $missingColumns = array_diff($expectedColumns, $headersLower);
    
    if (!empty($missingColumns)) {
        fclose($handle);
        return back()->withErrors([
            'archivo' => 'El archivo no contiene las columnas requeridas: ' . implode(', ', $missingColumns) . 
                        '. Columnas detectadas: ' . implode(', ', $headers)
        ]);
    }
    
    $alumnos = [];
    $rowNumber = 1;
    
    while (($row = fgetcsv($handle)) !== false) {
        $rowNumber++;
        
        // Limpiar valores
        $row = array_map($cleanString, $row);
        
        // Crear array asociativo
        $data = [];
        foreach ($headers as $index => $header) {
            $value = $row[$index] ?? '';
            $data[$header] = $value;
        }
        
        // También crear versión en minúsculas para validación
        $dataLower = [];
        foreach ($headersLower as $index => $headerLower) {
            $dataLower[$headerLower] = $row[$index] ?? '';
        }
        
        // Verificar columnas vacías
        $hasEmptyRequired = false;
        foreach ($expectedColumns as $col) {
            if (empty($dataLower[$col])) {
                $hasEmptyRequired = true;
                $data['error_reason'] = "Columna '{$col}' está vacía en fila {$rowNumber}";
                break;
            }
        }
        
        if ($hasEmptyRequired) {
            $data['estado'] = 'error';
            $alumnos[] = $data;
            continue;
        }
        
        // 🔥 VALIDACIÓN SEGÚN EL TIPO DE ENVÍO
        if ($type['recipient'] === 'moodle') {
            // Para activación M365 - buscar en Moodle
            $username = $dataLower['username'] ?? '';
            $userMoodle = $this->getUserMoodle($username);
            
            if ($userMoodle && isset($userMoodle['email'])) {
                $data['moodle'] = $userMoodle['email'];
                $data['estado'] = 'ok';
            } else {
                $data['estado'] = 'error';
                $data['error_reason'] = 'Usuario no encontrado en Moodle: ' . $username;
            }
        } else {
            // Para otros tipos (recordatorio_pago, bienvenida, etc.)
            $recipientKey = strtolower($type['recipient']);
            $recipientEmail = $dataLower[$recipientKey] ?? '';
            
            if (empty($recipientEmail)) {
                $data['estado'] = 'error';
                $data['error_reason'] = 'Email vacío';
            } elseif (!filter_var($recipientEmail, FILTER_VALIDATE_EMAIL)) {
                $data['estado'] = 'error';
                $data['error_reason'] = 'Email inválido: ' . $recipientEmail;
            } else {
                $data['estado'] = 'ok';
            }
        }
        
        $alumnos[] = $data;
    }
    
    fclose($handle);
    
    if (empty($alumnos)) {
        return back()->withErrors(['archivo' => 'No se encontraron datos válidos en el archivo.']);
    }
    
    return view('send.preview', [
        'alumnos'    => $alumnos,
        'mail_type'  => $request->mail_type,
        'mailTypes'  => MailTypeRegistry::options(),
    ]);
}
    public function send(Request $request)
    {
        $request->validate([
            'alumnos'   => 'required|array',
            'mail_type' => 'required|string',
        ]);

        $type = MailTypeRegistry::get($request->mail_type);
        
        if (!$type) {
            return back()->withErrors(['mail_type' => 'Tipo de envío no válido.']);
        }

        // Filtrar solo los que tienen estado 'ok'
        $validos = collect($request->alumnos)
            ->filter(fn($alumno) => ($alumno['estado'] ?? '') === 'ok')
            ->values();

        if ($validos->isEmpty()) {
            return back()->withErrors(['general' => 'No hay destinatarios válidos para enviar correos.']);
        }

        // Inicializar cache para el progreso
        Cache::put('mail_total', $validos->count());
        Cache::put('mail_sent', 0);
        Cache::put('mail_log', []);

        // Disparar jobs
        $delay = 0;
        
        foreach ($validos as $alumno) {
            // Obtener el email del destinatario
            $recipientEmail = $type['recipient'] === 'moodle' 
                ? ($alumno['moodle'] ?? '') 
                : ($alumno[$type['recipient']] ?? '');
            
            if (empty($recipientEmail)) {
                $this->appendLogImmediate($alumno[$type['label_col']] ?? 'unknown', 'error', 'Email de destino vacío');
                Cache::increment('mail_sent');
                continue;
            }
            
            SendGenericMail::dispatch(
                recipientEmail: $recipientEmail,
                recipientLabel: $alumno[$type['label_col']] ?? $recipientEmail,
                subject: $type['subject'],
                view: $type['view'],
                data: ($type['data_map'])($alumno),
            )->delay(now()->addSeconds($delay));
            
            $delay += 5; // 5 segundos entre correos para no saturar
        }

        return view('send.result');
    }

    public function progress()
    {
        return response()->json([
            'total' => Cache::get('mail_total', 0),
            'sent'  => Cache::get('mail_sent', 0),
            'log'   => Cache::get('mail_log', []),
        ]);
    }

    private function getUserMoodle(string $username): ?array
    {
        try {
            $response = Http::withoutVerifying()
                ->timeout(10)
                ->get(config('services.moodle.url') . '/webservice/rest/server.php', [
                    'wstoken' => config('services.moodle.token'),
                    'wsfunction' => 'core_user_get_users_by_field',
                    'moodlewsrestformat' => 'json',
                    'field' => 'username',
                    'values[0]' => $username,
                ]);

            if (!$response->failed() && !empty($response->json())) {
                return $response->json()[0];
            }
        } catch (\Exception $e) {
            Log::error("Error al consultar Moodle: {$e->getMessage()}");
        }

        return null;
    }
    
    private function appendLogImmediate(string $username, string $status, string $message): void
    {
        $log = Cache::get('mail_log', []);
        $log[] = [
            'username' => $username,
            'status' => $status,
            'message' => $message,
        ];
        Cache::put('mail_log', $log);
    }
}