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
                    
                    <!-- Mensajes de error/success -->
                    @if (session('success'))
                        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200">
                            <span class="text-green-700 text-sm">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200">
                            <ul class="text-red-600 text-sm list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('send.import') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                        @csrf
                        
                        <!-- Paso 1: Seleccionar o crear plantilla -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold mb-2" style="color: var(--tec-text);">
                                📁 Paso 1: Plantilla
                            </label>
                            
                            <div class="flex gap-3">
                                <select id="template-select" class="flex-1 px-4 py-2.5 rounded-xl border focus:ring-2 focus:ring-blue-500 focus:border-transparent" style="border-color: var(--tec-gray-border);">
                                    <option value="">-- Seleccionar plantilla --</option>
                                    <option value="new">+ Crear nueva plantilla</option>
                                    @foreach($templates as $template)
                                        <option value="{{ $template->id }}" data-subject="{{ $template->subject }}" data-html="{{ $template->html }}">
                                            {{ $template->name }} @if($template->is_default) (por defecto) @endif
                                        </option>
                                    @endforeach
                                </select>
                                
                                <button type="button" id="delete-template-btn" class="px-4 py-2.5 bg-red-500 text-white rounded-xl hover:bg-red-600 transition-colors hidden" title="Eliminar plantilla">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Paso 2: Asunto -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold mb-2" style="color: var(--tec-text);">
                                📝 Paso 2: Asunto del correo <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="subject" id="subjectInput" required
                                class="w-full px-4 py-2.5 rounded-xl border focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Ej: Hola @{{ nombre }}, bienvenido al curso" style="border-color: var(--tec-gray-border);">
                        </div>

                        <!-- Paso 3: HTML de la plantilla -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold mb-2" style="color: var(--tec-text);">
                                📄 Paso 3: Plantilla HTML <span class="text-red-500">*</span>
                            </label>
                            <p class="text-xs mb-2" style="color: var(--tec-text-light);">
                                💡 Usa @{{ variable }} para insertar datos del CSV. Ej: @{{ nombre }}, @{{ email }}
                            </p>
                            
                            <textarea name="html" id="htmlEditor" rows="15" required
                                class="w-full px-4 py-2.5 rounded-xl border font-mono text-sm"
                                style="border-color: var(--tec-gray-border); font-family: 'Courier New', monospace;"
                                placeholder="Pega aquí tu código HTML completo..."></textarea>
                            
                            <!-- Botón para guardar plantilla -->
                            <div class="mt-3 flex justify-end">
                                <button type="button" id="save-template-btn" class="px-4 py-2 bg-green-500 text-white rounded-xl hover:bg-green-600 transition-colors text-sm flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                    </svg>
                                    Guardar como plantilla
                                </button>
                            </div>
                        </div>

                        <!-- Variables disponibles -->
                        <div id="variables-container" class="mb-6 hidden">
                            <div class="p-4 rounded-xl" style="background-color: var(--tec-gray-bg); border: 1px solid var(--tec-gray-border);">
                                <div class="flex items-center gap-2 mb-2">
                                    <svg class="w-5 h-5" style="color: var(--tec-blue);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-sm font-semibold" style="color: var(--tec-text);">
                                        📊 Variables disponibles:
                                    </span>
                                </div>
                                <div id="variables-list" class="flex flex-wrap gap-2">
                                    <span class="text-xs text-gray-400">(Sube un archivo CSV para ver las variables)</span>
                                </div>
                                <p class="text-xs mt-2" style="color: var(--tec-text-light);">
                                    💡 Usa @{{ variable }} en el asunto y en el HTML para insertar datos del CSV
                                </p>
                            </div>
                        </div>

                        <!-- Archivo CSV -->
                        <div class="mb-6">
                            <label class="block text-sm font-semibold mb-2" style="color: var(--tec-text);">
                                📂 Paso 4: Archivo CSV <span class="text-red-500">*</span>
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
                                    CSV hasta 10MB • Debe contener una columna de email
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
            </div>
        </div>
    </div>

    <script>
        // ============================================
        // 1. DRAG & DROP
        // ============================================
        const dropZone = document.getElementById('dropZone');
        const fileInput = document.getElementById('fileInput');
        const fileNameSpan = document.getElementById('fileName');
        const submitBtn = document.getElementById('submitBtn');
        const form = document.getElementById('uploadForm');

        // ============================================
        // 2. EDITORES ACTIVOS 
        // ============================================
        let activeEditor = null;
        const subjectInput = document.getElementById('subjectInput');
        const htmlEditor = document.getElementById('htmlEditor');

        // Detectar qué campo tiene el foco
        subjectInput.addEventListener('focus', () => activeEditor = subjectInput);
        htmlEditor.addEventListener('focus', () => activeEditor = htmlEditor);
        
        // También permitir click fuera de los campos
        document.addEventListener('click', (e) => {
            if (e.target !== subjectInput && e.target !== htmlEditor) {
                // No desactivamos activeEditor para permitir múltiples inserciones
            }
        });

        // ============================================
        // 3. OBTENER HEADERS DEL CSV (vía AJAX)
        // ============================================
        function getCSVHeaders(file) {
            const formData = new FormData();
            formData.append('archivo', file);
            formData.append('_token', document.querySelector('input[name="_token"]').value);

            fetch('{{ route("send.headers") }}', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error('Error:', data.error);
                    alert('Error al leer el CSV: ' + data.error);
                    return;
                }
                
                if (data.headers && data.headers.length > 0) {
                    showVariables(data.headers);
                } else {
                    alert('No se detectaron columnas en el CSV');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al procesar el archivo CSV');
            });
        }

    
        function showVariables(columns) {
            const container = document.getElementById('variables-container');
            const list = document.getElementById('variables-list');
            
            // Limpiar columnas
            columns = columns
                .map(c => c.trim().replace(/^"|"$/g, ''))
                .filter(c => c !== '');
            
            if (columns.length === 0) {
                container.classList.remove('hidden');
                list.innerHTML = '<span class="text-xs text-red-500">No se detectaron columnas en el CSV</span>';
                return;
            }
            
            container.classList.remove('hidden');
            list.innerHTML = '';
            
            columns.forEach(col => {
                // Crear la variable con template literal (ESCAPADA para Blade)
                const variable = '@{{ ' + col + ' }}';
                
                const badge = document.createElement('button');
                badge.type = "button";
                badge.className = 'inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 px-3 py-1.5 rounded-full text-xs font-mono hover:bg-blue-100 cursor-pointer transition-colors border border-blue-200';
                
                // Icono y nombre - Usando template literal correctamente escapado
                badge.innerHTML = `
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    ${variable}
                `;
                
                // Título - Usando concatenación para evitar problemas con Blade
                badge.title = 'Haz clic para insertar {{' + col + '}}';
                
                badge.addEventListener('click', function(e) {
                    e.preventDefault();
                    insertVariable(variable);
                });
                
                list.appendChild(badge);
            });
            
            // Mostrar indicador de inserción
            const infoBadge = document.createElement('span');
            infoBadge.className = 'text-xs text-gray-400 ml-2';
            infoBadge.textContent = '📌 Haz clic en una variable para insertarla donde esté el cursor';
            list.appendChild(infoBadge);
        }

        // ============================================
        // 5. INSERTAR VARIABLE EN EL EDITOR ACTIVO
        // ============================================
        function insertVariable(variable) {
            // Si hay un editor activo, insertar ahí
            if (activeEditor) {
                const start = activeEditor.selectionStart;
                const end = activeEditor.selectionEnd;
                
                // Insertar en la posición del cursor
                activeEditor.value = 
                    activeEditor.value.substring(0, start) +
                    variable +
                    activeEditor.value.substring(end);
                
                // Mantener el foco
                activeEditor.focus();
                
                // Colocar el cursor después de la variable insertada
                const newPosition = start + variable.length;
                activeEditor.selectionStart = activeEditor.selectionEnd = newPosition;
                
                // Feedback visual
                showInsertFeedback(activeEditor);
                
                return;
            }
            
            // Si no hay editor activo, copiar al portapapeles
            navigator.clipboard.writeText(variable).then(() => {
                showToast('✅ Copiado: ' + variable);
            }).catch(() => {
                // Fallback
                const textarea = document.createElement('textarea');
                textarea.value = variable;
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand('copy');
                document.body.removeChild(textarea);
                showToast('✅ Copiado: ' + variable);
            });
        }

        // ============================================
        // 6. FEEDBACK VISUAL
        // ============================================
        function showInsertFeedback(element) {
            const originalBg = element.style.background;
            element.style.background = '#d1fae5';
            element.style.transition = 'background 0.3s';
            setTimeout(() => {
                element.style.background = originalBg;
            }, 500);
        }

        function showToast(message) {
            // Crear toast temporal
            const toast = document.createElement('div');
            toast.className = 'fixed bottom-4 right-4 bg-gray-800 text-white px-4 py-2 rounded-lg text-sm shadow-lg z-50';
            toast.textContent = message;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transition = 'opacity 0.5s';
                setTimeout(() => document.body.removeChild(toast), 500);
            }, 2000);
        }

        // ============================================
        // 7. DRAG & DROP EVENTS
        // ============================================
        dropZone.addEventListener('click', () => fileInput.click());

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('drag-over');
            dropZone.style.borderColor = '#0b5ed7';
        });

        dropZone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            dropZone.classList.remove('drag-over');
            dropZone.style.borderColor = '';
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('drag-over');
            dropZone.style.borderColor = '';
            const files = e.dataTransfer.files;
            if (files.length > 0 && files[0].name.endsWith('.csv')) {
                fileInput.files = files;
                getCSVHeaders(files[0]);
                updateFileName(files[0].name);
            } else {
                fileNameSpan.innerHTML = '<span class="text-red-500">Archivo no válido</span>';
                setTimeout(() => updateFileName(null), 2000);
            }
        });

        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                getCSVHeaders(e.target.files[0]);
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

        // ============================================
        // 8. VALIDACIÓN DEL FORMULARIO
        // ============================================
        form.addEventListener('submit', (e) => {
            if (!fileInput.files.length) {
                e.preventDefault();
                alert('Por favor selecciona un archivo CSV');
                return;
            }
            
            const subject = document.querySelector('input[name="subject"]');
            if (!subject.value.trim()) {
                e.preventDefault();
                alert('Por favor escribe un asunto');
                return;
            }
            
            const html = document.querySelector('textarea[name="html"]');
            if (!html.value.trim()) {
                e.preventDefault();
                alert('Por favor pega el código HTML de la plantilla');
                return;
            }
        });

        // ============================================
        // 9. INICIALIZACIÓN
        // ============================================
        updateFileName(null);
        
        console.log('📧 Sistema de envío masivo listo');
        console.log('💡 Sube un CSV para ver las variables disponibles');

        // ============================================
        // 10. MANEJO DE PLANTILLAS
        // ============================================

        const templateSelect = document.getElementById('template-select');
        const deleteTemplateBtn = document.getElementById('delete-template-btn');

        // Cargar plantilla al seleccionar
        templateSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const value = this.value;
            
            if (value === '') {
                // Seleccionar plantilla
                subjectInput.value = '';
                htmlEditor.value = '';
                deleteTemplateBtn.classList.add('hidden');
                return;
            }
            
            if (value === 'new') {
                // Crear nueva plantilla
                subjectInput.value = '';
                htmlEditor.value = '';
                deleteTemplateBtn.classList.add('hidden');
                subjectInput.focus();
                return;
            }
            
            // Cargar plantilla existente
            const subject = selectedOption.dataset.subject || '';
            const html = selectedOption.dataset.html || '';
            
            subjectInput.value = subject;
            htmlEditor.value = html;
            deleteTemplateBtn.classList.remove('hidden');
            
            // Mostrar feedback
            showToast('✅ Plantilla cargada: ' + selectedOption.textContent);
        });

        // Guardar plantilla
        document.getElementById('save-template-btn').addEventListener('click', function() {
            const name = prompt('Nombre de la nueva plantilla:');
            if (!name || name.trim() === '') {
                alert('El nombre de la plantilla es obligatorio.');
                return;
            }
            
            const subject = subjectInput.value.trim();
            const html = htmlEditor.value.trim();
            
            if (!subject || !html) {
                alert('El asunto y el HTML son obligatorios para guardar la plantilla.');
                return;
            }
            
            // Enviar al servidor
            fetch('{{ url("/templates/store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({
                    name: name.trim(),
                    subject: subject,
                    html: html
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('✅ Plantilla guardada: ' + name.trim());
                    
                    // Agregar al select
                    const option = document.createElement('option');
                    option.value = data.template.id;
                    option.textContent = data.template.name;
                    option.dataset.subject = data.template.subject;
                    option.dataset.html = data.template.html;
                    templateSelect.insertBefore(option, templateSelect.lastChild);
                    templateSelect.value = data.template.id;
                    deleteTemplateBtn.classList.remove('hidden');
                    
                    // Recargar página para actualizar la lista
                    setTimeout(() => location.reload(), 1000);
                } else {
                    alert('Error al guardar: ' + (data.message || 'Error desconocido'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al guardar la plantilla.');
            });
        });

        // Eliminar plantilla
        deleteTemplateBtn.addEventListener('click', function() {
            const selectedOption = templateSelect.options[templateSelect.selectedIndex];
            const templateId = templateSelect.value;
            const templateName = selectedOption.textContent;
            
            if (!templateId || templateId === 'new') {
                return;
            }
            
            if (!confirm('¿Estás seguro de eliminar la plantilla "' + templateName + '"?')) {
                return;
            }
            
            
            fetch('{{ url("/templates") }}/' + templateId, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('✅ Plantilla eliminada');
                    selectedOption.remove();
                    templateSelect.value = '';
                    subjectInput.value = '';
                    htmlEditor.value = '';
                    deleteTemplateBtn.classList.add('hidden');
                } else {
                    alert('Error al eliminar: ' + (data.error || 'Error desconocido'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al eliminar la plantilla.');
            });
        });
    </script>
</body>
</html>