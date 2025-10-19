<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Pedido') }}
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

            @if($errors->any())
                <div class="mb-6">
                    <x-alert type="error">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </x-alert>
                </div>
            @endif

            <form id="pedidoForm" method="POST" action="{{ route('pedidos.store') }}">
                @csrf

                <!-- Card de Informações do Pedido -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h4 class="text-lg font-medium text-gray-900 mb-4">📋 Informações do Pedido</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- Cliente -->
                            <div>
                                <label for="cliente_id" class="block text-sm font-medium text-gray-700 mb-1">
                                    Cliente <span class="text-red-500">*</span>
                                </label>
                                <select name="cliente_id" 
                                        id="cliente_id"
                                        required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Selecione um cliente...</option>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                            {{ $cliente->nome }}
                                            @if($cliente->telefone)
                                                - {{ $cliente->telefone }}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                @error('cliente_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Data do Pedido -->
                            <div>
                                <label for="data_pedido" class="block text-sm font-medium text-gray-700 mb-1">
                                    Data do Pedido
                                </label>
                                <input type="date" 
                                       name="data_pedido" 
                                       id="data_pedido"
                                       value="{{ old('data_pedido', date('Y-m-d')) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                @error('data_pedido')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <!-- Observações -->
                        <div class="mt-6">
                            <label for="observacoes" class="block text-sm font-medium text-gray-700 mb-1">
                                Observações
                            </label>
                            <textarea name="observacoes" 
                                      id="observacoes"
                                      rows="3"
                                      placeholder="Observações sobre o pedido..."
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('observacoes') }}</textarea>
                            @error('observacoes')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Card de Produtos -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h4 class="text-lg font-medium text-gray-900">🛒 Produtos do Pedido</h4>
                            <button type="button" 
                                    id="btnAdicionarProduto"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                ➕ Adicionar Produto
                            </button>
                        </div>

                        <!-- Seleção de Produto -->
                        <div id="selecaoProduto" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6 p-4 bg-gray-50 rounded-lg">
                            
                            <!-- Produto -->
                            <div class="md:col-span-2">
                                <label for="produto_select" class="block text-sm font-medium text-gray-700 mb-1">
                                    Produto
                                </label>
                                <select id="produto_select"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Selecione um produto...</option>
                                    @foreach($produtos as $produto)
                                        <option value="{{ $produto->id }}" 
                                                data-preco="{{ $produto->preco }}"
                                                data-estoque="{{ $produto->estoque }}"
                                                data-nome="{{ $produto->nome }}">
                                            {{ $produto->nome }} - {{ $produto->preco_formatado }}
                                            (Estoque: {{ $produto->estoque }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Quantidade -->
                            <div>
                                <label for="quantidade_input" class="block text-sm font-medium text-gray-700 mb-1">
                                    Quantidade
                                </label>
                                <input type="number" 
                                       id="quantidade_input"
                                       min="1"
                                       value="1"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Botão Adicionar -->
                            <div class="flex items-end">
                                <button type="button" 
                                        id="btnAdicionarItem"
                                        class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Adicionar
                                </button>
                            </div>

                        </div>

                        <!-- Lista de Produtos Adicionados -->
                        <div id="listaProdutos">
                            <div id="produtosVazio" class="text-center py-8 text-gray-500">
                                <svg class="h-12 w-12 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                                </svg>
                                <p>Nenhum produto adicionado ao pedido</p>
                                <p class="text-sm">Use o formulário acima para adicionar produtos</p>
                            </div>

                            <!-- Tabela de produtos (será preenchida via JavaScript) -->
                            <div id="tabelaProdutos" class="hidden">
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                            <tr>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produto</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Preço Unit.</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantidade</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subtotal</th>
                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody id="corpoTabelaProdutos" class="bg-white divide-y divide-gray-200">
                                            <!-- Produtos serão adicionados aqui via JavaScript -->
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Total -->
                                <div class="mt-4 flex justify-end">
                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <div class="text-lg font-semibold">
                                            Total do Pedido: <span id="valorTotal" class="text-blue-600">R$ 0,00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @error('produtos')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Botões de Ação -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between">
                            <a href="{{ route('pedidos.index') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                ← Voltar
                            </a>
                            
                            <div class="space-x-2">
                                <button type="button" 
                                        onclick="limparFormulario()"
                                        class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                    🔄 Limpar
                                </button>
                                <button type="submit" 
                                        id="btnSalvar"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    💾 Salvar Pedido
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    @push('scripts')
        @vite(['resources/js/pedidos-create.js'])
    @endpush
</x-app-layout>