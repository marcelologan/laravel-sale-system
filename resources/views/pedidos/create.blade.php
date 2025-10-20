<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-secondary/20 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-secondary-dark" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-text-dark leading-tight">
                        Novo Pedido
                    </h2>
                    <p class="text-text-light text-sm">Crie um novo pedido para o cliente</p>
                </div>
            </div>
            <a href="{{ route('pedidos.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" />
                </svg>
                Voltar
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Alertas de Feedback -->
            @if (session('success'))
                <div class="bg-green-50 border-2 border-green-200 text-green-800 px-6 py-4 rounded-xl">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-50 border-2 border-red-200 text-red-800 px-6 py-4 rounded-xl">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                        </svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-50 border-2 border-red-200 text-red-800 px-6 py-4 rounded-xl">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                        </svg>
                        <strong>Ops! Alguns campos precisam ser corrigidos:</strong>
                    </div>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="pedidoForm" method="POST" action="{{ route('pedidos.store') }}">
                @csrf

                <!-- Card de Informações do Pedido -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-secondary/20">
                    <div class="p-8">

                        <!-- Header do Card -->
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 bg-secondary/20 rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-5 h-5 text-secondary-dark" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M9 17H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2zm2-7h-1V8c0-2.76-2.24-5-5-5S8 5.24 8 8v2H7c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V12c0-1.1-.9-2-2-2zm-8 0V8c0-1.66 1.34-3 3-3s3 1.34 3 3v2H10z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xl font-bold text-text-dark">📋 Informações do Pedido</h4>
                                <p class="text-sm text-text-light">Dados básicos do pedido</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- Cliente -->
                            <div>
                                <label for="cliente_id" class="block text-sm font-semibold text-text-dark mb-2">
                                    👤 Cliente <span class="text-red-500">*</span>
                                </label>
                                <select name="cliente_id" id="cliente_id" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary transition-all @error('cliente_id') border-red-500 ring-2 ring-red-200 @enderror">
                                    <option value="">Selecione um cliente...</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}"
                                            {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                            {{ $cliente->nome }}
                                            @if ($cliente->telefone)
                                                - {{ $cliente->telefone }}
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                @error('cliente_id')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Data do Pedido -->
                            <div>
                                <label for="data_pedido" class="block text-sm font-semibold text-text-dark mb-2">
                                    📅 Data do Pedido
                                </label>
                                <input type="date" name="data_pedido" id="data_pedido"
                                    value="{{ old('data_pedido', date('Y-m-d')) }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary transition-all @error('data_pedido') border-red-500 ring-2 ring-red-200 @enderror">
                                @error('data_pedido')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                        </div>

                        <!-- Observações -->
                        <div class="mt-6">
                            <label for="observacoes" class="block text-sm font-semibold text-text-dark mb-2">
                                📝 Observações
                            </label>
                            <textarea name="observacoes" id="observacoes" rows="3" placeholder="Observações sobre o pedido..."
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary transition-all @error('observacoes') border-red-500 ring-2 ring-red-200 @enderror">{{ old('observacoes') }}</textarea>
                            @error('observacoes')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Card de Produtos -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-primary/20">
                    <div class="p-8">

                        <!-- Header do Card -->
                        <div class="flex justify-between items-center mb-6">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-primary/20 rounded-xl flex items-center justify-center mr-4">
                                    <svg class="w-5 h-5 text-primary-dark" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M7 4V2C7 1.45 7.45 1 8 1H16C16.55 1 17 1.45 17 2V4H20C20.55 4 21 4.45 21 5S20.55 6 20 6H19V19C19 20.1 18.1 21 17 21H7C5.9 21 5 20.1 5 19V6H4C3.45 6 3 5.55 3 5S3.45 4 4 4H7Z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-xl font-bold text-text-dark">🛒 Produtos do Pedido</h4>
                                    <p class="text-sm text-text-light">Adicione produtos ao pedido</p>
                                </div>
                            </div>
                            <button type="button" id="btnAdicionarProduto"
                                class="bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 4v16m8-8H4" />
                                </svg>
                                Adicionar Produto
                            </button>
                        </div>

                        <!-- Seleção de Produto -->
                        <div id="selecaoProduto"
                            class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6 p-6 bg-gradient-to-r from-primary/5 to-secondary/5 rounded-xl border border-primary/20">

                            <!-- Produto -->
                            <div class="md:col-span-2">
                                <label for="produto_select" class="block text-sm font-semibold text-text-dark mb-2">
                                    📦 Produto
                                </label>
                                <select id="produto_select"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                                    <option value="">Selecione um produto...</option>
                                    @foreach ($produtos as $produto)
                                        <option value="{{ $produto->id }}" data-preco="{{ $produto->preco }}"
                                            data-estoque="{{ $produto->estoque }}" data-nome="{{ $produto->nome }}">
                                            {{ $produto->nome }} - R$
                                            {{ number_format($produto->preco, 2, ',', '.') }}
                                            (Estoque: {{ $produto->estoque }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Quantidade -->
                            <div>
                                <label for="quantidade_input" class="block text-sm font-semibold text-text-dark mb-2">
                                    🔢 Quantidade
                                </label>
                                <input type="number" id="quantidade_input" min="1" value="1"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                            </div>

                            <!-- Botão Adicionar -->
                            <div class="flex items-end">
                                <button type="button" id="btnAdicionarItem"
                                    class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105">
                                    ➕ Adicionar
                                </button>
                            </div>

                        </div>

                        <!-- Lista de Produtos Adicionados -->
                        <div id="listaProdutos">

                            <!-- Estado Vazio -->
                            <div id="produtosVazio" class="text-center py-16">
                                <div
                                    class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-text-dark mb-2">🛒 Nenhum produto adicionado</h3>
                                <p class="text-text-light mb-4">Use o formulário acima para adicionar produtos ao
                                    pedido</p>
                                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 max-w-md mx-auto">
                                    <p class="text-blue-800 text-sm">
                                        💡 <strong>Dica:</strong> Selecione um produto, defina a quantidade e clique em
                                        "Adicionar"
                                    </p>
                                </div>
                            </div>

                            <!-- Tabela de produtos (será preenchida via JavaScript) -->
                            <div id="tabelaProdutos" class="hidden">
                                <div class="overflow-x-auto">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gradient-to-r from-primary/10 to-secondary/10">
                                            <tr>
                                                <th
                                                    class="px-6 py-4 text-left text-xs font-bold text-text-dark uppercase tracking-wider">
                                                    📦 Produto</th>
                                                <th
                                                    class="px-6 py-4 text-left text-xs font-bold text-text-dark uppercase tracking-wider">
                                                    💰 Preço Unit.</th>
                                                <th
                                                    class="px-6 py-4 text-left text-xs font-bold text-text-dark uppercase tracking-wider">
                                                    🔢 Quantidade</th>
                                                <th
                                                    class="px-6 py-4 text-left text-xs font-bold text-text-dark uppercase tracking-wider">
                                                    💵 Subtotal</th>
                                                <th
                                                    class="px-6 py-4 text-left text-xs font-bold text-text-dark uppercase tracking-wider">
                                                    ⚡ Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody id="corpoTabelaProdutos" class="bg-white divide-y divide-gray-200">
                                            <!-- Produtos serão adicionados aqui via JavaScript -->
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Total -->
                                <div class="mt-6 flex justify-end">
                                    <div
                                        class="bg-gradient-to-r from-secondary/10 to-primary/10 p-6 rounded-xl border border-secondary/20">
                                        <div class="text-center">
                                            <div class="text-sm text-text-light mb-1">💰 Total do Pedido</div>
                                            <div class="text-3xl font-bold text-secondary-dark" id="valorTotal">R$
                                                0,00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @error('produtos')
                            <p class="mt-4 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Botões de Ação -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-200">
                    <div class="p-6">
                        <div class="flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">

                            <!-- Informações -->
                            <div class="text-sm text-text-light flex items-center">
                                <svg class="w-4 h-4 mr-1 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                                </svg>
                                * Campos obrigatórios
                            </div>

                            <!-- Botões -->
                            <div class="flex space-x-4">
                                <a href="{{ route('pedidos.index') }}"
                                    class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300">
                                    ← Voltar
                                </a>

                                <button type="button" onclick="limparFormulario()"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300">
                                    🔄 Limpar
                                </button>

                                <button type="submit" id="btnSalvar"
                                    class="bg-secondary hover:bg-secondary-dark text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                                    </svg>
                                    Salvar Pedido
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <!-- JavaScript para Gerenciamento do Pedido -->
    <script>
        // Array para armazenar os produtos do pedido
        let produtosPedido = [];
        let contadorItens = 0;

        document.addEventListener('DOMContentLoaded', function() {
            // Elementos do DOM
            const btnAdicionarItem = document.getElementById('btnAdicionarItem');
            const produtoSelect = document.getElementById('produto_select');
            const quantidadeInput = document.getElementById('quantidade_input');
            const produtosVazio = document.getElementById('produtosVazio');
            const tabelaProdutos = document.getElementById('tabelaProdutos');
            const corpoTabela = document.getElementById('corpoTabelaProdutos');
            const valorTotal = document.getElementById('valorTotal');

            // Event listeners
            btnAdicionarItem.addEventListener('click', adicionarProduto);

            // Função para adicionar produto
            function adicionarProduto() {
                const produtoId = produtoSelect.value;
                const quantidade = parseInt(quantidadeInput.value);

                if (!produtoId) {
                    alert('Selecione um produto!');
                    return;
                }

                if (!quantidade || quantidade <= 0) {
                    alert('Informe uma quantidade válida!');
                    return;
                }

                const option = produtoSelect.options[produtoSelect.selectedIndex];
                const nome = option.dataset.nome;
                const preco = parseFloat(option.dataset.preco);
                const estoque = parseInt(option.dataset.estoque);

                if (quantidade > estoque) {
                    alert(`Quantidade indisponível! Estoque: ${estoque}`);
                    return;
                }

                // Verificar se produto já foi adicionado
                const produtoExistente = produtosPedido.find(p => p.id == produtoId);
                if (produtoExistente) {
                    if (produtoExistente.quantidade + quantidade > estoque) {
                        alert(`Quantidade total excede o estoque! Estoque: ${estoque}`);
                        return;
                    }
                    produtoExistente.quantidade += quantidade;
                    produtoExistente.subtotal = produtoExistente.quantidade * produtoExistente.preco;
                } else {
                    produtosPedido.push({
                        id: produtoId,
                        nome: nome,
                        preco: preco,
                        quantidade: quantidade,
                        subtotal: preco * quantidade,
                        index: contadorItens++
                    });
                }

                atualizarTabela();
                limparSelecao();
            }

            // Função para remover produto
            window.removerProduto = function(index) {
                produtosPedido = produtosPedido.filter(p => p.index !== index);
                atualizarTabela();
            }

            // Função para atualizar quantidade
            window.atualizarQuantidade = function(index, novaQuantidade) {
                const produto = produtosPedido.find(p => p.index === index);
                if (produto) {
                    const option = Array.from(produtoSelect.options).find(opt => opt.value == produto.id);
                    const estoque = parseInt(option.dataset.estoque);

                    if (novaQuantidade > estoque) {
                        alert(`Quantidade excede o estoque! Estoque: ${estoque}`);
                        return;
                    }

                    produto.quantidade = novaQuantidade;
                    produto.subtotal = produto.preco * novaQuantidade;
                    atualizarTabela();
                }
            }

            // Função para atualizar a tabela
            function atualizarTabela() {
                if (produtosPedido.length === 0) {
                    produtosVazio.classList.remove('hidden');
                    tabelaProdutos.classList.add('hidden');
                    return;
                }

                produtosVazio.classList.add('hidden');
                tabelaProdutos.classList.remove('hidden');

                let html = '';
                let total = 0;

                produtosPedido.forEach(produto => {
                    total += produto.subtotal;
                    html += `
                        <tr class="hover:bg-primary/5 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-semibold text-text-dark">${produto.nome}</div>
                                <input type="hidden" name="produtos[${produto.index}][produto_id]" value="${produto.id}">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-text-dark">R$ ${produto.preco.toFixed(2).replace('.', ',')}</div>
                                <input type="hidden" name="produtos[${produto.index}][preco_unitario]" value="${produto.preco}">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="number" 
                                       value="${produto.quantidade}" 
                                       min="1"
                                       onchange="atualizarQuantidade(${produto.index}, this.value)"
                                       name="produtos[${produto.index}][quantidade]"
                                       class="w-20 px-2 py-1 border border-gray-300 rounded-lg text-center focus:outline-none focus:ring-2 focus:ring-primary">
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-bold text-secondary-dark">R$ ${produto.subtotal.toFixed(2).replace('.', ',')}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button type="button" 
                                        onclick="removerProduto(${produto.index})"
                                        class="bg-red-100 text-red-800 hover:bg-red-500 hover:text-white px-3 py-2 rounded-lg transition-all duration-300 text-sm">
                                    🗑️ Remover
                                </button>
                            </td>
                        </tr>
                    `;
                });

                corpoTabela.innerHTML = html;
                valorTotal.textContent = `R$ ${total.toFixed(2).replace('.', ',')}`;
            }

            // Função para limpar seleção
            function limparSelecao() {
                produtoSelect.value = '';
                quantidadeInput.value = '1';
            }

            // Função global para limpar formulário
            window.limparFormulario = function() {
                if (confirm('Tem certeza que deseja limpar o formulário? Todos os produtos serão removidos.')) {
                    produtosPedido = [];
                    contadorItens = 0;
                    atualizarTabela();
                    document.getElementById('pedidoForm').reset();
                    document.getElementById('data_pedido').value = new Date().toISOString().split('T')[0];
                }
            }
        });
    </script>
</x-app-layout>
