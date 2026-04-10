<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Envío de correos</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-6">

<div class="max-w-3xl w-full bg-white rounded-xl shadow p-6">

    <h1 class="text-2xl font-bold text-gray-800 mb-2 text-center">
        Envío de correos institucionales
    </h1>

    <p class="text-sm text-gray-600 text-center mb-6">
        El sistema está enviando los correos en segundo plano.  
        No cierres esta ventana.
    </p>

    {{-- BARRA DE PROGRESO --}}
    <div class="w-full bg-gray-200 rounded-full h-4 overflow-hidden mb-3">
        <div
            id="progress-bar"
            class="h-4 bg-blue-600 transition-all duration-500"
            style="width: 0%">
        </div>
    </div>

    <p id="progress-text" class="text-sm text-center text-gray-700 mb-4">
        Preparando envío…
    </p>

    {{-- LOG --}}
    <div class="border rounded bg-gray-50 p-3 max-h-64 overflow-y-auto text-sm">
        <ul id="log"></ul>
    </div>

    {{-- FINAL --}}
    <div id="finished" class="hidden mt-6 text-center">
        <p class="text-green-600 font-semibold mb-4">
            ✅ Envío finalizado correctamente
        </p>

        <a href="{{ route('send.index') }}"
           class="inline-block px-6 py-2 rounded bg-gray-200 hover:bg-gray-300 text-gray-700">
            Volver al inicio
        </a>
    </div>

</div>

<script>
    const bar = document.getElementById('progress-bar');
    const text = document.getElementById('progress-text');
    const logList = document.getElementById('log');
    const finished = document.getElementById('finished');

    let lastLogCount = 0;

    const interval = setInterval(async () => {
        const response = await fetch('{{ route('send.progress') }}');
        const data = await response.json();

        if (data.total === 0) {
            text.textContent = 'No hay correos para enviar.';
            clearInterval(interval);
            return;
        }

        const percent = Math.round((data.sent / data.total) * 100);

        bar.style.width = percent + '%';
        text.textContent = `Enviados ${data.sent} de ${data.total} correos (${percent}%)`;

        // Pintar nuevos logs
        if (data.log.length > lastLogCount) {
            const nuevos = data.log.slice(lastLogCount);

            nuevos.forEach(item => {
                const li = document.createElement('li');
                li.className = item.status === 'ok'
                    ? 'text-green-700'
                    : 'text-red-700';

                li.textContent = `[${item.username}] ${item.message}`;
                logList.appendChild(li);
            });

            lastLogCount = data.log.length;
        }

        if (data.sent >= data.total) {
            clearInterval(interval);
            finished.classList.remove('hidden');
            text.classList.add('hidden');
        }
    }, 1500);
</script>

</body>
</html>
