<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes do Pedido #' . $pedido->id) }}
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

            <!-- Header com Ações -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">Pedido #{{ $pedido->id }}</h3>
                            <div class="mt-2 flex items-center space-x-4">
                                <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $pedido->status_cor }}">
                                    {{ ucfirst($pedido->status) }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    Criado em {{ $pedido->created_at->format('d/m/Y H:i') }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Ações do Pedido -->
                        <div class="flex space-x-2">
                            @if($pedido->podeSerEditado())
                                <a href="{{ route('pedidos.edit', $pedido) }}" 
                                   class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                    ✏️ Editar
                                </a>
                            @endif

                            @if($pedido->status === 'pendente')
                                <button onclick="confirmarPedido({{ $pedido->id }})" 
                                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                    ✅ Confirmar
                                </button>
                            @endif

                            @if($pedido->status === 'confirmado')
                                <button onclick="entregarPedido({{ $pedido->id }})" 
                                        class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                                    🚚 Marcar como Entregue
                                </button>
                            @endif

                            @if($pedido->podeSerCancelado())
                                <button onclick="cancelarPedido({{ $pedido->id }})" 
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    ❌ Cancelar
                                </button>
                            @endif

                            <button onclick="imprimirPedido()" 
                                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                🖨️ Imprimir
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Coluna Principal -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Informações do Cliente -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">👤 Informações do Cliente</h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nome</label>
                                    <p class="mt-1 text-sm text-gray-900">{{ $pedido->cliente->nome }}</p>
                                </div>
                                
                                @if($pedido->cliente->email)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">E-mail</label>
                                        <p class="mt-1 text-sm text-gray-900">
                                            <a href="mailto:{{ $pedido->cliente->email }}" class="text-blue-600 hover:text-blue-800">
                                                {{ $pedido->cliente->email }}
                                            </a>
                                        </p>
                                    </div>
                                @endif
                                
                                @if($pedido->cliente->telefone)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Telefone</label>
                                        <p class="mt-1 text-sm text-gray-900">
                                            <a href="tel:{{ $pedido->cliente->telefone }}" class="text-blue-600 hover:text-blue-800">
                                                {{ $pedido->cliente->telefone }}
                                            </a>
                                        </p>
                                    </div>
                                @endif
                                
                                @if($pedido->cliente->endereco)
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700">Endereço</label>
                                        <p class="mt-1 text-sm text-gray-900">{{ $pedido->cliente->endereco }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Produtos do Pedido -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">🛒 Produtos do Pedido</h4>
                            
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Produto
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Preço Unit.
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Quantidade
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Subtotal
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($pedido->itens as $item)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        @if($item->produto->imagem)
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                <img class="h-10 w-10 rounded-lg object-cover" 
                                                                     src="{{ asset('storage/' . $item->produto->imagem) }}" 
                                                                     alt="{{ $item->produto->nome }}">
                                                            </div>
                                                        @else
                                                            <div class="flex-shrink-0 h-10 w-10 bg-gray-200 rounded-lg flex items-center justify-center">
                                                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                                </svg>
                                                            </div>
                                                        @endif
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">{{ $item->produto->nome }}</div>
                                                            @if($item->produto->codigo_barras)
                                                                <div class="text-sm text-gray-500 font-mono">{{ $item->produto->codigo_barras }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $item->preco_unitario_formatado }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-medium text-gray-900">{{ $item->quantidade }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm font-semibold text-gray-900">{{ $item->subtotal_formatado }}</div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Observações -->
                    @if($pedido->observacoes)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <h4 class="text-lg font-medium text-gray-900 mb-4">📝 Observações</h4>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-sm text-gray-700">{{ $pedido->observacoes }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    
                    <!-- Resumo do Pedido -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">📊 Resumo do Pedido</h4>
                            
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Data do Pedido:</span>
                                    <span class="text-sm font-medium">{{ $pedido->data_pedido_formatada }}</span>
                                </div>
                                
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Status:</span>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $pedido->status_cor }}">
                                        {{ ucfirst($pedido->status) }}
                                    </span>
                                </div>
                                
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Total de Itens:</span>
                                    <span class="text-sm font-medium">{{ $pedido->itens->count() }}</span>
                                </div>
                                
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Quantidade Total:</span>
                                    <span class="text-sm font-medium">{{ $pedido->itens->sum('quantidade') }} unidade(s)</span>
                                </div>
                                
                                <hr class="my-3">
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-semibold text-gray-900">Valor Total:</span>
                                    <span class="text-xl font-bold text-blue-600">{{ $pedido->valor_total_formatado }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Histórico de Status -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">📅 Histórico</h4>
                            
                            <div class="space-y-3">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <div class="h-3 w-3 bg-blue-400 rounded-full"></div>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">Pedido criado</p>
                                        <p class="text-xs text-gray-500">{{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                                
                                @if($pedido->status !== 'pendente')
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="h-3 w-3 bg-green-400 rounded-full"></div>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">Status: {{ ucfirst($pedido->status) }}</p>
                                            <p class="text-xs text-gray-500">{{ $pedido->updated_at->format('d/m/Y H:i') }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Ações Rápidas -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">⚡ Ações Rápidas</h4>
                            
                            <div class="space-y-2">
                                <a href="{{ route('pedidos.index') }}" 
                                   class="w-full bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded block text-center">
                                    ← Voltar à Lista
                                </a>
                                
                                <a href="{{ route('pedidos.create') }}" 
                                   class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded block text-center">
                                    📋 Novo Pedido
                                </a>
                                
                                <a href="{{ route('clientes.show', $pedido->cliente) }}" 
                                   class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded block text-center">
                                    👤 Ver Cliente
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        @vite(['resources/js/pedidos-show.js'])
    @endpush
</x-app-layout>