{{-- resources/views/send/preview.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista previa | MailMaster</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
</head>
<body style="background: linear-gradient(135deg, #f0f2f5 0%, #e8ecf1 100%);" class="min-h-screen p-4 sm:p-6">

    <div class="max-w-[95vw] mx-auto">
        
        <!-- Header con breadcrumb -->
        <div class="mb-6 flex items-center justify-between flex-wrap gap-4">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center shadow-sm" style="background-color: var(--tec-blue);">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-bold" style="color: var(--tec-text);">
                            Vista previa de datos
                        </h1>
                        <div class="flex items-center gap-2 mt-1">
                            <span class="text-xs text-gray-400">📂 Revisión</span>
                            <span class="text-gray-300">•</span>
                            <span class="text-xs" style="color: var(--tec-text-light);">Tipo de envío: <strong style="color: var(--tec-blue);">{{ $mailTypes[$mail_type] ?? $mail_type }}</strong></span>
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('send.index') }}" class="text-sm flex items-center gap-1 transition-colors" style="color: var(--tec-text-light);">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver al inicio
            </a>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            
            <!-- Resumen Estadístico -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 p-6 border-b" style="background-color: var(--tec-gray-bg); border-color: var(--tec-gray-border);">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                        <svg class="w-5 h-5" style="color: var(--tec-blue);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wide" style="color: var(--tec-text-light);">Total de registros</p>
                        <p class="text-2xl font-bold" style="color: var(--tec-text);">{{ count($alumnos) }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wide" style="color: var(--tec-text-light);">Válidos</p>
                        <p class="text-2xl font-bold text-green-600">{{ collect($alumnos)->where('estado', 'ok')->count() }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wide" style="color: var(--tec-text-light);">Inválidos</p>
                        <p class="text-2xl font-bold text-red-600">{{ collect($alumnos)->where('estado', 'error')->count() }}</p>
                    </div>
                </div>
            </div>

            <!-- Tabla de datos -->
            <div class="table-container overflow-x-auto p-4">
                <table class="min-w-full border-collapse">
                    <thead>
                        <tr style="background-color: var(--tec-gray-bg);">
                            @php
                                $columns = !empty($alumnos) ? array_keys($alumnos[0]) : [];
                                // Filtrar columnas que no queremos mostrar
                                $hiddenColumns = ['estado', 'error_reason'];
                                $displayColumns = array_filter($columns, fn($col) => !in_array($col, $hiddenColumns));
                            @endphp
                            
                            @foreach($displayColumns as $column)
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="color: var(--tec-text-light); border-bottom: 2px solid var(--tec-gray-border);">
                                    {{ ucfirst(str_replace('_', ' ', $column)) }}
                                </th>
                            @endforeach
                            <th class="px-4 py-3 text-center text-xs font-semibold uppercase tracking-wider" style="color: var(--tec-text-light); border-bottom: 2px solid var(--tec-gray-border);">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($alumnos as $index => $alumno)
                            <tr class="hover:bg-gray-50 transition-colors {{ $alumno['estado'] === 'error' ? 'bg-red-50/30' : '' }}">
                                @foreach($displayColumns as $column)
                                    <td class="px-4 py-3 text-sm border-b" style="border-color: var(--tec-gray-border); color: var(--tec-text);">
                                        @php
                                            $value = $alumno[$column] ?? '—';
                                            $displayValue = strlen($value) > 60 ? substr($value, 0, 60) . '...' : $value;
                                        @endphp
                                        
                                        @if(str_contains($column, 'email') || str_contains($column, 'mail') || $column === 'moodle')
                                            <a href="mailto:{{ $value }}" class="hover:underline" style="color: var(--tec-blue);">
                                                {{ $displayValue }}
                                            </a>
                                        @elseif($column === 'monto')
                                            <span class="font-semibold">${{ number_format(floatval($value), 2) }}</span>
                                        @elseif($column === 'fecha_limite' || $column === 'Fecha limite')
                                            <span class="text-amber-600">
                                                {{ \Carbon\Carbon::parse($value)->format('d/m/Y') }}
                                            </span>
                                        @else
                                            {{ $displayValue }}
                                        @endif
                                    </td>
                                @endforeach
                                
                                {{-- Estado --}}
                                <td class="px-4 py-3 text-center border-b" style="border-color: var(--tec-gray-border);">
                                    @if($alumno['estado'] === 'ok')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700 status-badge">
                                            <span class="w-1.5 h-1.5 bg-green-600 rounded-full"></span>
                                            Válido
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700 status-badge" title="{{ $alumno['error_reason'] ?? 'Error desconocido' }}">
                                            <span class="w-1.5 h-1.5 bg-red-600 rounded-full"></span>
                                            {{ strlen($alumno['error_reason'] ?? 'Inválido') > 30 ? substr($alumno['error_reason'], 0, 30) . '...' : ($alumno['error_reason'] ?? 'Inválido') }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ count($displayColumns) + 1 }}" class="text-center py-12 text-gray-400">
                                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <p>No se encontraron datos para mostrar</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Footer con acciones -->
            <div class="px-6 py-4 border-t flex flex-col sm:flex-row justify-between items-center gap-4" style="background-color: var(--tec-gray-bg); border-color: var(--tec-gray-border);">
                <div class="text-sm" style="color: var(--tec-text-light);">
                    <span class="font-medium">ℹ️ Información:</span> Solo los registros <span class="text-green-600 font-medium">válidos</span> serán enviados
                </div>
                
                <div class="flex gap-3">
                    <a href="{{ route('send.index') }}"
                       class="btn-secondary px-5 py-2 rounded-xl text-sm font-medium transition-all inline-flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancelar
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
                                    class="btn-primary px-6 py-2 rounded-xl text-white font-semibold transition-all inline-flex items-center gap-2 shadow-md hover:shadow-lg transform hover:scale-[1.02] active:scale-[0.98]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Confirmar y enviar ({{ collect($alumnos)->where('estado', 'ok')->count() }} correos)
                            </button>
                        </form>
                    @else
                        <button disabled
                                class="px-6 py-2 rounded-xl bg-gray-300 text-gray-500 font-semibold cursor-not-allowed inline-flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            No hay correos válidos
                        </button>
                    @endif
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6">
            <p class="text-gray-400 text-xs">
                Instituto Tecnológico de Aguascalientes • Educación a Distancia
            </p>
        </div>
    </div>

</body>
</html>