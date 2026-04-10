<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Envío de correos institucionales</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-xl bg-white rounded-xl shadow-lg p-8">
        
        <!-- TÍTULO -->
        <div class="mb-6 text-center">
            <h1 class="text-2xl font-bold text-gray-800">
                Envío de correos institucionales
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Carga un archivo CSV para enviar credenciales a los alumnos
            </p>
        </div>

        <!-- MENSAJES -->
        @if (session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-700 text-sm">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 p-3 rounded bg-red-100 text-red-700 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORMULARIO -->
        <form action="{{ route('send.import') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div>
    <label class="block text-sm font-medium text-gray-700 mb-1">
        Tipo de envío
    </label>
    <select name="mail_type" required
        class="block w-full border border-gray-300 rounded-lg px-3 py-2 text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="">— Selecciona un tipo —</option>
        @foreach ($mailTypes as $key => $label)
            <option value="{{ $key }}">{{ $label }}</option>
        @endforeach
    </select>
</div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Archivo CSV
                </label>

                <input 
                    type="file" 
                    name="archivo" 
                    accept=".csv"
                    required
                    class="block w-full text-sm text-gray-600
                           file:mr-4 file:py-2 file:px-4
                           file:rounded-lg file:border-0
                           file:text-sm file:font-semibold
                           file:bg-blue-50 file:text-blue-700
                           hover:file:bg-blue-100
                           border border-gray-300 rounded-lg cursor-pointer"
                >

                <p class="text-xs text-gray-400 mt-1">
                    Formato esperado: CSV con número de control y datos institucionales
                </p>
            </div>

            <!-- BOTÓN -->
            <div class="flex justify-end">
                <button 
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition"
                >
                    Procesar archivo
                </button>
            </div>
        </form>

        <!-- FOOTER -->
        <div class="mt-6 text-xs text-gray-400 text-center">
            Sistema local • Educación a Distancia
        </div>

    </div>

</body>
</html>
