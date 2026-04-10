{{-- resources/views/send/preview.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Vista previa</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-7xl mx-auto bg-white rounded-xl shadow p-6">

        <h1 class="text-2xl font-bold text-gray-800 mb-2">
            Vista previa de datos
        </h1>
        
        <p class="text-sm text-gray-600 mb-4">
            Tipo de envío: <strong>{{ $mailTypes[$mail_type] ?? $mail_type }}</strong>
        </p>

        <!-- Resumen -->
        <div class="mb-4 p-3 bg-blue-50 rounded-lg">
            <p class="text-sm text-blue-800">
                📊 Total de registros: <strong>{{ count($alumnos) }}</strong> | 
                ✅ Válidos: <strong>{{ collect($alumnos)->where('estado', 'ok')->count() }}</strong> |
                ❌ Inválidos: <strong>{{ collect($alumnos)->where('estado', 'error')->count() }}</strong>
            </p>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        {{-- Mostrar dinámicamente todas las columnas disponibles --}}
                        @php
                            // Obtener todas las keys del primer registro (excepto 'estado' si quieres)
                            $columns = !empty($alumnos) ? array_keys($alumnos[0]) : [];
                        @endphp
                        
                        @foreach($columns as $column)
                            <th class="px-3 py-2 border font-semibold text-gray-700">
                                {{$column}}
                            </th>
                        @endforeach
                        
                        {{-- Columna adicional para estado --}}
                        <th class="px-3 py-2 border bg-gray-200">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alumnos as $index => $alumno)
                        <tr class="hover:bg-gray-50">
                            {{-- Mostrar dinámicamente todos los campos --}}
                            @foreach($columns as $column)
                                <td class="px-3 py-2 border">
                                    {{-- Truncar texto largo si es necesario --}}
                                    @php
                                        $value = $alumno[$column] ?? '—';
                                        $displayValue = strlen($value) > 50 ? substr($value, 0, 50) . '...' : $value;
                                    @endphp
                                    
                                    @if($column === 'email' || $column === 'moodle')
                                        <span class="text-blue-600">{{ $displayValue }}</span>
                                    @else
                                        {{ $displayValue }}
                                    @endif
                                </td>
                            @endforeach
                            
                            {{-- Estado --}}
                            <td class="px-3 py-2 border text-center">
                                @if($alumno['estado'] === 'ok')
                                    <span class="inline-flex items-center gap-1 text-green-600 font-semibold">
                                        <span>✓</span> Válido
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 text-red-600 font-semibold">
                                        <span>✗</span> 
                                        @if(isset($alumno['error_reason']))
                                            {{ $alumno['error_reason'] }}
                                        @else
                                            Inválido
                                        @endif
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Si no hay datos -->
        @if(empty($alumnos))
            <div class="text-center py-8 text-gray-500">
                No se encontraron datos para mostrar.
            </div>
        @endif

        <div class="mt-6 flex justify-between items-center">
            <a href="{{ route('send.index') }}"
               class="px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 text-gray-700 transition">
                ← Cancelar
            </a>

            @if(!empty($alumnos) && collect($alumnos)->where('estado', 'ok')->count() > 0)
                <form method="POST" action="{{ route('send.mails') }}" class="inline">
                    @csrf
                    <input type="hidden" name="mail_type" value="{{ $mail_type }}">
                    
                    {{-- Enviar todos los datos de los alumnos --}}
                    @foreach($alumnos as $index => $alumno)
                        @foreach($alumno as $key => $value)
                            <input type="hidden" name="alumnos[{{ $index }}][{{ $key }}]" value="{{ $value }}">
                        @endforeach
                    @endforeach
                    
                    <button type="submit"
                            class="px-6 py-2 rounded bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">
                        Confirmar y enviar ({{ collect($alumnos)->where('estado', 'ok')->count() }} correos)
                    </button>
                </form>
            @else
                <button disabled
                        class="px-6 py-2 rounded bg-gray-400 text-white font-semibold cursor-not-allowed">
                    No hay correos válidos para enviar
                </button>
            @endif
        </div>

    </div>

</body>
</html>