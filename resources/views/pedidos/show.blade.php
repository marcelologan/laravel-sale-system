<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes do Pedido') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Header com botões de ação -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-lg font-medium">Pedido #{{ $pedido->id }}</h3>
                            <p class="text-sm text-gray-500">{{ $pedido->data_pedido_formatada }}</p>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('pedidos.index') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                ← Voltar
                            </a>
                            
                            @if($pedido->podeSerEditado())
                                <a href="{{ route('pedidos.edit', $pedido) }}" 
                                   class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                    ✏️ Editar
                                </a>
                            @endif

                            @if($pedido->status === 'pendente')
                                <form action="{{ route('pedidos.confirmar', $pedido) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            onclick="showConfirmModal('Título', 'Mensagem', function() { /* ação */ })"
                                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                        ✅ Confirmar
                                    </button>
                                </form>
                            @endif

                            @if($pedido->status === 'confirmado')
                                <form action="{{ route('pedidos.entregar', $pedido) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" 
                                            onclick="showConfirmModal('Título', 'Mensagem', function() { /* ação */ })"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                        🚚 Entregar
                                    </button>
                                </form>
                            @endif

                            @if($pedido->podeSerCancelado())
                                <button onclick="openModal('cancelModal')" 
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    ❌ Cancelar
                                </button>
                            @endif

                            @if($pedido->status === 'pendente')
                                <button onclick="openModal('deleteModal')" 
                                        class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded">
                                    🗑️ Excluir
                                </button>
                            @endif
                        </div>
                    </div>

                    <!-- Informações principais do pedido -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                        
                        <!-- Status e Valor -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Status do Pedido</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Status:</span>
                                    <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $pedido->status_cor }}">
                                        {{ ucfirst($pedido->status) }}
                                    </span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Valor Total:</span>
                                    <span class="text-lg font-bold text-green-600">{{ $pedido->valor_total_formatado }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Itens:</span>
                                    <span class="font-medium">{{ $pedido->itens->count() }} produto(s)</span>
                                </div>
                            </div>
                        </div>

                        <!-- Informações do Cliente -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Cliente</h4>
                            <div class="space-y-2">
                                <div>
                                    <span class="text-sm text-gray-600">Nome:</span>
                                    <div class="font-medium">{{ $pedido->cliente->nome }}</div>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-600">Email:</span>
                                    <div class="font-medium">{{ $pedido->cliente->email }}</div>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-600">CPF:</span>
                                    <div class="font-medium font-mono">{{ $pedido->cliente->cpf }}</div>
                                </div>
                                @if($pedido->cliente->telefone)
                                    <div>
                                        <span class="text-sm text-gray-600">Telefone:</span>
                                        <div class="font-medium">{{ $pedido->cliente->telefone }}</div>
                                    </div>
                                @endif
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('clientes.show', $pedido->cliente) }}" 
                                   class="text-blue-600 hover:text-blue-900 text-sm">
                                    Ver perfil do cliente →
                                </a>
                            </div>
                        </div>

                        <!-- Informações do Pedido -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h4 class="text-lg font-medium text-gray-900 mb-4">Informações</h4>
                            <div class="space-y-2">
                                <div>
                                    <span class="text-sm text-gray-600">Data do Pedido:</span>
                                    <div class="font-medium">{{ $pedido->data_pedido_formatada }}</div>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-600">Criado em:</span>
                                    <div class="font-medium">{{ \Carbon\Carbon::parse($pedido->created_at)->format('d/m/Y H:i') }}</div>
                                </div>
                                <div>
                                    <span class="text-sm text-gray-600">Atualizado em:</span>
                                    <div class="font-medium">{{ \Carbon\Carbon::parse($pedido->updated_at)->format('d/m/Y H:i') }}</div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Observações -->
                    @if($pedido->observacoes)
                        <div class="mb-8">
                            <h4 class="text-lg font-medium text-gray-900 mb-3">Observações</h4>
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                <p class="text-gray-800">{{ $pedido->observacoes }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Itens do Pedido -->
                    <div class="mb-8">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Itens do Pedido</h4>
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Produto
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Categoria
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
                                                        <img class="h-12 w-12 rounded object-cover mr-4" 
                                                             src="{{ asset('storage/' . $item->produto->imagem) }}" 
                                                             alt="{{ $item->produto->nome }}">
                                                    @else
                                                        <div class="h-12 w-12 bg-gray-200 rounded flex items-center justify-center mr-4">
                                                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">{{ $item->produto->nome }}</div>
                                                        @if($item->produto->codigo_barras)
                                                            <div class="text-sm text-gray-500 font-mono">{{ $item->produto->codigo_barras }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $item->produto->categoria->nome }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $item->preco_unitario_formatado }}</div>
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
                                <tfoot class="bg-gray-50">
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-right font-medium text-gray-900">
                                            Total do Pedido:
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-lg font-bold text-green-600">{{ $pedido->valor_total_formatado }}</div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!-- Histórico de Status (se necessário) -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">Resumo do Pedido</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm">
                            <div>
                                <span class="text-gray-600">Quantidade de itens:</span>
                                <div class="font-medium">{{ $pedido->itens->sum('quantidade') }} unidades</div>
                            </div>
                            <div>
                                <span class="text-gray-600">Tipos de produtos:</span>
                                <div class="font-medium">{{ $pedido->itens->count() }} diferentes</div>
                            </div>
                            <div>
                                <span class="text-gray-600">Valor médio por item:</span>
                                <div class="font-medium">
                                    R$ {{ number_format($pedido->valor_total / $pedido->itens->sum('quantidade'), 2, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmação de Cancelamento -->
    @if($pedido->podeSerCancelado())
        <x-modal id="cancelModal" title="Cancelar Pedido" type="warning">
            <div class="text-sm text-gray-500">
                <p class="mb-4">Tem certeza que deseja cancelar o pedido <strong>#{{ $pedido->id }}</strong>?</p>
                @if($pedido->status === 'confirmado')
                    <div class="bg-yellow-50 border border-yellow-200 rounded-md p-3 mb-4">
                        <p class="text-yellow-800 text-xs">
                            ⚠️ <strong>Atenção:</strong> Este pedido já foi confirmado. Ao cancelar, o estoque dos produtos será devolvido automaticamente.
                        </p>
                    </div>
                @endif
            </div>

            <x-slot name="actions">
                <button type="button" 
                        onclick="closeModal('cancelModal')" 
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                    Voltar
                </button>
                <form action="{{ route('pedidos.cancelar', $pedido) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" 
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">
                        ❌ Sim, Cancelar
                    </button>
                </form>
            </x-slot>
        </x-modal>
    @endif

    <!-- Modal de Confirmação de Exclusão -->
    @if($pedido->status === 'pendente')
        <x-modal id="deleteModal" title="Excluir Pedido" type="danger">
            <div class="text-sm text-gray-500">
                <p class="mb-4">Tem certeza que deseja excluir permanentemente o pedido <strong>#{{ $pedido->id }}</strong>?</p>
                <div class="bg-red-50 border border-red-200 rounded-md p-3">
                    <p class="text-red-800 text-xs">
                        ⚠️ <strong>Atenção:</strong> Esta ação não pode ser desfeita. Todos os dados do pedido serão permanentemente removidos.
                    </p>
                </div>
            </div>

            <x-slot name="actions">
                <button type="button" 
                        onclick="closeModal('deleteModal')" 
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                    Cancelar
                </button>
                <form action="{{ route('pedidos.destroy', $pedido) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">
                        🗑️ Sim, Excluir
                    </button>
                </form>
            </x-slot>
        </x-modal>
    @endif

</x-app-layout>