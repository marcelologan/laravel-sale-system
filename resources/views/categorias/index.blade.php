<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-secondary/20 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-secondary-dark" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-text-dark leading-tight">
                        Gestão de Categorias
                    </h2>
                    <p class="text-text-light text-sm">Organize seus produtos por categorias</p>
                </div>
            </div>
            <a href="{{ route('categorias.create') }}" 
               class="bg-secondary hover:bg-secondary-dark text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4v16m8-8H4"/>
                </svg>
                Nova Categoria
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Card de Filtros -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-secondary/20">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-link/20 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-link" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-text-dark">Filtros de Busca</h3>
                    </div>
                    
                    <form method="GET" action="{{ route('categorias.index') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            
                            <!-- Busca -->
                            <div>
                                <label for="search" class="block text-sm font-semibold text-text-dark mb-2">
                                    🔍 Buscar Categoria
                                </label>
                                <input type="text" 
                                       name="search" 
                                       id="search"
                                       value="{{ request('search') }}"
                                       placeholder="Nome da categoria..."
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary transition-all">
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-semibold text-text-dark mb-2">
                                    📊 Status
                                </label>
                                <select name="status" 
                                        id="status"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary transition-all">
                                    <option value="">Todos os status</option>
                                    <option value="ativo" {{ request('status') == 'ativo' ? 'selected' : '' }}>✅ Ativo</option>
                                    <option value="inativo" {{ request('status') == 'inativo' ? 'selected' : '' }}>❌ Inativo</option>
                                </select>
                            </div>

                            <!-- Ordenação -->
                            <div>
                                <label for="sort_by" class="block text-sm font-semibold text-text-dark mb-2">
                                    📋 Ordenar por
                                </label>
                                <select name="sort_by" 
                                        id="sort_by"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary transition-all">
                                    <option value="nome" {{ request('sort_by', 'nome') == 'nome' ? 'selected' : '' }}>Nome</option>
                                    <option value="produtos_count" {{ request('sort_by') == 'produtos_count' ? 'selected' : '' }}>Nº de Produtos</option>
                                    <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Data de Cadastro</option>
                                </select>
                            </div>

                        </div>

                        <!-- Botões e Direção -->
                        <div class="flex flex-col sm:flex-row justify-between items-center pt-4 space-y-4 sm:space-y-0">
                            <div class="flex space-x-3">
                                <button type="submit" 
                                        class="bg-link hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z"/>
                                    </svg>
                                    Filtrar
                                </button>
                                <a href="{{ route('categorias.index') }}" 
                                   class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.65,6.35C16.2,4.9 14.21,4 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20C15.73,20 18.84,17.45 19.73,14H17.65C16.83,16.33 14.61,18 12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6C13.66,6 15.14,6.69 16.22,7.78L13,11H20V4L17.65,6.35Z"/>
                                    </svg>
                                    Limpar
                                </a>
                            </div>
                            
                            <!-- Direção da ordenação -->
                            <div class="flex items-center space-x-3">
                                <label class="text-sm font-medium text-text-dark">Ordem:</label>
                                <select name="sort_direction" 
                                        class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary">
                                    <option value="asc" {{ request('sort_direction', 'asc') == 'asc' ? 'selected' : '' }}>↑ Crescente</option>
                                    <option value="desc" {{ request('sort_direction') == 'desc' ? 'selected' : '' }}>↓ Decrescente</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Card Principal -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-secondary/20">
                <div class="p-6">
                    
                    <!-- Header -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 space-y-4 sm:space-y-0">
                        <div>
                            <h3 class="text-xl font-bold text-text-dark flex items-center">
                                <svg class="w-6 h-6 mr-2 text-secondary-dark" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                </svg>
                                Lista de Categorias
                            </h3>
                            <p class="text-sm text-text-light mt-1">
                                <span class="font-semibold text-secondary-dark">{{ $categorias->total() }}</span> categoria(s) encontrada(s)
                                @if(request()->hasAny(['search', 'status']))
                                    <span class="text-link font-medium">
                                        (filtrado{{ request('search') ? ' por "' . request('search') . '"' : '' }}{{ request('status') ? ' - status: ' . request('status') : '' }})
                                    </span>
                                @endif
                            </p>
                        </div>
                        
                        <!-- Stats rápidas -->
                        <div class="flex space-x-4">
                            <div class="text-center">
                                <div class="text-lg font-bold text-green-600">{{ $categorias->where('status', 'ativo')->count() }}</div>
                                <div class="text-xs text-text-light">Ativas</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-bold text-red-600">{{ $categorias->where('status', 'inativo')->count() }}</div>
                                <div class="text-xs text-text-light">Inativas</div>
                            </div>
                        </div>
                    </div>

                    <!-- Grid de Categorias (Cards) -->
                    @if($categorias->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($categorias as $categoria)
                                <div class="bg-gradient-to-br from-secondary/5 to-primary/5 rounded-xl p-6 border border-secondary/20 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                                    
                                    <!-- Header do Card -->
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="w-12 h-12 bg-secondary/20 rounded-xl flex items-center justify-center">
                                            <svg class="w-6 h-6 text-secondary-dark" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                            </svg>
                                        </div>
                                        <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $categoria->status == 'ativo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $categoria->status == 'ativo' ? '✅ Ativo' : '❌ Inativo' }}
                                        </span>
                                    </div>

                                    <!-- Nome e Descrição -->
                                    <div class="mb-4">
                                        <h4 class="text-lg font-bold text-text-dark mb-2">{{ $categoria->nome }}</h4>
                                        @if($categoria->descricao)
                                            <p class="text-sm text-text-light line-clamp-2">{{ Str::limit($categoria->descricao, 80) }}</p>
                                        @else
                                            <p class="text-sm text-gray-400 italic">Sem descrição</p>
                                        @endif
                                    </div>

                                    <!-- Estatísticas -->
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-secondary-dark" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M20 7h-3V6a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v1H0v2h3v9a4 4 0 0 0 4 4h10a4 4 0 0 0 4-4V9h3V7z"/>
                                            </svg>
                                            <span class="text-sm font-medium text-text-dark">{{ $categoria->produtos_count }} produto(s)</span>
                                        </div>
                                        <span class="text-xs text-text-light">{{ \Carbon\Carbon::parse($categoria->created_at)->format('d/m/Y') }}</span>
                                    </div>

                                    <!-- Barra de Progresso -->
                                    @if($categoria->produtos_count > 0)
                                        <div class="mb-4">
                                            <div class="w-full bg-gray-200 rounded-full h-2">
                                                <div class="bg-secondary h-2 rounded-full" style="width: {{ min(($categoria->produtos_count / 50) * 100, 100) }}%"></div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Ações -->
                                    <div class="flex space-x-2">
                                        <a href="{{ route('categorias.show', $categoria) }}" 
                                           class="flex-1 bg-link/10 text-link hover:bg-link hover:text-white px-3 py-2 rounded-lg transition-all duration-300 text-center text-sm font-medium">
                                            👁️ Ver
                                        </a>
                                        <a href="{{ route('categorias.edit', $categoria) }}" 
                                           class="flex-1 bg-secondary/10 text-secondary-dark hover:bg-secondary hover:text-white px-3 py-2 rounded-lg transition-all duration-300 text-center text-sm font-medium">
                                            ✏️ Editar
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Estado Vazio -->
                        <div class="text-center py-16">
                            @if(request()->hasAny(['search', 'status']))
                                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-text-dark mb-2">🔍 Nenhuma categoria encontrada</h3>
                                <p class="text-text-light mb-6">Tente ajustar os filtros de busca ou criar uma nova categoria.</p>
                                <div class="flex justify-center space-x-3">
                                    <a href="{{ route('categorias.index') }}" 
                                       class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                        🔄 Limpar Filtros
                                    </a>
                                    <a href="{{ route('categorias.create') }}" 
                                       class="bg-secondary hover:bg-secondary-dark text-white font-semibold py-2 px-4 rounded-lg transition-all">
                                        ➕ Nova Categoria
                                    </a>
                                </div>
                            @else
                                <div class="w-20 h-20 bg-secondary/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="h-10 w-10 text-secondary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-text-dark mb-2">🏷️ Nenhuma categoria cadastrada</h3>
                                <p class="text-text-light mb-6">Comece criando sua primeira categoria para organizar seus produtos.</p>
                                <a href="{{ route('categorias.create') }}" 
                                   class="bg-secondary hover:bg-secondary-dark text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105">
                                    🚀 Criar Primeira Categoria
                                </a>
                            @endif
                        </div>
                    @endif

                    <!-- Paginação -->
                    @if($categorias->hasPages())
                        <div class="mt-8 flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
                            <div class="text-sm text-text-light">
                                Mostrando <span class="font-semibold text-text-dark">{{ $categorias->firstItem() }}</span> a 
                                <span class="font-semibold text-text-dark">{{ $categorias->lastItem() }}</span> de 
                                <span class="font-semibold text-text-dark">{{ $categorias->total() }}</span> resultados
                            </div>
                            <div>
                                {{ $categorias->links() }}
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>