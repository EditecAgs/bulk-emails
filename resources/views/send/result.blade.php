<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviando correos | MailMaster</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen flex items-center justify-center p-4 sm:p-6">

<div class="w-full max-w-2xl mx-auto fade-in">
    
    <!-- Logo / Brand -->
    <div class="text-center mb-6">
        <div class="inline-flex items-center justify-center w-14 h-14 bg-white rounded-2xl shadow-md mb-3">
            <svg class="w-7 h-7" style="color: var(--tec-blue);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
        </div>
        <h1 class="text-2xl font-bold" style="color: var(--tec-text);">
            Envío de correos
        </h1>
        <p class="text-sm mt-1" style="color: var(--tec-text-light);">
            Sistema de envío masivo • Educación a Distancia
        </p>
    </div>

    <!-- Main Card -->
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        
        <!-- Header -->
        <div class="px-6 sm:px-8 pt-6 pb-4 border-b" style="border-color: var(--tec-gray-border);">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background-color: var(--tec-blue);">
                    <svg class="w-5 h-5 text-white animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-semibold" style="color: var(--tec-text);">
                        Procesando envío
                    </h2>
                    <p class="text-xs" style="color: var(--tec-text-light);">
                        Por favor, no cierres esta ventana
                    </p>
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="px-6 sm:px-8 py-8">
            
            <!-- Circular Progress (Alternativa visual) -->
            <div class="flex justify-center mb-6">
                <div class="relative inline-flex items-center justify-center">
                    <svg class="w-32 h-32 transform -rotate-90">
                        <circle cx="64" cy="64" r="58" fill="none" stroke="var(--tec-gray-border)" stroke-width="6"/>
                        <circle id="progress-ring" cx="64" cy="64" r="58" fill="none" 
                                stroke="var(--tec-blue)" stroke-width="6" stroke-linecap="round"
                                stroke-dasharray="364.4" stroke-dashoffset="364.4"/>
                    </svg>
                    <div class="absolute text-center">
                        <span id="progress-percent" class="text-2xl font-bold" style="color: var(--tec-blue);">0%</span>
                    </div>
                </div>
            </div>

            <!-- Barra de progreso (estilo tradicional) -->
            <div class="mb-4">
                <div class="flex justify-between text-xs mb-1" style="color: var(--tec-text-light);">
                    <span>Progreso general</span>
                    <span id="progress-count">0 / 0</span>
                </div>
                <div class="w-full rounded-full h-2 overflow-hidden" style="background-color: var(--tec-gray-border);">
                    <div id="progress-bar" class="h-2 transition-all duration-500 rounded-full" style="width: 0%; background-color: var(--tec-blue);"></div>
                </div>
            </div>

            <!-- Estado actual -->
            <div class="text-center mb-6">
                <p id="progress-text" class="text-sm font-medium" style="color: var(--tec-text);">
                    Preparando envío...
                </p>
                <p id="status-detail" class="text-xs mt-1" style="color: var(--tec-text-light);">
                    Inicializando sistema...
                </p>
            </div>

            <!-- Log de eventos -->
            <div class="rounded-xl overflow-hidden border" style="border-color: var(--tec-gray-border); background-color: var(--tec-gray-bg);">
                <div class="px-4 py-2 border-b flex items-center gap-2" style="border-color: var(--tec-gray-border); background-color: white;">
                    <svg class="w-4 h-4" style="color: var(--tec-text-light);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <span class="text-xs font-medium" style="color: var(--tec-text-light);">BITÁCORA DE ENVÍO</span>
                </div>
                <div id="log-container" class="log-container p-3 max-h-64 overflow-y-auto">
                    <ul id="log" class="space-y-1 text-xs">
                        <li class="text-gray-400 italic">Esperando inicio del envío...</li>
                    </ul>
                </div>
            </div>

            <!-- Finalizado -->
            <div id="finished" class="hidden mt-6 text-center fade-in">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-green-100 mb-3">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <p class="font-semibold text-green-600 mb-2">
                    ✅ Envío finalizado correctamente
                </p>
                <p class="text-xs mb-4" style="color: var(--tec-text-light);">
                    Se han enviado todos los correos exitosamente
                </p>
                <a href="{{ route('send.index') }}"
                   class="inline-flex items-center gap-2 px-5 py-2 rounded-xl text-sm font-medium transition-all"
                   style="background-color: var(--tec-blue); color: white;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Volver al inicio
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-6 sm:px-8 py-3 border-t" style="background-color: var(--tec-gray-bg); border-color: var(--tec-gray-border);">
            <div class="flex justify-center gap-4 text-xs" style="color: var(--tec-text-light);">
                <span class="flex items-center gap-1">
                    <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                    Enviados
                </span>
                <span class="flex items-center gap-1">
                    <span class="w-2 h-2 bg-red-500 rounded-full"></span>
                    Errores
                </span>
                <span class="flex items-center gap-1">
                    <span class="w-2 h-2 bg-gray-300 rounded-full"></span>
                    Pendientes
                </span>
            </div>
        </div>
    </div>
</div>

<script>
    const bar = document.getElementById('progress-bar');
    const text = document.getElementById('progress-text');
    const statusDetail = document.getElementById('status-detail');
    const logList = document.getElementById('log');
    const finished = document.getElementById('finished');
    const progressCount = document.getElementById('progress-count');
    const progressPercent = document.getElementById('progress-percent');
    const progressRing = document.getElementById('progress-ring');
    
    let lastLogCount = 0;
    const circumference = 364.4;

    function updateProgressRing(percent) {
        const offset = circumference - (percent / 100) * circumference;
        progressRing.style.strokeDashoffset = offset;
    }

    function addLogItem(item) {
        const li = document.createElement('li');
        li.className = `flex items-start gap-2 p-1.5 rounded-lg text-xs ${
            item.status === 'ok' 
                ? 'text-green-700 bg-green-50' 
                : 'text-red-700 bg-red-50'
        }`;
        
        const icon = item.status === 'ok' ? '✓' : '✗';
        const time = new Date().toLocaleTimeString('es-MX', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        
        li.innerHTML = `
            <span class="flex-shrink-0 font-bold">${icon}</span>
            <span class="flex-1">
                <span class="font-mono text-gray-500">[${time}]</span>
                <span class="font-medium">[${item.username}]</span> 
                <span>${item.message}</span>
            </span>
        `;
        
        logList.appendChild(li);
        li.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    const interval = setInterval(async () => {
        try {
            const response = await fetch('{{ route('send.progress') }}');
            const data = await response.json();

            if (data.total === 0) {
                text.textContent = 'No hay correos para enviar.';
                statusDetail.textContent = 'No se encontraron correos en la cola';
                clearInterval(interval);
                return;
            }

            const percent = Math.round((data.sent / data.total) * 100);
            const pending = data.total - data.sent;
            const errors = data.log.filter(l => l.status === 'error').length;

            // Actualizar UI
            bar.style.width = percent + '%';
            progressPercent.textContent = percent + '%';
            progressCount.textContent = `${data.sent} / ${data.total}`;
            text.textContent = `Enviando correos (${percent}% completado)`;
            statusDetail.innerHTML = `
                <span class="text-green-600">✓ ${data.sent} enviados</span> • 
                <span class="text-red-600">✗ ${errors} errores</span> • 
                <span class="text-gray-400">⏳ ${pending} pendientes</span>
            `;
            
            updateProgressRing(percent);

            // Agregar nuevos logs
            if (data.log.length > lastLogCount) {
                const nuevos = data.log.slice(lastLogCount);
                nuevos.forEach(item => addLogItem(item));
                lastLogCount = data.log.length;
            }

            // Finalizar
            if (data.sent >= data.total) {
                clearInterval(interval);
                setTimeout(() => {
                    finished.classList.remove('hidden');
                    text.classList.add('hidden');
                    statusDetail.classList.add('hidden');
                }, 500);
            }
        } catch (error) {
            console.error('Error fetching progress:', error);
            statusDetail.textContent = 'Error al obtener el progreso. Verifica la conexión.';
        }
    }, 1500);
</script>

</body>
</html>