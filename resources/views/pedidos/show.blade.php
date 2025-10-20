<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-link/20 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-link" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-text-dark leading-tight">
                        Detalhes do Pedido
                    </h2>
                    <p class="text-text-light text-sm">Informações completas do pedido</p>
                </div>
            </div>
            <div class="flex space-x-3">
                @if($pedido->podeSerEditado())
                    <a href="{{ route('pedidos.edit', $pedido) }}" 
                       class="bg-secondary hover:bg-secondary-dark text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                        </svg>
                        Editar
                    </a>
                @endif

                @if($pedido->status === 'pendente')
                    <form action="{{ route('pedidos.confirmar', $pedido) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" 
                                onclick="return confirm('Tem certeza que deseja confirmar este pedido?')"
                                class="bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                            </svg>
                            Confirmar
                        </button>
                    </form>
                @endif

                @if($pedido->status === 'confirmado')
                    <form action="{{ route('pedidos.entregar', $pedido) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" 
                                onclick="return confirm('Tem certeza que deseja marcar este pedido como entregue?')"
                                class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M8 16H6v2h2v-2zm0-4H6v2h2V12zm0-4H6v2h2V8zm2 8h8v-2h-8v2zm0-4h8v-2h-8v2zm0-4h8V8h-8v2z"/>
                            </svg>
                            Entregar
                        </button>
                    </form>
                @endif

                @if($pedido->podeSerCancelado())
                    <button onclick="openModal('cancelModal')" 
                            class="bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Cancelar
                    </button>
                @endif

                @if($pedido->status === 'pendente')
                    <button onclick="openModal('deleteModal')" 
                            class="bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Excluir
                    </button>
                @endif

                <a href="{{ route('pedidos.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                    </svg>
                    Voltar
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Alertas de Feedback -->
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-2 border-green-200 text-green-800 px-6 py-4 rounded-xl">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-50 border-2 border-red-200 text-red-800 px-6 py-4 rounded-xl">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Coluna Principal -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Card Principal do Pedido -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-secondary/20">
                        <div class="p-8">
                            
                            <!-- Header do Pedido -->
                            <div class="flex items-center justify-between mb-8">
                                <div class="flex items-center">
                                    <div class="w-16 h-16 bg-secondary/20 rounded-full flex items-center justify-center mr-4">
                                        <svg class="w-8 h-8 text-secondary-dark" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M7 4V2C7 1.45 7.45 1 8 1H16C16.55 1 17 1.45 17 2V4H20C20.55 4 21 4.45 21 5S20.55 6 20 6H19V19C19 20.1 18.1 21 17 21H7C5.9 21 5 20.1 5 19V6H4C3.45 6 3 5.55 3 5S3.45 4 4 4H7Z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-3xl font-bold text-text-dark">Pedido #{{ $pedido->id }}</h3>
                                        <p class="text-text-light">{{ $pedido->data_pedido_formatada }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="px-4 py-2 text-sm font-semibold rounded-full {{ $pedido->status_cor }}">
                                        @switch($pedido->status)
                                            @case('pendente')
                                                ⏳ Pendente
                                                @break
                                            @case('confirmado')
                                                ✅ Confirmado
                                                @break
                                            @case('entregue')
                                                🚚 Entregue
                                                @break
                                            @case('cancelado')
                                                ❌ Cancelado
                                                @break
                                        @endswitch
                                    </span>
                                </div>
                            </div>

                            <!-- Valor Total Destacado -->
                            <div class="bg-gradient-to-r from-secondary/10 to-primary/10 rounded-xl p-6 mb-8 border border-secondary/20">
                                <div class="text-center">
                                    <div class="text-sm text-text-light mb-2">💰 Valor Total do Pedido</div>
                                    <div class="text-4xl font-bold text-secondary-dark">{{ $pedido->valor_total_formatado }}</div>
                                    <div class="text-sm text-text-light mt-2">{{ $pedido->itens->count() }} produto(s) • {{ $pedido->itens->sum('quantidade') }} unidades</div>
                                </div>
                            </div>

                            <!-- Grid de Informações -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                
                                <!-- Informações do Cliente -->
                                <div class="bg-gray-50 rounded-xl p-6">
                                    <h4 class="text-lg font-bold text-text-dark mb-4 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-primary-dark" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                        👤 Cliente
                                    </h4>
                                    <div class="space-y-3">
                                        <div>
                                            <span class="text-sm text-text-light">Nome:</span>
                                            <div class="font-semibold text-text-dark">{{ $pedido->cliente->nome }}</div>
                                        </div>
                                        <div>
                                            <span class="text-sm text-text-light">Email:</span>
                                            <div class="font-medium text-text-dark">{{ $pedido->cliente->email }}</div>
                                        </div>
                                        <div>
                                            <span class="text-sm text-text-light">CPF:</span>
                                            <div class="font-medium text-text-dark font-mono">{{ $pedido->cliente->cpf }}</div>
                                        </div>
                                        @if($pedido->cliente->telefone)
                                            <div>
                                                <span class="text-sm text-text-light">Telefone:</span>
                                                <div class="font-medium text-text-dark">{{ $pedido->cliente->telefone }}</div>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="mt-4">
                                        <a href="{{ route('clientes.show', $pedido->cliente) }}" 
                                           class="text-link hover:text-primary-dark font-medium text-sm flex items-center">
                                            Ver perfil do cliente
                                            <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <!-- Informações do Pedido -->
                                <div class="bg-gray-50 rounded-xl p-6">
                                    <h4 class="text-lg font-bold text-text-dark mb-4 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-secondary-dark" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M9 17H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2zm2-7h-1V8c0-2.76-2.24-5-5-5S8 5.24 8 8v2H7c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V12c0-1.1-.9-2-2-2zm-8 0V8c0-1.66 1.34-3 3-3s3 1.34 3 3v2H10z"/>
                                        </svg>
                                        ℹ️ Informações
                                    </h4>
                                    <div class="space-y-3">
                                        <div>
                                            <span class="text-sm text-text-light">Data do Pedido:</span>
                                            <div class="font-semibold text-text-dark">{{ $pedido->data_pedido_formatada }}</div>
                                        </div>
                                        <div>
                                            <span class="text-sm text-text-light">Criado em:</span>
                                            <div class="font-medium text-text-dark">{{ \Carbon\Carbon::parse($pedido->created_at)->format('d/m/Y H:i') }}</div>
                                        </div>
                                        <div>
                                            <span class="text-sm text-text-light">Atualizado em:</span>
                                            <div class="font-medium text-text-dark">{{ \Carbon\Carbon::parse($pedido->updated_at)->format('d/m/Y H:i') }}</div>
                                        </div>
                                        <div>
                                            <span class="text-sm text-text-light">Tempo decorrido:</span>
                                            <div class="font-medium text-text-dark">{{ $pedido->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!-- Observações -->
                    @if($pedido->observacoes)
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-yellow-200">
                            <div class="p-6">
                                <h4 class="text-lg font-bold text-text-dark mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-yellow-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M11 15h2v2h-2zm0-8h2v6h-2zm.99-5C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zM12 20c-4.42 0-8-3.58-8-8s3.58-8 8-8 8 3.58 8 8-3.58 8-8 8z"/>
                                    </svg>
                                    📝 Observações
                                </h4>
                                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                                    <p class="text-text-dark leading-relaxed">{{ $pedido->observacoes }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Itens do Pedido -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-primary/20">
                        <div class="p-6">
                            <h4 class="text-xl font-bold text-text-dark mb-6 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-primary-dark" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M7 4V2C7 1.45 7.45 1 8 1H16C16.55 1 17 1.45 17 2V4H20C20.55 4 21 4.45 21 5S20.55 6 20 6H19V19C19 20.1 18.1 21 17 21H7C5.9 21 5 20.1 5 19V6H4C3.45 6 3 5.55 3 5S3.45 4 4 4H7Z"/>
                                </svg>
                                🛒 Itens do Pedido
                            </h4>
                            
                            <div class="space-y-4">
                                @foreach($pedido->itens as $item)
                                    <div class="bg-gradient-to-r from-primary/5 to-secondary/5 rounded-xl p-4 border border-primary/20 hover:shadow-lg transition-all duration-300">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                @if($item->produto->imagem)
                                                    <img class="h-16 w-16 rounded-lg object-cover mr-4 border border-gray-200" 
                                                         src="{{ asset('storage/' . $item->produto->imagem) }}" 
                                                         alt="{{ $item->produto->nome }}">
                                                @else
                                                    <div class="h-16 w-16 bg-gray-200 rounded-lg flex items-center justify-center mr-4">
                                                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                        </svg>
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="text-lg font-bold text-text-dark">{{ $item->produto->nome }}</div>
                                                    <div class="text-sm text-text-light">{{ $item->produto->categoria->nome }}</div>
                                                    @if($item->produto->codigo_barras)
                                                        <div class="text-xs text-text-light font-mono">{{ $item->produto->codigo_barras }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="text-sm text-text-light">Preço unitário</div>
                                                <div class="text-lg font-semibold text-text-dark">{{ $item->preco_unitario_formatado }}</div>
                                                <div class="text-sm text-text-light">Qtd: {{ $item->quantidade }}</div>
                                            </div>
                                        </div>
                                        <div class="mt-4 flex justify-between items-center">
                                            <div class="text-sm text-text-light">Subtotal:</div>
                                            <div class="text-xl font-bold text-secondary-dark">{{ $item->subtotal_formatado }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Total Final -->
                            <div class="mt-6 bg-gradient-to-r from-secondary/10 to-primary/10 rounded-xl p-6 border border-secondary/20">
                                <div class="flex justify-between items-center">
                                    <div class="text-xl font-bold text-text-dark">💰 Total do Pedido:</div>
                                    <div class="text-3xl font-bold text-secondary-dark">{{ $pedido->valor_total_formatado }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    
                    <!-- Resumo do Pedido -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-link/20">
                        <div class="p-6">
                            <h4 class="text-lg font-semibold text-text-dark mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-link" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 17H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2zm2-7h-1V8c0-2.76-2.24-5-5-5S8 5.24 8 8v2H7c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V12c0-1.1-.9-2-2-2zm-8 0V8c0-1.66 1.34-3 3-3s3 1.34 3 3v2H10z"/>
                                </svg>
                                📊 Resumo
                            </h4>
                            
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-text-light">Status:</span>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $pedido->status_cor }}">
                                        {{ ucfirst($pedido->status) }}
                                    </span>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-text-light">Valor Total:</span>
                                    <span class="text-sm font-bold text-secondary-dark">{{ $pedido->valor_total_formatado }}</span>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-text-light">Quantidade de itens:</span>
                                    <span class="text-sm font-medium text-text-dark">{{ $pedido->itens->sum('quantidade') }} unidades</span>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-text-light">Tipos de produtos:</span>
                                    <span class="text-sm font-medium text-text-dark">{{ $pedido->itens->count() }} diferentes</span>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-text-light">Valor médio por item:</span>
                                    <span class="text-sm font-medium text-text-dark">
                                        R\$ {{ number_format($pedido->valor_total / $pedido->itens->sum('quantidade'), 2, ',', '.') }}
                                    </span>
                                </div>
                                
                                <hr class="my-3">
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-text-light">Criado:</span>
                                    <span class="text-xs text-text-light">{{ \Carbon\Carbon::parse($pedido->created_at)->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ações Rápidas -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-secondary/20">
                        <div class="p-6">
                            <h4 class="text-lg font-semibold text-text-dark mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-secondary-dark" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M13,9H11V7H13M13,17H11V11H13M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"/>
                                </svg>
                                ⚡ Ações Rápidas
                            </h4>
                            
                            <div class="space-y-3">
                                @if($pedido->podeSerEditado())
                                    <a href="{{ route('pedidos.edit', $pedido) }}" 
                                       class="w-full bg-secondary hover:bg-secondary-dark text-white font-semibold py-3 px-4 rounded-xl block text-center transition-all duration-300">
                                        ✏️ Editar Pedido
                                    </a>
                                @endif
                                
                                <a href="{{ route('clientes.show', $pedido->cliente) }}" 
                                   class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-3 px-4 rounded-xl block text-center transition-all duration-300">
                                    👤 Ver Cliente
                                </a>
                                
                                <a href="{{ route('pedidos.create') }}" 
                                   class="w-full bg-link hover:bg-blue-600 text-white font-semibold py-3 px-4 rounded-xl block text-center transition-all duration-300">
                                    ➕ Novo Pedido
                                </a>
                                
                                <a href="{{ route('pedidos.index') }}" 
                                   class="w-full bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-4 rounded-xl block text-center transition-all duration-300">
                                    📋 Lista de Pedidos
                                </a>

                                <button onclick="window.print()" 
                                        class="w-full bg-purple-500 hover:bg-purple-600 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300">
                                    🖨️ Imprimir Pedido
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmação de Cancelamento -->
    @if($pedido->podeSerCancelado())
        <div id="cancelModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white rounded-2xl p-8 max-w-md mx-4 shadow-2xl border border-yellow-200">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-text-dark">⚠️ Cancelar Pedido</h3>
                        <p class="text-sm text-text-light">Esta ação pode ser irreversível</p>
                    </div>
                </div>
                
                <div class="mb-6">
                    <p class="text-sm text-text-dark mb-4">
                        Tem certeza que deseja cancelar o pedido <strong class="text-yellow-600">#{{ $pedido->id }}</strong>?
                    </p>
                    @if($pedido->status === 'confirmado')
                        <div class="bg-yellow-50 border-2 border-yellow-200 rounded-xl p-4">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-yellow-600 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                                <div>
                                    <p class="text-yellow-800 text-sm font-semibold">Atenção:</p>
                                    <p class="text-yellow-700 text-xs mt-1">
                                        Este pedido já foi confirmado. Ao cancelar, o estoque dos produtos será devolvido automaticamente.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="flex space-x-3">
                    <button type="button" 
                            onclick="closeModal('cancelModal')" 
                            class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300">
                        Voltar
                    </button>
                    <form action="{{ route('pedidos.cancelar', $pedido) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" 
                                class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300">
                            ❌ Sim, Cancelar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Modal de Confirmação de Exclusão -->
    @if($pedido->status === 'pendente')
        <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white rounded-2xl p-8 max-w-md mx-4 shadow-2xl border border-red-200">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-text-dark">🗑️ Excluir Pedido</h3>
                        <p class="text-sm text-text-light">Esta ação não pode ser desfeita</p>
                    </div>
                </div>
                
                <div class="mb-6">
                    <p class="text-sm text-text-dark mb-4">
                        Tem certeza que deseja excluir permanentemente o pedido <strong class="text-red-600">#{{ $pedido->id }}</strong>?
                    </p>
                    <div class="bg-red-50 border-2 border-red-200 rounded-xl p-4">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-red-600 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                            <div>
                                <p class="text-red-800 text-sm font-semibold">Atenção:</p>
                                <p class="text-red-700 text-xs mt-1">
                                    Todos os dados do pedido serão permanentemente removidos do sistema.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex space-x-3">
                    <button type="button" 
                            onclick="closeModal('deleteModal')" 
                            class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300">
                        Cancelar
                    </button>
                    <form action="{{ route('pedidos.destroy', $pedido) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300">
                            🗑️ Sim, Excluir
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- JavaScript para Modais -->
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.getElementById(modalId).classList.add('flex');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.getElementById(modalId).classList.remove('flex');
        }

        // Fechar modal clicando fora
        document.addEventListener('click', function(event) {
            const modals = ['cancelModal', 'deleteModal'];
            modals.forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (modal && event.target === modal) {
                    closeModal(modalId);
                }
            });
        });

        // Fechar modal com ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal('cancelModal');
                closeModal('deleteModal');
            }
        });
    </script>
</x-app-layout>