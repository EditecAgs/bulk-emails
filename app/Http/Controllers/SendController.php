<?php

namespace App\Http\Controllers;

use App\Jobs\SendGenericMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SendController extends Controller
{
    public function index()
    {
        return view('send.index');
    }

    public function getHeaders(Request $request)
    {
        $request->validate([
            'archivo' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('archivo');
        $handle = fopen($file->getRealPath(), 'r');

        $cleanString = function($str) {
            $str = preg_replace('/^\xEF\xBB\xBF/', '', $str);
            $str = preg_replace('/[\x00-\x1F\x7F-\x9F]/u', '', $str);
            return trim($str);
        };

        $headers = fgetcsv($handle);
        fclose($handle);

        if (!$headers) {
            return response()->json(['error' => 'El archivo CSV está vacío o es inválido.'], 400);
        }

        $headers = array_map($cleanString, $headers);

        // Limpiar comillas si las tienen
        $headers = array_map(function($header) {
            return trim($header, '"');
        }, $headers);

        return response()->json([
            'headers' => $headers,
            'count' => count($headers)
        ]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'archivo' => 'required|file|mimes:csv,txt',
            'subject' => 'required|string|max:255',
            'html' => 'required|string',
        ]);

        // Leer CSV
        $file = $request->file('archivo');
        $handle = fopen($file->getRealPath(), 'r');

        $cleanString = function($str) {
            $str = preg_replace('/^\xEF\xBB\xBF/', '', $str);
            $str = preg_replace('/[\x00-\x1F\x7F-\x9F]/u', '', $str);
            return trim($str);
        };

        // Leer encabezados
        $headers = fgetcsv($handle);
        if (!$headers) {
            fclose($handle);
            return back()->withErrors(['archivo' => 'El archivo CSV está vacío o es inválido.']);
        }

        $headers = array_map($cleanString, $headers);
        
        // Detectar columna de email
        $emailColumn = $this->detectEmailColumn($headers);
        if (!$emailColumn) {
            fclose($handle);
            return back()->withErrors(['archivo' => 'No se encontró una columna de email']);
        }

        // Leer datos
        $alumnos = [];
        while (($row = fgetcsv($handle)) !== false) {
            $row = array_map($cleanString, $row);
            $data = [];
            foreach ($headers as $index => $header) {
                $data[$header] = $row[$index] ?? '';
            }

            // Validar email
            $email = $data[$emailColumn] ?? '';
            if (empty($email)) {
                $data['estado'] = 'error';
                $data['error_reason'] = 'Email vacío';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['estado'] = 'error';
                $data['error_reason'] = 'Email inválido: ' . $email;
            } else {
                $data['estado'] = 'ok';
            }

            $alumnos[] = $data;
        }
        fclose($handle);

        if (empty($alumnos)) {
            return back()->withErrors(['archivo' => 'No se encontraron datos en el archivo.']);
        }

        // Guardar en sesión
        session([
            'alumnos' => $alumnos,
            'subject_template' => $request->subject,
            'html_template' => $request->html,
            'email_column' => $emailColumn,
        ]);

        return view('send.preview', [
            'alumnos' => $alumnos,
            'email_column' => $emailColumn,
            'subject_template' => $request->subject,
            'html_template' => $request->html,
        ]);
    }

    public function sendMails(Request $request)
    {
        $alumnos = session('alumnos', []);
        $subjectTemplate = session('subject_template', '');
        $htmlTemplate = session('html_template', '');
        $emailColumn = session('email_column', '');

        if (empty($alumnos)) {
            return redirect()->route('send.index')->withErrors(['general' => 'No hay datos para enviar.']);
        }

        $validos = collect($alumnos)
            ->filter(fn($a) => ($a['estado'] ?? '') === 'ok')
            ->values();

        if ($validos->isEmpty()) {
            return back()->withErrors(['general' => 'No hay destinatarios válidos.']);
        }

        Cache::put('mail_total', $validos->count());
        Cache::put('mail_sent', 0);
        Cache::put('mail_log', []);

        $delay = 0;
        foreach ($validos as $alumno) {
            $recipientEmail = $alumno[$emailColumn] ?? '';
            if (empty($recipientEmail)) {
                $this->appendLogImmediate('unknown', 'error', 'Email destino vacío');
                Cache::increment('mail_sent');
                continue;
            }

            // Renderizar asunto con los datos del alumno
            $subject = $this->renderTemplate($subjectTemplate, $alumno);
            $label = $this->getLabel($alumno, $emailColumn);

            SendGenericMail::dispatch(
                $recipientEmail,
                $label,
                $subject,      
                $htmlTemplate,   
                $alumno          
            )->delay(now()->addSeconds($delay));

            $delay += 5;
        }

        return view('send.result');
    }

    private function renderTemplate(string $template, array $data): string
    {
        foreach ($data as $key => $value) {
            $template = preg_replace('/\{\{\s*' . preg_quote($key, '/') . '\s*\}\}/', $value, $template);
        }
        return $template;
    }

    private function detectEmailColumn(array $headers): ?string
    {
        $keywords = ['email', 'correo', 'mail'];
        foreach ($headers as $col) {
            $colLower = strtolower($col);
            if (in_array($colLower, $keywords)) {
                return $col;
            }
        }
        foreach ($headers as $col) {
            $colLower = strtolower($col);
            if (str_contains($colLower, 'email') || str_contains($colLower, 'correo') || str_contains($colLower, 'mail')) {
                return $col;
            }
        }
        return null;
    }

    private function getLabel(array $data, string $emailColumn): string
    {
        $nameColumns = ['nombre', 'name', 'nombres', 'fullname', 'nombre_completo'];
        foreach ($nameColumns as $col) {
            if (isset($data[$col]) && !empty($data[$col])) {
                return $data[$col];
            }
        }
        foreach ($data as $key => $value) {
            if (str_contains(strtolower($key), 'nombre') || str_contains(strtolower($key), 'name')) {
                if (!empty($value)) {
                    return $value;
                }
            }
        }
        return $data[$emailColumn] ?? 'unknown';
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

    public function progress()
    {
        return response()->json([
            'total' => Cache::get('mail_total', 0),
            'sent'  => Cache::get('mail_sent', 0),
            'log'   => Cache::get('mail_log', []),
        ]);
    }
}