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

        <!-- Custom Styles -->
        <style>
            @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }
            @keyframes slideIn { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
            .float { animation: float 6s ease-in-out infinite; }
            .slide-in { animation: slideIn 0.6s ease-out; }
            .warm-gradient { background: linear-gradient(135deg, #f1c40f 0%, #f39c12 25%, #e67e22 75%, #d35400 100%); }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-text-dark antialiased bg-gradient-to-br from-bg-light to-white">
        
        <!-- Background Elements -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary rounded-full mix-blend-multiply filter blur-xl opacity-10 animate-pulse"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-secondary rounded-full mix-blend-multiply filter blur-xl opacity-10 animate-pulse"></div>
        </div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative z-10">
            
            <!-- Logo Section -->
            <div class="float mb-8">
                <a href="{{ route('welcome') }}" class="flex flex-col items-center">
                    <div class="w-20 h-20 warm-gradient rounded-2xl flex items-center justify-center shadow-xl">
                        <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                    <div class="mt-3 text-center">
                        <h1 class="text-xl font-bold text-text-dark">Sistema Laravel</h1>
                        <p class="text-sm text-text-light">Por Marcelo Logan</p>
                    </div>
                </a>
            </div>

            <!-- Form Container -->
            <div class="w-full sm:max-w-md px-6 py-8 bg-white/80 backdrop-blur-lg shadow-2xl overflow-hidden sm:rounded-2xl border border-white/20 slide-in">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <div class="mt-8 text-center">
                <p class="text-sm text-text-light">
                    CodeIgniter → Laravel em 30h • 
                    <span class="text-link font-semibold">Migração Completa</span>
                </p>
            </div>
        </div>
    </body>
</html>