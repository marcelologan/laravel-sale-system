<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produtos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Alertas de Feedback -->
            @if(session('success'))
                <div class="mb-6">
                    <x-alert type="success">
                        {{ session('success') }}
                    </x-alert>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6">
                    <x-alert type="error">
                        {{ session('error') }}
                    </x-alert>
                </div>
            @endif

            <!-- Card de Filtros -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h4 class="text-lg font-medium text-gray-900 mb-4">🔍 Filtros de Busca</h4>
                    
                    <form method="GET" action="{{ route('produtos.index') }}" class="space-y-4">
                        
                        <!-- Primeira linha de filtros -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            
                            <!-- Busca -->
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                                    Buscar Produto
                                </label>
                                <input type="text" 
                                       name="search" 
                                       id="search"
                                       value="{{ request('search') }}"
                                       placeholder="Nome ou código de barras..."
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Categoria -->
                            <div>
                                <label for="categoria_id" class="block text-sm font-medium text-gray-700 mb-1">
                                    Categoria
                                </label>
                                <select name="categoria_id" 
                                        id="categoria_id"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                                    Status
                                </label>
                                <select name="status" 
                                        id="status"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Todos</option>
                                    <option value="ativo" {{ request('status') == 'ativo' ? 'selected' : '' }}>Ativo</option>
                                    <option value="inativo" {{ request('status') == 'inativo' ? 'selected' : '' }}>Inativo</option>
                                </select>
                            </div>

                        </div>

                        <!-- Segunda linha de filtros -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            
                            <!-- Preço Mínimo -->
                            <div>
                                <label for="preco_min" class="block text-sm font-medium text-gray-700 mb-1">
                                    Preço Mínimo (R$)
                                </label>
                                <input type="number" 
                                       name="preco_min" 
                                       id="preco_min"
                                       value="{{ request('preco_min') }}"
                                       step="0.01"
                                       min="0"
                                       placeholder="0,00"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Preço Máximo -->
                            <div>
                                <label for="preco_max" class="block text-sm font-medium text-gray-700 mb-1">
                                    Preço Máximo (R$)
                                </label>
                                <input type="number" 
                                       name="preco_max" 
                                       id="preco_max"
                                       value="{{ request('preco_max') }}"
                                       step="0.01"
                                       min="0"
                                       placeholder="999,99"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Status do Estoque -->
                            <div>
                                <label for="estoque_status" class="block text-sm font-medium text-gray-700 mb-1">
                                    Situação do Estoque
                                </label>
                                <select name="estoque_status" 
                                        id="estoque_status"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Todos</option>
                                    <option value="sem_estoque" {{ request('estoque_status') == 'sem_estoque' ? 'selected' : '' }}>Sem estoque</option>
                                    <option value="estoque_baixo" {{ request('estoque_status') == 'estoque_baixo' ? 'selected' : '' }}>Estoque baixo</option>
                                    <option value="em_estoque" {{ request('estoque_status') == 'em_estoque' ? 'selected' : '' }}>Em estoque</option>
                                </select>
                            </div>

                            <!-- Ordenação -->
                            <div>
                                <label for="sort_by" class="block text-sm font-medium text-gray-700 mb-1">
                                    Ordenar por
                                </label>
                                <select name="sort_by" 
                                        id="sort_by"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="nome" {{ request('sort_by', 'nome') == 'nome' ? 'selected' : '' }}>Nome</option>
                                    <option value="preco" {{ request('sort_by') == 'preco' ? 'selected' : '' }}>Preço</option>
                                    <option value="estoque" {{ request('sort_by') == 'estoque' ? 'selected' : '' }}>Estoque</option>
                                    <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Data de Cadastro</option>
                                </select>
                            </div>

                        </div>

                        <!-- Botões -->
                        <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                            <div class="flex space-x-2">
                                <button type="submit" 
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    🔍 Filtrar
                                </button>
                                <a href="{{ route('produtos.index') }}" 
                                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    🔄 Limpar
                                </a>
                            </div>
                            
                            <!-- Direção da ordenação -->
                            <div class="flex items-center space-x-2">
                                <label class="text-sm text-gray-700">Ordem:</label>
                                <select name="sort_direction" 
                                        class="px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="asc" {{ request('sort_direction', 'asc') == 'asc' ? 'selected' : '' }}>↑ Crescente</option>
                                    <option value="desc" {{ request('sort_direction') == 'desc' ? 'selected' : '' }}>↓ Decrescente</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Card Principal -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-lg font-medium">Lista de Produtos</h3>
                            <p class="text-sm text-gray-500 mt-1">
                                {{ $produtos->total() }} produto(s) encontrado(s)
                                @if(request()->hasAny(['search', 'categoria_id', 'status', 'preco_min', 'preco_max', 'estoque_status']))
                                    <span class="text-blue-600">(filtrado)</span>
                                @endif
                            </p>
                        </div>
                        <a href="{{ route('produtos.create') }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            📦 Novo Produto
                        </a>
                    </div>

                    <!-- Tabela -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'nome', 'sort_direction' => request('sort_by', 'nome') == 'nome' && request('sort_direction', 'asc') == 'asc' ? 'desc' : 'asc']) }}" 
                                           class="flex items-center hover:text-gray-700">
                                            Produto
                                            @if(request('sort_by', 'nome') == 'nome')
                                                <span class="ml-1">
                                                    @if(request('sort_direction', 'asc') == 'asc')
                                                        ↑
                                                    @else
                                                        ↓
                                                    @endif
                                                </span>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Categoria
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'preco', 'sort_direction' => request('sort_by') == 'preco' && request('sort_direction', 'asc') == 'asc' ? 'desc' : 'asc']) }}" 
                                           class="flex items-center hover:text-gray-700">
                                            Preço
                                            @if(request('sort_by') == 'preco')
                                                <span class="ml-1">
                                                    @if(request('sort_direction', 'asc') == 'asc')
                                                        ↑
                                                    @else
                                                        ↓
                                                    @endif
                                                </span>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'estoque', 'sort_direction' => request('sort_by') == 'estoque' && request('sort_direction', 'asc') == 'asc' ? 'desc' : 'asc']) }}" 
                                           class="flex items-center hover:text-gray-700">
                                            Estoque
                                            @if(request('sort_by') == 'estoque')
                                                <span class="ml-1">
                                                    @if(request('sort_direction', 'asc') == 'asc')
                                                        ↑
                                                    @else
                                                        ↓
                                                    @endif
                                                </span>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Ações
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($produtos as $produto)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                @if($produto->imagem)
                                                    <div class="flex-shrink-0 h-12 w-12">
                                                        <img class="h-12 w-12 rounded-lg object-cover" 
                                                             src="{{ asset('storage/' . $produto->imagem) }}" 
                                                             alt="{{ $produto->nome }}">
                                                    </div>
                                                @else
                                                    <div class="flex-shrink-0 h-12 w-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                                        <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                        </svg>
                                                    </div>
                                                @endif
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $produto->nome }}</div>
                                                    @if($produto->codigo_barras)
                                                        <div class="text-sm text-gray-500 font-mono">{{ $produto->codigo_barras }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $produto->categoria->nome }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-semibold text-gray-900">{{ $produto->preco_formatado }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span class="text-sm font-medium text-gray-900 mr-2">{{ $produto->estoque }}</span>
                                                @if($produto->estoque <= 0)
                                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                                        Sem estoque
                                                    </span>
                                                @elseif($produto->estoque <= 5)
                                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                        Baixo
                                                    </span>
                                                @else
                                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                        OK
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $produto->status == 'ativo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ ucfirst($produto->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <a href="{{ route('produtos.show', $produto) }}" 
                                               class="text-blue-600 hover:text-blue-900">Ver</a>
                                            <a href="{{ route('produtos.edit', $produto) }}" 
                                               class="text-yellow-600 hover:text-yellow-900">Editar</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                @if(request()->hasAny(['search', 'categoria_id', 'status', 'preco_min', 'preco_max', 'estoque_status']))
                                                    <svg class="h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                                    </svg>
                                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Nenhum produto encontrado</h3>
                                                    <p class="text-gray-500 mb-4">Tente ajustar os filtros de busca.</p>
                                                    <a href="{{ route('produtos.index') }}" 
                                                       class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                                        🔄 Limpar Filtros
                                                    </a>
                                                @else
                                                    <svg class="h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                    </svg>
                                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Nenhum produto cadastrado</h3>
                                                    <p class="text-gray-500 mb-4">Comece criando seu primeiro produto.</p>
                                                    <a href="{{ route('produtos.create') }}" 
                                                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                        📦 Criar Primeiro Produto
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginação -->
                    @if($produtos->hasPages())
                        <div class="mt-6 flex items-center justify-between">
                            <div class="text-sm text-gray-700">
                                Mostrando {{ $produtos->firstItem() }} a {{ $produtos->lastItem() }} 
                                de {{ $produtos->total() }} resultados
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