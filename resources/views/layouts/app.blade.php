<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    

    <!-- Custom Select2 Theme -->
    <style>
        .select2-container--default .select2-selection--single {
            height: 42px !important;
            padding: 8px 12px !important;
            border: 1px solid #d1d5db !important;
            border-radius: 6px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 24px !important;
            padding-left: 0 !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px !important;
        }

        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 1px #3b82f6 !important;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
    <!-- jQuery (necessário para Select2) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @stack('scripts')
    <!-- Modais Globais -->
    <!-- Modal de Confirmação -->
    <div id="confirmModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-md mx-4">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-medium text-gray-900" id="confirmTitle">Confirmar Ação</h3>
                </div>
            </div>
            <div class="mt-2">
                <p class="text-sm text-gray-500" id="confirmMessage">Tem certeza que deseja realizar esta ação?</p>
            </div>
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" onclick="closeModal('confirmModal')"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                    Cancelar
                </button>
                <button type="button" id="confirmButton"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Confirmar
                </button>
            </div>
        </div>
    </div>

    <!-- Modal de Alerta -->
    <div id="alertModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-lg p-6 max-w-md mx-4">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-lg font-medium text-gray-900" id="alertTitle">Atenção</h3>
                </div>
            </div>
            <div class="mt-2">
                <p class="text-sm text-gray-500" id="alertMessage">Mensagem de alerta</p>
            </div>
            <div class="mt-6 flex justify-end">
                <button type="button" onclick="closeModal('alertModal')"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    OK
                </button>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>

</html>
