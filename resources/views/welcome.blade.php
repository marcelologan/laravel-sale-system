<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Laravel - Marcelo Logan | CodeIgniter → Laravel em 30h</title>
    
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
    
    <!-- Custom animations -->
    <style>
        @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }
        @keyframes pulse-warm { 0%, 100% { box-shadow: 0 0 20px rgba(241, 196, 15, 0.4); } 50% { box-shadow: 0 0 40px rgba(241, 196, 15, 0.7); } }
        @keyframes gradient-shift { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
        .float { animation: float 6s ease-in-out infinite; }
        .pulse-warm { animation: pulse-warm 2s ease-in-out infinite; }
        .gradient-text { 
            background: linear-gradient(-45deg, #f1c40f, #f39c12, #e67e22, #d35400);
            background-size: 400% 400%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradient-shift 3s ease infinite;
        }
        .warm-gradient {
            background: linear-gradient(135deg, #f1c40f 0%, #f39c12 25%, #e67e22 75%, #d35400 100%);
        }
    </style>
</head>
<body class="bg-bg-light min-h-screen text-text-dark overflow-x-hidden">

    <!-- Animated Background Elements -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary rounded-full mix-blend-multiply filter blur-xl opacity-10 animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-secondary rounded-full mix-blend-multiply filter blur-xl opacity-10 animate-pulse"></div>
        <div class="absolute top-1/2 left-1/2 w-80 h-80 bg-primary-dark rounded-full mix-blend-multiply filter blur-xl opacity-10 animate-pulse"></div>
    </div>

    <div class="relative z-10">
        
        <!-- Hero Section -->
        <div class="container mx-auto px-6 py-20">
            
            <!-- Main Header -->
            <div class="text-center mb-20">
                <div class="float mb-8">
                    <div class="inline-block p-6 warm-gradient rounded-full pulse-warm">
                        <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                        </svg>
                    </div>
                </div>
                
                <h1 class="text-7xl font-black mb-6">
                    <span class="gradient-text">Sistema Laravel</span>
                </h1>
                
                <div class="text-2xl mb-6">
                    <span class="warm-gradient px-6 py-3 rounded-full text-white font-bold shadow-lg">
                        CodeIgniter → Laravel
                    </span>
                </div>
                
                <p class="text-xl text-text-dark mb-2">
                    Migração completa em <span class="text-secondary-dark font-bold text-2xl">30 horas</span>
                </p>
                
                <p class="text-lg text-text-light">
                    Por <span class="text-link font-semibold">Marcelo Logan</span> • Sistema de Vendas Completo
                </p>
            </div>

            <!-- Stats Dashboard -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-20">
                
                <!-- Card Produtos -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border-l-4 border-primary hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-primary/10 rounded-xl">
                            <svg class="w-8 h-8 text-primary-dark" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20 7h-3V6a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v1H0v2h3v9a4 4 0 0 0 4 4h10a4 4 0 0 0 4-4V9h3V7zM5 6a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1H5V6zm10 12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V9h10v9z"/>
                            </svg>
                        </div>
                        <a href="{{ route('produtos.index') }}" class="text-link hover:text-primary-dark transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                            </svg>
                        </a>
                    </div>
                    <h3 class="text-3xl font-bold text-text-dark mb-1">{{ \App\Models\Produto::count() }}</h3>
                    <p class="text-text-light text-sm font-medium">Produtos</p>
                </div>
                
                <!-- Card Clientes -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border-l-4 border-primary-dark hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-primary-dark/10 rounded-xl">
                            <svg class="w-8 h-8 text-primary-dark" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <a href="{{ route('clientes.index') }}" class="text-link hover:text-primary-dark transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                            </svg>
                        </a>
                    </div>
                    <h3 class="text-3xl font-bold text-text-dark mb-1">{{ \App\Models\Cliente::count() }}</h3>
                    <p class="text-text-light text-sm font-medium">Clientes</p>
                </div>
                
                <!-- Card Pedidos - DESTAQUE -->
                <div class="bg-white rounded-2xl p-6 shadow-xl border-l-4 border-secondary pulse-warm transform scale-105">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-secondary/10 rounded-xl">
                            <svg class="w-8 h-8 text-secondary-dark" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7 4V2C7 1.45 7.45 1 8 1H16C16.55 1 17 1.45 17 2V4H20C20.55 4 21 4.45 21 5S20.55 6 20 6H19V19C19 20.1 18.1 21 17 21H7C5.9 21 5 20.1 5 19V6H4C3.45 6 3 5.55 3 5S3.45 4 4 4H7ZM9 3V4H15V3H9ZM7 6V19H17V6H7Z"/>
                            </svg>
                        </div>
                        <a href="{{ route('pedidos.index') }}" class="text-link hover:text-secondary-dark transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                            </svg>
                        </a>
                    </div>
                    <h3 class="text-3xl font-bold text-text-dark mb-1">{{ \App\Models\Pedido::count() }}</h3>
                    <p class="text-text-light text-sm font-medium">Pedidos ⭐</p>
                </div>
                
                <!-- Card Categorias -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border-l-4 border-secondary hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-secondary/10 rounded-xl">
                            <svg class="w-8 h-8 text-secondary-dark" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <a href="{{ route('categorias.index') }}" class="text-link hover:text-secondary-dark transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                            </svg>
                        </a>
                    </div>
                    <h3 class="text-3xl font-bold text-text-dark mb-1">{{ \App\Models\Categoria::count() }}</h3>
                    <p class="text-text-light text-sm font-medium">Categorias</p>
                </div>
                
            </div>

            <!-- Features Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-20">
                
                <!-- Módulos -->
                <div class="bg-white rounded-3xl shadow-xl p-8 border border-primary/20">
                    <h2 class="text-3xl font-bold text-text-dark mb-6 flex items-center">
                        <div class="w-12 h-12 warm-gradient rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        Módulos Implementados
                    </h2>
                    
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-primary/5 rounded-xl border border-primary/20">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-primary/20 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-primary-dark" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <span class="font-semibold text-text-dark">Gestão de Produtos</span>
                            </div>
                            <a href="{{ route('produtos.index') }}" class="text-link hover:text-primary-dark transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                                </svg>
                            </a>
                        </div>
                        
                        <div class="flex items-center justify-between p-4 bg-primary-dark/5 rounded-xl border border-primary-dark/20">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-primary-dark/20 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-primary-dark" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <span class="font-semibold text-text-dark">Gestão de Clientes</span>
                            </div>
                            <a href="{{ route('clientes.index') }}" class="text-link hover:text-primary-dark transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                                </svg>
                            </a>
                        </div>
                        
                        <div class="flex items-center justify-between p-4 bg-secondary/5 rounded-xl border border-secondary/20">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-secondary/20 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-secondary-dark" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <span class="font-semibold text-text-dark">Gestão de Categorias</span>
                            </div>
                            <a href="{{ route('categorias.index') }}" class="text-link hover:text-secondary-dark transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                                </svg>
                            </a>
                        </div>
                        
                        <div class="flex items-center justify-between p-4 bg-secondary-dark/5 rounded-xl border-2 border-secondary-dark/30 pulse-warm">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-secondary-dark/20 rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-secondary-dark" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                    </svg>
                                </div>
                                <span class="font-bold text-text-dark">Sistema de Pedidos ⭐</span>
                            </div>
                            <a href="{{ route('pedidos.index') }}" class="text-link hover:text-secondary-dark transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Tecnologias -->
                <div class="bg-white rounded-3xl shadow-xl p-8 border border-secondary/20">
                    <h2 class="text-3xl font-bold text-text-dark mb-6 flex items-center">
                        <div class="w-12 h-12 warm-gradient rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                        </div>
                        Stack Tecnológico
                    </h2>
                    
                    <div class="grid grid-cols-2 gap-6">
                        <div class="text-center p-6 bg-red-50 rounded-2xl border border-red-200 group hover:bg-red-100 transition-colors">
                            <div class="w-16 h-16 mx-auto mb-4 bg-red-500/20 rounded-2xl flex items-center justify-center group-hover:bg-red-500/30 transition-all duration-300">
                                <svg class="w-10 h-10 text-red-600" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M23.642 5.43a.364.364 0 01.014.1v5.149c0 .135-.073.26-.189.326l-4.323 2.49v4.934a.378.378 0 01-.188.326L9.93 23.949a.316.316 0 01-.066.027c-.008.002-.016.008-.024.01a.348.348 0 01-.192 0c-.011-.002-.02-.008-.03-.012-.02-.008-.042-.014-.062-.025L.533 18.755a.376.376 0 01-.189-.326V2.974c0-.033.005-.066.014-.098.003-.012.01-.02.014-.032a.369.369 0 01.023-.058c.004-.013.015-.022.023-.033l.033-.045c.012-.01.025-.018.037-.027.014-.012.027-.024.041-.034H.53L5.043.05a.375.375 0 01.375 0L9.93 2.647h.002c.015.01.027.021.04.033.012.009.025.018.037.027.013.014.02.03.033.045.008.011.02.021.025.033.01.02.017.038.024.058.003.011.01.021.013.032.01.031.014.064.014.098v9.652l3.76-2.164V5.527c0-.033.004-.066.013-.098.003-.01.01-.02.013-.032a.487.487 0 01.024-.059c.007-.012.018-.02.025-.033.012-.015.021-.030.033-.043.012-.012.025-.02.037-.028.014-.011.026-.023.041-.032h.001l4.513-2.598a.375.375 0 01.375 0l4.513 2.598c.016.01.027.021.042.031.012.01.025.018.036.028.013.014.022.03.034.044.008.012.018.021.024.033.011.02.018.04.024.059.006.011.012.022.015.033.009.031.013.064.013.097zm-.74 4.78l-3.76 2.16 3.76 2.163 3.76-2.164zm-4.511 7.75v-4.287l-3.593 2.066-.167.096v4.325z"/>
                                </svg>
                            </div>
                            <h3 class="font-bold text-text-dark">Laravel 10</h3>
                        </div>
                        
                        <div class="text-center p-6 bg-blue-50 rounded-2xl border border-blue-200 group hover:bg-blue-100 transition-colors">
                            <div class="w-16 h-16 mx-auto mb-4 bg-blue-500/20 rounded-2xl flex items-center justify-center group-hover:bg-blue-500/30 transition-all duration-300">
                                <svg class="w-10 h-10 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M7.377 3.343c-.734 1.271-1.345 3.48-1.345 5.777 0 3.645 1.271 6.544 3.48 8.941a1.271 1.271 0 001.763.734c.734-.611 1.345-2.882 1.345-5.777 0-3.645-1.271-6.544-3.48-8.941a1.271 1.271 0 00-1.763-.734z"/>
                                </svg>
                            </div>
                            <h3 class="font-bold text-text-dark">PHP 8.2</h3>
                        </div>
                        
                        <div class="text-center p-6 bg-green-50 rounded-2xl border border-green-200 group hover:bg-green-100 transition-colors">
                            <div class="w-16 h-16 mx-auto mb-4 bg-green-500/20 rounded-2xl flex items-center justify-center group-hover:bg-green-500/30 transition-all duration-300">
                                <svg class="w-10 h-10 text-green-600" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M5.8 11.9c0-.9.1-1.8.3-2.5.2-.7.6-1.3 1.1-1.7.5-.4 1.1-.6 1.9-.6.8 0 1.4.2 1.9.6.5.4.9 1 1.1 1.7.2.7.3 1.6.3 2.5s-.1 1.8-.3 2.5c-.2.7-.6 1.3-1.1 1.7-.5.4-1.1.6-1.9.6-.8 0-1.4-.2-1.9-.6-.5-.4-.9-1-1.1-1.7-.2-.7-.3-1.6-.3-2.5zm7.2 0c0-.9.1-1.8.3-2.5.2-.7.6-1.3 1.1-1.7.5-.4 1.1-.6 1.9-.6.8 0 1.4.2 1.9.6.5.4.9 1 1.1 1.7.2.7.3 1.6.3 2.5s-.1 1.8-.3 2.5c-.2.7-.6 1.3-1.1 1.7-.5.4-1.1.6-1.9.6-.8 0-1.4-.2-1.9-.6-.5-.4-.9-1-1.1-1.7-.2-.7-.3-1.6-.3-2.5z"/>
                                </svg>
                            </div>
                            <h3 class="font-bold text-text-dark">MySQL</h3>
                        </div>
                        
                        <div class="text-center p-6 bg-primary/10 rounded-2xl border border-primary/30 group hover:bg-primary/20 transition-colors">
                            <div class="w-16 h-16 mx-auto mb-4 bg-primary/20 rounded-2xl flex items-center justify-center group-hover:bg-primary/30 transition-all duration-300">
                                <svg class="w-10 h-10 text-primary-dark" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                                </svg>
                            </div>
                            <h3 class="font-bold text-text-dark">Tailwind</h3>
                        </div>
                    </div>
                </div>
                
            </div>

            <!-- CTA Section -->
            <div class="text-center">
                <div class="warm-gradient rounded-3xl p-12 pulse-warm shadow-2xl">
                    <h2 class="text-4xl font-bold mb-6 text-white">🚀 Explore o Sistema</h2>
                    <p class="text-xl mb-8 text-white/90">
                        CRUD completo • Gestão de estoque • Interface moderna
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-6 justify-center">
                        <a href="{{ route('pedidos.index') }}" 
                           class="bg-white text-text-dark px-8 py-4 rounded-xl font-bold text-lg hover:bg-bg-light transition-all duration-300 transform hover:scale-105 shadow-lg">
                            🎯 Acessar Sistema
                        </a>
                        
                        <a href="https://github.com/marcelologan/laravel-sale-system" 
                           
                           class="bg-text-dark text-white px-8 py-4 rounded-xl font-bold text-lg hover:bg-text-light transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <svg class="inline w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                            Ver Código
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

</body>
</html>