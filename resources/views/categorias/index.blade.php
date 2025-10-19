<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Categorias') }}
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
                    <form method="GET" action="{{ route('categorias.index') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            
                            <!-- Busca -->
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                                    Buscar Categoria
                                </label>
                                <input type="text" 
                                       name="search" 
                                       id="search"
                                       value="{{ request('search') }}"
                                       placeholder="Nome da categoria..."
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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

                            <!-- Ordenação -->
                            <div>
                                <label for="sort_by" class="block text-sm font-medium text-gray-700 mb-1">
                                    Ordenar por
                                </label>
                                <select name="sort_by" 
                                        id="sort_by"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="nome" {{ request('sort_by', 'nome') == 'nome' ? 'selected' : '' }}>Nome</option>
                                    <option value="produtos_count" {{ request('sort_by') == 'produtos_count' ? 'selected' : '' }}>Nº de Produtos</option>
                                    <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Data de Cadastro</option>
                                </select>
                            </div>

                        </div>

                        <!-- Botões -->
                        <div class="flex justify-between items-center pt-4">
                            <div class="flex space-x-2">
                                <button type="submit" 
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    🔍 Filtrar
                                </button>
                                <a href="{{ route('categorias.index') }}" 
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
                            <h3 class="text-lg font-medium">Lista de Categorias</h3>
                            <p class="text-sm text-gray-500 mt-1">
                                {{ $categorias->total() }} categoria(s) encontrada(s)
                                @if(request()->hasAny(['search', 'status']))
                                    <span class="text-blue-600">
                                        (filtrado{{ request('search') ? ' por "' . request('search') . '"' : '' }}{{ request('status') ? ' - status: ' . request('status') : '' }})
                                    </span>
                                @endif
                            </p>
                        </div>
                        <a href="{{ route('categorias.create') }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            📂 Nova Categoria
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
                                            Nome
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
                                        Descrição
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'produtos_count', 'sort_direction' => request('sort_by') == 'produtos_count' && request('sort_direction', 'asc') == 'asc' ? 'desc' : 'asc']) }}" 
                                           class="flex items-center hover:text-gray-700">
                                            Produtos
                                            @if(request('sort_by') == 'produtos_count')
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
                                        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'created_at', 'sort_direction' => request('sort_by') == 'created_at' && request('sort_direction', 'asc') == 'asc' ? 'desc' : 'asc']) }}" 
                                           class="flex items-center hover:text-gray-700">
                                            Cadastro
                                            @if(request('sort_by') == 'created_at')
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
                                        Ações
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($categorias as $categoria)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $categoria->nome }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">
                                                @if($categoria->descricao)
                                                    {{ Str::limit($categoria->descricao, 50) }}
                                                @else
                                                    <span class="text-gray-400 italic">Sem descrição</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <span class="text-sm font-medium text-gray-900 mr-2">{{ $categoria->produtos_count }}</span>
                                                @if($categoria->produtos_count > 0)
                                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                                        {{ $categoria->produtos_count }} produto{{ $categoria->produtos_count > 1 ? 's' : '' }}
                                                    </span>
                                                @else
                                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                                        Vazia
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $categoria->status == 'ativo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ ucfirst($categoria->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($categoria->created_at)->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <a href="{{ route('categorias.show', $categoria) }}" 
                                               class="text-blue-600 hover:text-blue-900">Ver</a>
                                            <a href="{{ route('categorias.edit', $categoria) }}" 
                                               class="text-yellow-600 hover:text-yellow-900">Editar</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                @if(request()->hasAny(['search', 'status']))
                                                    <svg class="h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                                    </svg>
                                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Nenhuma categoria encontrada</h3>
                                                    <p class="text-gray-500 mb-4">Tente ajustar os filtros de busca.</p>
                                                    <a href="{{ route('categorias.index') }}" 
                                                       class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                                        🔄 Limpar Filtros
                                                    </a>
                                                @else
                                                    <svg class="h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                                    </svg>
                                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Nenhuma categoria cadastrada</h3>
                                                    <p class="text-gray-500 mb-4">Comece criando sua primeira categoria.</p>
                                                    <a href="{{ route('categorias.create') }}" 
                                                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                        📂 Criar Primeira Categoria
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
                    @if($categorias->hasPages())
                        <div class="mt-6 flex items-center justify-between">
                            <div class="text-sm text-gray-700">
                                Mostrando {{ $categorias->firstItem() }} a {{ $categorias->lastItem() }} 
                                de {{ $categorias->total() }} resultados
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