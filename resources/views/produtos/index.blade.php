<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-primary/20 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-primary-dark" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20 7h-3V6a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v1H0v2h3v9a4 4 0 0 0 4 4h10a4 4 0 0 0 4-4V9h3V7z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-text-dark leading-tight">
                        Gestão de Produtos
                    </h2>
                    <p class="text-text-light text-sm">Gerencie seu catálogo de produtos</p>
                </div>
            </div>
            <a href="{{ route('produtos.create') }}" 
               class="warm-gradient text-white font-semibold py-3 px-6 rounded-xl hover:opacity-90 transition-all duration-300 transform hover:scale-105 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4v16m8-8H4"/>
                </svg>
                Novo Produto
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Card de Filtros -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-primary/20">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-link/20 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-link" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-text-dark">🔍 Filtros Avançados</h3>
                    </div>
                    
                    <form method="GET" action="{{ route('produtos.index') }}" class="space-y-4">
                        
                        <!-- Primeira linha de filtros -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            
                            <!-- Busca -->
                            <div>
                                <label for="search" class="block text-sm font-semibold text-text-dark mb-2">
                                    🔍 Buscar Produto
                                </label>
                                <input type="text" 
                                       name="search" 
                                       id="search"
                                       value="{{ request('search') }}"
                                       placeholder="Nome ou código de barras..."
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                            </div>

                            <!-- Categoria -->
                            <div>
                                <label for="categoria_id" class="block text-sm font-semibold text-text-dark mb-2">
                                    🏷️ Categoria
                                </label>
                                <select name="categoria_id" 
                                        id="categoria_id"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                                    <option value="">Todas as categorias</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                            {{ $categoria->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-semibold text-text-dark mb-2">
                                    📊 Status
                                </label>
                                <select name="status" 
                                        id="status"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                                    <option value="">Todos os status</option>
                                    <option value="ativo" {{ request('status') == 'ativo' ? 'selected' : '' }}>✅ Ativo</option>
                                    <option value="inativo" {{ request('status') == 'inativo' ? 'selected' : '' }}>❌ Inativo</option>
                                </select>
                            </div>

                        </div>

                        <!-- Segunda linha de filtros -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            
                            <!-- Preço Mínimo -->
                            <div>
                                <label for="preco_min" class="block text-sm font-semibold text-text-dark mb-2">
                                    💰 Preço Mínimo (R\$)
                                </label>
                                <input type="number" 
                                       name="preco_min" 
                                       id="preco_min"
                                       value="{{ request('preco_min') }}"
                                       step="0.01"
                                       min="0"
                                       placeholder="0,00"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                            </div>

                            <!-- Preço Máximo -->
                            <div>
                                <label for="preco_max" class="block text-sm font-semibold text-text-dark mb-2">
                                    💰 Preço Máximo (R\$)
                                </label>
                                <input type="number" 
                                       name="preco_max" 
                                       id="preco_max"
                                       value="{{ request('preco_max') }}"
                                       step="0.01"
                                       min="0"
                                       placeholder="999,99"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                            </div>

                            <!-- Status do Estoque -->
                            <div>
                                <label for="estoque_status" class="block text-sm font-semibold text-text-dark mb-2">
                                    📦 Situação do Estoque
                                </label>
                                <select name="estoque_status" 
                                        id="estoque_status"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                                    <option value="">Todos</option>
                                    <option value="sem_estoque" {{ request('estoque_status') == 'sem_estoque' ? 'selected' : '' }}>❌ Sem estoque</option>
                                    <option value="estoque_baixo" {{ request('estoque_status') == 'estoque_baixo' ? 'selected' : '' }}>⚠️ Estoque baixo</option>
                                    <option value="em_estoque" {{ request('estoque_status') == 'em_estoque' ? 'selected' : '' }}>✅ Em estoque</option>
                                </select>
                            </div>

                            <!-- Ordenação -->
                            <div>
                                <label for="sort_by" class="block text-sm font-semibold text-text-dark mb-2">
                                    📋 Ordenar por
                                </label>
                                <select name="sort_by" 
                                        id="sort_by"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                                    <option value="nome" {{ request('sort_by', 'nome') == 'nome' ? 'selected' : '' }}>Nome</option>
                                    <option value="preco" {{ request('sort_by') == 'preco' ? 'selected' : '' }}>Preço</option>
                                    <option value="estoque" {{ request('sort_by') == 'estoque' ? 'selected' : '' }}>Estoque</option>
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
                                <a href="{{ route('produtos.index') }}" 
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
                                        class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                                    <option value="asc" {{ request('sort_direction', 'asc') == 'asc' ? 'selected' : '' }}>↑ Crescente</option>
                                    <option value="desc" {{ request('sort_direction') == 'desc' ? 'selected' : '' }}>↓ Decrescente</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Card Principal -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-primary/20">
                <div class="p-6">
                    
                    <!-- Header -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 space-y-4 sm:space-y-0">
                        <div>
                            <h3 class="text-xl font-bold text-text-dark flex items-center">
                                <svg class="w-6 h-6 mr-2 text-primary-dark" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20 7h-3V6a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v1H0v2h3v9a4 4 0 0 0 4 4h10a4 4 0 0 0 4-4V9h3V7z"/>
                                </svg>
                                Catálogo de Produtos
                            </h3>
                            <p class="text-sm text-text-light mt-1">
                                <span class="font-semibold text-primary-dark">{{ $produtos->total() }}</span> produto(s) encontrado(s)
                                @if(request()->hasAny(['search', 'categoria_id', 'status', 'preco_min', 'preco_max', 'estoque_status']))
                                    <span class="text-link font-medium">(filtrado)</span>
                                @endif
                            </p>
                        </div>
                        
                        <!-- Stats rápidas -->
                        <div class="flex space-x-4">
                            <div class="text-center">
                                <div class="text-lg font-bold text-green-600">{{ $produtos->where('status', 'ativo')->count() }}</div>
                                <div class="text-xs text-text-light">Ativos</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-bold text-red-600">{{ $produtos->where('estoque', '<=', 0)->count() }}</div>
                                <div class="text-xs text-text-light">Sem Estoque</div>
                            </div>
                        </div>
                    </div>

                    <!-- Grid de Produtos (Cards) -->
                    @if($produtos->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            @foreach($produtos as $produto)
                                <div class="bg-gradient-to-br from-primary/5 to-secondary/5 rounded-xl border border-primary/20 hover:shadow-xl transition-all duration-300 transform hover:scale-105 overflow-hidden">
                                    
                                    <!-- Imagem do Produto -->
                                    <div class="aspect-square bg-white relative overflow-hidden">
                                        @if($produto->imagem)
                                            <img class="w-full h-full object-cover" 
                                                 src="{{ asset('storage/' . $produto->imagem) }}" 
                                                 alt="{{ $produto->nome }}">
                                        @else
                                            <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                        @endif
                                        
                                        <!-- Status Badge -->
                                        <div class="absolute top-2 right-2">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $produto->status == 'ativo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $produto->status == 'ativo' ? '✅' : '❌' }}
                                            </span>
                                        </div>

                                        <!-- Estoque Badge -->
                                        <div class="absolute top-2 left-2">
                                            @if($produto->estoque <= 0)
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                    Sem estoque
                                                </span>
                                            @elseif($produto->estoque <= 5)
                                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Baixo
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Informações do Produto -->
                                    <div class="p-4">
                                        <!-- Nome e Categoria -->
                                        <div class="mb-3">
                                            <h4 class="text-sm font-bold text-text-dark mb-1 line-clamp-2">{{ $produto->nome }}</h4>
                                            <p class="text-xs text-text-light">{{ $produto->categoria->nome }}</p>
                                        </div>

                                        <!-- Preço -->
                                        <div class="mb-3">
                                            <div class="text-lg font-bold text-primary-dark">R\$ {{ number_format($produto->preco, 2, ',', '.') }}</div>
                                        </div>

                                        <!-- Estoque e Código -->
                                        <div class="flex justify-between items-center mb-4 text-xs text-text-light">
                                            <span>📦 Estoque: {{ $produto->estoque }}</span>
                                            @if($produto->codigo_barras)
                                                <span class="font-mono">{{ Str::limit($produto->codigo_barras, 8) }}</span>
                                            @endif
                                        </div>

                                        <!-- Ações -->
                                        <div class="flex space-x-2">
                                            <a href="{{ route('produtos.show', $produto) }}" 
                                               class="flex-1 bg-link/10 text-link hover:bg-link hover:text-white px-3 py-2 rounded-lg transition-all duration-300 text-center text-xs font-medium">
                                                👁️ Ver
                                            </a>
                                            <a href="{{ route('produtos.edit', $produto) }}" 
                                               class="flex-1 bg-secondary/10 text-secondary-dark hover:bg-secondary hover:text-white px-3 py-2 rounded-lg transition-all duration-300 text-center text-xs font-medium">
                                                ✏️ Editar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Estado Vazio -->
                        <div class="text-center py-16">
                            @if(request()->hasAny(['search', 'categoria_id', 'status', 'preco_min', 'preco_max', 'estoque_status']))
                                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-text-dark mb-2">🔍 Nenhum produto encontrado</h3>
                                <p class="text-text-light mb-6">Tente ajustar os filtros de busca ou criar um novo produto.</p>
                                <div class="flex justify-center space-x-3">
                                    <a href="{{ route('produtos.index') }}" 
                                       class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                        🔄 Limpar Filtros
                                    </a>
                                    <a href="{{ route('produtos.create') }}" 
                                       class="warm-gradient text-white font-semibold py-2 px-4 rounded-lg hover:opacity-90 transition-all">
                                        ➕ Novo Produto
                                    </a>
                                </div>
                            @else
                                <div class="w-20 h-20 bg-primary/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="h-10 w-10 text-primary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-text-dark mb-2">📦 Nenhum produto cadastrado</h3>
                                <p class="text-text-light mb-6">Comece criando seu primeiro produto para gerenciar seu catálogo.</p>
                                <a href="{{ route('produtos.create') }}" 
                                   class="warm-gradient text-white font-semibold py-3 px-6 rounded-xl hover:opacity-90 transition-all duration-300 transform hover:scale-105">
                                    🚀 Criar Primeiro Produto
                                </a>
                            @endif
                        </div>
                    @endif

                    <!-- Paginação -->
                    @if($produtos->hasPages())
                        <div class="mt-8 flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
                            <div class="text-sm text-text-light">
                                Mostrando <span class="font-semibold text-text-dark">{{ $produtos->firstItem() }}</span> a 
                                <span class="font-semibold text-text-dark">{{ $produtos->lastItem() }}</span> de 
                                <span class="font-semibold text-text-dark">{{ $produtos->total() }}</span> resultados
                            </div>
                            <div>
                                {{ $produtos->links() }}
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>