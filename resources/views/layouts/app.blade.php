<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistema Laravel') }} - Marcelo Logan</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <!-- Tailwind Config com Nossa Paleta -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#f1c40f',
                        'primary-dark': '#f39c12',
                        'secondary': '#e67e22',
                        'secondary-dark': '#d35400',
                        'bg-light': '#ecf0f1',
                        'link': '#3498db',
                        'text-dark': '#2d3436',
                        'text-light': '#636e72'
                    }
                }
            }
        }
    </script>

    <!-- Custom Select2 Theme + Animações -->
    <style>
        /* Select2 Customizado */
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
            border-color: #f1c40f !important;
            box-shadow: 0 0 0 1px #f1c40f !important;
        }

        /* Animações */
        @keyframes slideIn { 
            from { opacity: 0; transform: translateY(20px); } 
            to { opacity: 1; transform: translateY(0); } 
        }
        @keyframes fadeIn { 
            from { opacity: 0; } 
            to { opacity: 1; } 
        }
        .slide-in { animation: slideIn 0.5s ease-out; }
        .fade-in { animation: fadeIn 0.3s ease-out; }
        
        /* Gradiente Quente */
        .warm-gradient { 
            background: linear-gradient(135deg, #f1c40f 0%, #f39c12 25%, #e67e22 75%, #d35400 100%); 
        }

        /* Hover Effects */
        .hover-lift:hover {
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-bg-light text-text-dark">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow-lg border-b-4 border-primary">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 slide-in">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Alerts Section -->
        @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
            <div class="bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-xl flex items-center slide-in hover-lift">
                <svg class="w-6 h-6 mr-3 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
            <div class="bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-xl flex items-center slide-in hover-lift">
                <svg class="w-6 h-6 mr-3 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('error') }}
            </div>
        </div>
        @endif

        <!-- Page Content -->
        <main class="fade-in">
            {{ $slot }}
        </main>
    </div>

    <!-- jQuery (necessário para Select2) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Modais Globais -->
    <!-- Modal de Confirmação -->
    <div id="confirmModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 max-w-md mx-4 shadow-2xl border border-primary/20 slide-in">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-primary/20 rounded-full flex items-center justify-center">
                        <svg class="h-6 w-6 text-primary-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-text-dark" id="confirmTitle">Confirmar Ação</h3>
                </div>
            </div>
            <div class="mt-2">
                <p class="text-sm text-text-light" id="confirmMessage">Tem certeza que deseja realizar esta ação?</p>
            </div>
            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" onclick="closeModal('confirmModal')"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded-lg transition-colors">
                    Cancelar
                </button>
                <button type="button" id="confirmButton"
                    class="warm-gradient hover:opacity-90 text-white font-semibold py-2 px-6 rounded-lg transition-all">
                    Confirmar
                </button>
            </div>
        </div>
    </div>

    <!-- Modal de Alerta -->
    <div id="alertModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 max-w-md mx-4 shadow-2xl border border-red-200 slide-in">
            <div class="flex items-center mb-4">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-text-dark" id="alertTitle">Atenção</h3>
                </div>
            </div>
            <div class="mt-2">
                <p class="text-sm text-text-light" id="alertMessage">Mensagem de alerta</p>
            </div>
            <div class="mt-6 flex justify-end">
                <button type="button" onclick="closeModal('alertModal')"
                    class="bg-link hover:bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg transition-colors">
                    OK
                </button>
            </div>
        </div>
    </div>

    <script>
        // Auto-hide alerts
        setTimeout(() => {
            const alerts = document.querySelectorAll('[class*="bg-green-50"], [class*="bg-red-50"]');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>

    @stack('scripts')
</body>

</html>