<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Cards de Estatísticas Principais -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Total de Clientes -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Total de Clientes</div>
                                <div class="text-2xl font-semibold text-gray-900">{{ number_format($totalClientes) }}</div>
                                <div class="text-sm text-green-600">{{ $clientesAtivos }} ativos</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total de Produtos -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Total de Produtos</div>
                                <div class="text-2xl font-semibold text-gray-900">{{ number_format($totalProdutos) }}</div>
                                <div class="text-sm text-green-600">{{ $produtosAtivos }} ativos</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Valor do Estoque -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Valor do Estoque</div>
                                <div class="text-2xl font-semibold text-gray-900">R$ {{ number_format($valorTotalEstoque, 2, ',', '.') }}</div>
                                <div class="text-sm text-gray-600">{{ $totalCategorias }} categorias</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Alertas de Estoque -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-500">Alertas de Estoque</div>
                                <div class="text-2xl font-semibold text-gray-900">{{ $produtosEstoqueBaixo + $produtosSemEstoque }}</div>
                                <div class="text-sm text-red-600">{{ $produtosSemEstoque }} sem estoque</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Gráficos e Listas -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                <!-- Últimos Clientes -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Últimos Clientes</h3>
                            <a href="{{ route('clientes.index') }}" class="text-blue-600 hover:text-blue-900 text-sm">Ver todos</a>
                        </div>
                        <div class="space-y-3">
                            @forelse($ultimosClientes as $cliente)
                                <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $cliente->nome }}</div>
                                        <div class="text-sm text-gray-500">{{ $cliente->email }}</div>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                            {{ $cliente->status == 'ativo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($cliente->status) }}
                                        </span>
                                        <div class="text-xs text-gray-500 mt-1">
                                            {{ \Carbon\Carbon::parse($cliente->created_at)->format('d/m/Y') }}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4">
                                    <p class="text-gray-500">Nenhum cliente cadastrado</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Últimos Produtos -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-gray-900">Últimos Produtos</h3>
                            <a href="{{ route('produtos.index') }}" class="text-blue-600 hover:text-blue-900 text-sm">Ver todos</a>
                        </div>
                        <div class="space-y-3">
                            @forelse($ultimosProdutos as $produto)
                                <div class="flex items-center justify-between py-2 border-b border-gray-100 last:border-b-0">
                                    <div class="flex items-center">
                                        @if($produto->imagem)
                                            <img class="h-8 w-8 rounded object-cover mr-3" 
                                                 src="{{ asset('storage/' . $produto->imagem) }}" 
                                                 alt="{{ $produto->nome }}">
                                        @else
                                            <div class="h-8 w-8 bg-gray-200 rounded flex items-center justify-center mr-3">
                                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ Str::limit($produto->nome, 25) }}</div>
                                            <div class="text-sm text-gray-500">{{ $produto->categoria->nome }}</div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm font-semibold text-gray-900">{{ $produto->preco_formatado }}</div>
                                        <div class="text-xs text-gray-500">
                                            Estoque: {{ $produto->estoque }}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-4">
                                    <p class="text-gray-500">Nenhum produto cadastrado</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>

            <!-- Produtos por Categoria -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Produtos por Categoria</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @forelse($produtosPorCategoria as $categoria)
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $categoria->nome }}</h4>
                                        <p class="text-sm text-gray-500">{{ $categoria->produtos_count }} produto(s)</p>
                                    </div>
                                    <div class="text-2xl font-bold text-blue-600">
                                        {{ $categoria->produtos_count }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-3 text-center py-4">
                                <p class="text-gray-500">Nenhuma categoria cadastrada</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Produtos com Estoque Baixo -->
            @if($produtosEstoqueBaixo > 0 || $produtosSemEstoque > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <svg class="h-5 w-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900">Alertas de Estoque</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($produtosSemEstoque > 0)
                                <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h4 class="text-sm font-medium text-red-800">Produtos sem estoque</h4>
                                            <p class="text-sm text-red-700">{{ $produtosSemEstoque }} produto(s) precisam de reposição</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            @if($produtosEstoqueBaixo > 0)
                                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h4 class="text-sm font-medium text-yellow-800">Estoque baixo</h4>
                                            <p class="text-sm text-yellow-700">{{ $produtosEstoqueBaixo }} produto(s) com estoque baixo</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <div class="mt-4">
                            <a href="{{ route('produtos.index', ['estoque_status' => 'sem_estoque']) }}" 
                               class="text-blue-600 hover:text-blue-900 text-sm mr-4">
                                Ver produtos sem estoque
                            </a>
                            <a href="{{ route('produtos.index', ['estoque_status' => 'estoque_baixo']) }}" 
                               class="text-blue-600 hover:text-blue-900 text-sm">
                                Ver produtos com estoque baixo
                            </a>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>