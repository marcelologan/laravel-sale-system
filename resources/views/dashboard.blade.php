<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-12 h-12 warm-gradient rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-text-dark leading-tight">
                        Dashboard
                    </h2>
                    <p class="text-text-light text-sm">Visão geral do seu sistema</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm text-text-light">Bem-vindo,</p>
                <p class="font-semibold text-text-dark">{{ Auth::user()->name }}</p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Cards de Estatísticas Principais -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Total de Clientes -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border-l-4 border-primary hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-primary/20 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-primary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-text-light">Total de Clientes</div>
                                <div class="text-2xl font-bold text-text-dark">{{ number_format($totalClientes) }}</div>
                                <div class="text-sm text-green-600 font-medium">{{ $clientesAtivos }} ativos</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total de Produtos -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border-l-4 border-primary-dark hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-primary-dark/20 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-primary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-text-light">Total de Produtos</div>
                                <div class="text-2xl font-bold text-text-dark">{{ number_format($totalProdutos) }}</div>
                                <div class="text-sm text-green-600 font-medium">{{ $produtosAtivos }} ativos</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Valor do Estoque -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border-l-4 border-secondary hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-secondary/20 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-secondary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-text-light">Valor do Estoque</div>
                                <div class="text-2xl font-bold text-text-dark">R\$ {{ number_format($valorTotalEstoque, 2, ',', '.') }}</div>
                                <div class="text-sm text-text-light font-medium">{{ $totalCategorias }} categorias</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Alertas de Estoque -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border-l-4 border-red-500 hover:shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-text-light">Alertas de Estoque</div>
                                <div class="text-2xl font-bold text-text-dark">{{ $produtosEstoqueBaixo + $produtosSemEstoque }}</div>
                                <div class="text-sm text-red-600 font-medium">{{ $produtosSemEstoque }} sem estoque</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
                        <!-- Gráficos e Listas -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                <!-- Últimos Clientes -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-primary/20 hover:shadow-2xl transition-all duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-primary/20 rounded-xl flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-primary-dark" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-text-dark">Últimos Clientes</h3>
                            </div>
                            <a href="{{ route('clientes.index') }}" 
                               class="text-link hover:text-primary-dark font-medium text-sm transition-colors flex items-center">
                                Ver todos
                                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                                </svg>
                            </a>
                        </div>
                        <div class="space-y-4">
                            @forelse($ultimosClientes as $cliente)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-primary/5 transition-colors">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-primary/20 rounded-full flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-primary-dark" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-sm font-semibold text-text-dark">{{ $cliente->nome }}</div>
                                            <div class="text-xs text-text-light">{{ $cliente->email }}</div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full 
                                            {{ $cliente->status == 'ativo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($cliente->status) }}
                                        </span>
                                        <div class="text-xs text-text-light mt-1">
                                            {{ \Carbon\Carbon::parse($cliente->created_at)->format('d/m/Y') }}
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <p class="text-text-light font-medium">Nenhum cliente cadastrado</p>
                                    <a href="{{ route('clientes.create') }}" 
                                       class="text-link hover:text-primary-dark text-sm font-medium mt-2 inline-block">
                                        Cadastrar primeiro cliente
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Últimos Produtos -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-secondary/20 hover:shadow-2xl transition-all duration-300">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-6">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-secondary/20 rounded-xl flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-secondary-dark" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20 7h-3V6a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v1H0v2h3v9a4 4 0 0 0 4 4h10a4 4 0 0 0 4-4V9h3V7z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-text-dark">Últimos Produtos</h3>
                            </div>
                            <a href="{{ route('produtos.index') }}" 
                               class="text-link hover:text-secondary-dark font-medium text-sm transition-colors flex items-center">
                                Ver todos
                                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                                </svg>
                            </a>
                        </div>
                        <div class="space-y-4">
                            @forelse($ultimosProdutos as $produto)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-secondary/5 transition-colors">
                                    <div class="flex items-center">
                                        @if($produto->imagem)
                                            <img class="h-10 w-10 rounded-lg object-cover mr-3 border border-gray-200" 
                                                 src="{{ asset('storage/' . $produto->imagem) }}" 
                                                 alt="{{ $produto->nome }}">
                                        @else
                                            <div class="h-10 w-10 bg-secondary/20 rounded-lg flex items-center justify-center mr-3">
                                                <svg class="h-5 w-5 text-secondary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="text-sm font-semibold text-text-dark">{{ Str::limit($produto->nome, 25) }}</div>
                                            <div class="text-xs text-text-light">{{ $produto->categoria->nome }}</div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm font-bold text-secondary-dark">{{ $produto->preco_formatado }}</div>
                                        <div class="text-xs text-text-light">
                                            Estoque: <span class="font-medium">{{ $produto->estoque }}</span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-8">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20 7h-3V6a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v1H0v2h3v9a4 4 0 0 0 4 4h10a4 4 0 0 0 4-4V9h3V7z"/>
                                        </svg>
                                    </div>
                                    <p class="text-text-light font-medium">Nenhum produto cadastrado</p>
                                    <a href="{{ route('produtos.create') }}" 
                                       class="text-link hover:text-secondary-dark text-sm font-medium mt-2 inline-block">
                                        Cadastrar primeiro produto
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>

            <!-- Produtos por Categoria -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-primary/20">
                <div class="p-6">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 warm-gradient rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-text-dark">Produtos por Categoria</h3>
                            <p class="text-sm text-text-light">Distribuição do seu estoque</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @forelse($produtosPorCategoria as $categoria)
                            <div class="bg-gradient-to-br from-primary/5 to-secondary/5 rounded-xl p-6 border border-primary/20 hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h4 class="font-semibold text-text-dark text-lg">{{ $categoria->nome }}</h4>
                                        <p class="text-sm text-text-light">{{ $categoria->produtos_count }} produto(s)</p>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-3xl font-bold text-primary-dark">
                                            {{ $categoria->produtos_count }}
                                        </div>
                                        <div class="w-12 h-2 bg-primary/20 rounded-full mt-2">
                                            <div class="h-2 bg-primary rounded-full" 
                                                 style="width: {{ $totalProdutos > 0 ? ($categoria->produtos_count / $totalProdutos) * 100 : 0 }}%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-3 text-center py-8">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                    </svg>
                                </div>
                                <p class="text-text-light font-medium">Nenhuma categoria cadastrada</p>
                                <a href="{{ route('categorias.create') }}" 
                                   class="text-link hover:text-primary-dark text-sm font-medium mt-2 inline-block">
                                    Criar primeira categoria
                                </a>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Produtos com Estoque Baixo -->
            @if($produtosEstoqueBaixo > 0 || $produtosSemEstoque > 0)
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border-l-4 border-red-500">
                    <div class="p-6">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center mr-4">
                                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-text-dark flex items-center">
                                    🚨 Alertas de Estoque
                                </h3>
                                <p class="text-sm text-text-light">Produtos que precisam de atenção</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @if($produtosSemEstoque > 0)
                                <div class="bg-red-50 border-2 border-red-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                                                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-lg font-bold text-red-800">{{ $produtosSemEstoque }}</h4>
                                            <p class="text-sm font-medium text-red-700">Produtos sem estoque</p>
                                            <p class="text-xs text-red-600 mt-1">Reposição urgente necessária</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            @if($produtosEstoqueBaixo > 0)
                                <div class="bg-yellow-50 border-2 border-yellow-200 rounded-xl p-6 hover:shadow-lg transition-all duration-300">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                                                <svg class="h-6 w-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-lg font-bold text-yellow-800">{{ $produtosEstoqueBaixo }}</h4>
                                            <p class="text-sm font-medium text-yellow-700">Estoque baixo</p>
                                            <p class="text-xs text-yellow-600 mt-1">Planeje a reposição</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        
                        <div class="mt-6 flex flex-wrap gap-4">
                            <a href="{{ route('produtos.index', ['estoque_status' => 'sem_estoque']) }}" 
                               class="inline-flex items-center px-4 py-2 bg-red-100 hover:bg-red-200 text-red-800 font-medium text-sm rounded-lg transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                Ver produtos sem estoque
                            </a>
                            <a href="{{ route('produtos.index', ['estoque_status' => 'estoque_baixo']) }}" 
                               class="inline-flex items-center px-4 py-2 bg-yellow-100 hover:bg-yellow-200 text-yellow-800 font-medium text-sm rounded-lg transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                </svg>
                                Ver produtos com estoque baixo
                            </a>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Call to Action -->
            <div class="bg-gradient-to-r from-primary via-primary-dark to-secondary rounded-2xl p-8 text-center">
                <div class="max-w-3xl mx-auto">
                    <h3 class="text-2xl font-bold text-white mb-4">
                        🚀 Sistema funcionando perfeitamente!
                    </h3>
                    <p class="text-white/90 mb-6">
                        Migração CodeIgniter → Laravel concluída em 30h por <strong>Marcelo Logan</strong>
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('pedidos.index') }}" 
                           class="bg-white text-primary-dark px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                            🛒 Gerenciar Pedidos
                        </a>
                        <a href="{{ route('produtos.create') }}" 
                           class="bg-secondary-dark text-white px-6 py-3 rounded-lg font-semibold hover:bg-secondary transition-colors">
                            ➕ Adicionar Produto
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>