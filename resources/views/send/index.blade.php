<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Envío Masivo | TecNM Aguascalientes</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen">

    <div class="min-h-screen flex items-center justify-center p-4 sm:p-6">
        
        <!-- Main Card -->
        <div class="w-full max-w-2xl">
            
            <!-- Logo / Brand -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-[#0a2463] rounded-2xl shadow-md mb-4">
                    <img src="{{asset('pictures/logo_ead_white.png')}}" alt="TecNM Logo" class="w-12 h-12 object-contain" >
                </div>
                <h1 class="text-3xl sm:text-4xl font-bold" style="color: var(--tec-blue);">
                    Sistema de Envío Masivo
                </h1>
                <p class="text-gray-500 text-sm sm:text-base mt-2">
                    Coordinación de Educación a Distancia
                </p>
            </div>

            <!-- Form Card -->
            <div class="bg-white rounded-2xl shadow-xl card-hover overflow-hidden border border-gray-100">
                
                <!-- Card Header -->
                <div class="px-6 sm:px-8 pt-8 pb-4 border-b" style="border-color: var(--tec-gray-border);">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background-color: var(--tec-blue);">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold" style="color: var(--tec-text);">
                                Nuevo envío de correos
                            </h2>
                            <p class="text-sm" style="color: var(--tec-text-light);">
                                Complete los datos para comenzar
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Card Body -->
                <div class="px-6 sm:px-8 py-6">
                    
                    <!-- Mensajes -->
                    @if (session('success'))
                        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200">
                            <div class="flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-green-700 text-sm">{{ session('success') }}</span>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200">
                            <div class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-red-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <p class="text-red-700 font-medium text-sm mb-1">Errores:</p>
                                    <ul class="text-red-600 text-sm list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('send.import') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                        @csrf
                        
                        <!-- Tipo de envío -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold mb-2" style="color: var(--tec-text);">
                                Tipo de envío
                            </label>
                            <select name="mail_type" required
                                class="w-full px-4 py-2.5 rounded-xl border text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 cursor-pointer"
                                style="background-color: var(--tec-gray-bg); border-color: var(--tec-gray-border); color: var(--tec-text);">
                                <option value="" disabled selected>— Selecciona un tipo —</option>
                                @foreach ($mailTypes as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Archivo CSV -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold mb-2" style="color: var(--tec-text);">
                                Archivo CSV
                            </label>
                            
                            <div id="dropZone" 
                                 class="file-drop-zone border-2 border-dashed rounded-xl p-6 text-center cursor-pointer transition-all duration-200"
                                 style="border-color: var(--tec-gray-border); background-color: var(--tec-gray-bg);">
                                <input type="file" name="archivo" id="fileInput" accept=".csv" class="hidden" required>
                                
                                <svg class="w-10 h-10 mx-auto mb-3" style="color: var(--tec-text-light);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                                
                                <p class="text-sm mb-1" style="color: var(--tec-text);">
                                    <span id="fileName" class="font-medium" style="color: var(--tec-blue);">Haz clic o arrastra</span> tu archivo CSV
                                </p>
                                <p class="text-xs" style="color: var(--tec-text-light);">
                                    CSV hasta 10MB • Columnas según tipo seleccionado
                                </p>
                            </div>
                        </div>

                        <!-- Botón de envío -->
                        <div class="flex justify-end pt-2">
                            <button type="submit" id="submitBtn"
                                class="group relative inline-flex items-center gap-2 px-6 py-2.5 text-white font-semibold rounded-xl shadow-md hover:shadow-lg transform transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed disabled:hover:scale-100 btn-primary">
                                <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                                Procesar archivo
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Card Footer -->
                <div class="px-6 sm:px-8 py-4 rounded-b-2xl" style="background-color: var(--tec-gray-bg); border-top: 1px solid var(--tec-gray-border);">
                    <div class="flex flex-wrap items-center justify-between gap-3 text-xs" style="color: var(--tec-text-light);">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Soporta archivos CSV con codificación UTF-8</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <span>Envío seguro y progresivo</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center mt-8">
                <p class="text-gray-500 text-xs">
                    Instituto Tecnológico de Aguascalientes • Educación a Distancia
                </p>
            </div>
        </div>
    </div>

    <script>
        // Drag & Drop functionality (igual que antes)
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('fileInput');
        const fileNameSpan = document.getElementById('fileName');
        const submitBtn = document.getElementById('submitBtn');
        const form = document.getElementById('uploadForm');

        // ... (mantén aquí todo el código JavaScript de drag & drop y validaciones que ya funcionaba) ...
        dropZone.addEventListener('click', () => fileInput.click());

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('drag-over');
        });

        dropZone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            dropZone.classList.remove('drag-over');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('drag-over');
            const files = e.dataTransfer.files;
            if (files.length > 0 && files[0].name.endsWith('.csv')) {
                fileInput.files = files;
                updateFileName(files[0].name);
            } else {
                fileNameSpan.innerHTML = '<span class="text-red-500">Archivo no válido</span>';
                setTimeout(() => updateFileName(null), 2000);
            }
        });

        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                updateFileName(e.target.files[0].name);
            } else {
                updateFileName(null);
            }
        });

        function updateFileName(name) {
            if (name) {
                fileNameSpan.innerHTML = `<span class="text-green-600">✓ ${name}</span>`;
                submitBtn.disabled = false;
            } else {
                fileNameSpan.innerHTML = '<span style="color: var(--tec-blue);">Haz clic o arrastra</span>';
                submitBtn.disabled = true;
            }
        }

        form.addEventListener('submit', (e) => {
            const mailType = document.querySelector('select[name="mail_type"]').value;
            if (!mailType) {
                e.preventDefault();
                alert('Por favor selecciona un tipo de envío');
            } else if (!fileInput.files.length) {
                e.preventDefault();
                alert('Por favor selecciona un archivo CSV');
            }
        });

        updateFileName(null);
    </script>
</body>
</html>