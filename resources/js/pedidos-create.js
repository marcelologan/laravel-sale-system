/**
 * JavaScript para Create de Pedidos - VERSÃO SEGURA
 */

class PedidoManager {
    constructor() {
        this.produtos = [];
        this.init();
    }

    init() {
        this.initSelect2();
        this.bindEvents();
    }

    initSelect2() {
        // Select2 para cliente
        if (typeof $ !== 'undefined' && $.fn.select2) {
            $('#cliente_id').select2({
                placeholder: 'Selecione um cliente...',
                allowClear: true,
                width: '100%'
            });

            // Select2 para produtos
            $('#produto_select').select2({
                placeholder: 'Selecione um produto...',
                allowClear: true,
                width: '100%'
            });
        }
    }

    bindEvents() {
        // Adicionar produto
        document.getElementById('btnAdicionarItem').addEventListener('click', () => {
            this.adicionarProduto();
        });

        // Enter no campo quantidade
        document.getElementById('quantidade_input').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.adicionarProduto();
            }
        });

        // Validação do formulário
        document.getElementById('pedidoForm').addEventListener('submit', (e) => {
            if (!this.validarAntesSalvar()) {
                e.preventDefault();
                return false;
            }
        });
    }

    adicionarProduto() {
        const produtoSelect = document.getElementById('produto_select');
        const quantidadeInput = document.getElementById('quantidade_input');

        const produtoId = produtoSelect.value;
        const quantidade = parseInt(quantidadeInput.value);

        // Validações
        if (!produtoId) {
            alert('Selecione um produto.'); // ← USAR ALERT SIMPLES
            return;
        }

        if (!quantidade || quantidade <= 0) {
            alert('Informe uma quantidade válida.'); // ← USAR ALERT SIMPLES
            return;
        }

        const produtoOption = produtoSelect.options[produtoSelect.selectedIndex];
        const produtoNome = produtoOption.dataset.nome;
        const produtoPreco = parseFloat(produtoOption.dataset.preco);
        const produtoEstoque = parseInt(produtoOption.dataset.estoque);

        // Verificar estoque
        if (quantidade > produtoEstoque) {
            alert(`Produto "${produtoNome}" possui apenas ${produtoEstoque} unidade(s) em estoque.`); // ← USAR ALERT SIMPLES
            return;
        }

        // Verificar se produto já foi adicionado
        const produtoExistente = this.produtos.find(p => p.id === produtoId);
        if (produtoExistente) {
            const novaQuantidade = produtoExistente.quantidade + quantidade;
            if (novaQuantidade > produtoEstoque) {
                alert(`Quantidade total (${novaQuantidade}) excede o estoque disponível (${produtoEstoque}).`); // ← USAR ALERT SIMPLES
                return;
            }
            produtoExistente.quantidade = novaQuantidade;
            produtoExistente.subtotal = produtoExistente.quantidade * produtoExistente.preco;
        } else {
            // Adicionar novo produto
            this.produtos.push({
                id: produtoId,
                nome: produtoNome,
                preco: produtoPreco,
                quantidade: quantidade,
                subtotal: quantidade * produtoPreco,
                estoque: produtoEstoque
            });
        }

        // Limpar seleção
        $('#produto_select').val(null).trigger('change');
        quantidadeInput.value = 1;

        // Atualizar interface
        this.atualizarInterface();
    }

    removerProduto(produtoId) {
        if (confirm('Tem certeza que deseja remover este produto do pedido?')) { // ← USAR CONFIRM SIMPLES
            this.produtos = this.produtos.filter(p => p.id !== produtoId);
            this.atualizarInterface();
        }
    }

    editarQuantidade(produtoId, novaQuantidade) {
        const produto = this.produtos.find(p => p.id === produtoId);
        if (!produto) return;

        if (novaQuantidade <= 0) {
            this.removerProduto(produtoId);
            return;
        }

        if (novaQuantidade > produto.estoque) {
            alert(`Quantidade não pode ser maior que ${produto.estoque}.`); // ← USAR ALERT SIMPLES
            this.atualizarInterface(); // Restaurar valor anterior
            return;
        }

        produto.quantidade = novaQuantidade;
        produto.subtotal = produto.quantidade * produto.preco;
        this.atualizarInterface();
    }

    atualizarInterface() {
        const produtosVazio = document.getElementById('produtosVazio');
        const tabelaProdutos = document.getElementById('tabelaProdutos');
        const corpoTabela = document.getElementById('corpoTabelaProdutos');

        if (this.produtos.length === 0) {
            produtosVazio.classList.remove('hidden');
            tabelaProdutos.classList.add('hidden');
            this.atualizarTotal();
            return;
        }

        produtosVazio.classList.add('hidden');
        tabelaProdutos.classList.remove('hidden');

        // Limpar tabela
        corpoTabela.innerHTML = '';

        // Adicionar produtos na tabela
        this.produtos.forEach((produto, index) => {
            const row = document.createElement('tr');
            row.className = 'hover:bg-gray-50';
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">${produto.nome}</div>
                    <input type="hidden" name="produtos[${index}][produto_id]" value="${produto.id}">
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">R$ ${produto.preco.toFixed(2).replace('.', ',')}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <input type="number" 
                           min="1" 
                           max="${produto.estoque}"
                           value="${produto.quantidade}"
                           name="produtos[${index}][quantidade]"
                           onchange="window.pedidoManager.editarQuantidade('${produto.id}', parseInt(this.value))"
                           class="w-20 px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-semibold text-gray-900">R$ ${produto.subtotal.toFixed(2).replace('.', ',')}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <button type="button" 
                            onclick="window.pedidoManager.removerProduto('${produto.id}')"
                            class="text-red-600 hover:text-red-900">
                        🗑️ Remover
                    </button>
                </td>
            `;
            corpoTabela.appendChild(row);
        });

        this.atualizarTotal();
    }

    atualizarTotal() {
        const total = this.produtos.reduce((sum, produto) => sum + produto.subtotal, 0);
        document.getElementById('valorTotal').textContent = `R$ ${total.toFixed(2).replace('.', ',')}`;
    }

    validarAntesSalvar() {
        // Validar cliente
        const clienteId = document.getElementById('cliente_id').value;
        if (!clienteId) {
            alert('Selecione um cliente para o pedido.'); // ← USAR ALERT SIMPLES
            return false;
        }

        // Validar produtos
        if (this.produtos.length === 0) {
            alert('Adicione pelo menos um produto ao pedido.'); // ← USAR ALERT SIMPLES
            return false;
        }

        return true;
    }
}

// Funções globais
window.limparFormulario = function () {
    if (confirm('Tem certeza que deseja limpar todos os dados do formulário?')) { // ← USAR CONFIRM SIMPLES
        // Limpar selects
        $('#cliente_id').val(null).trigger('change');
        $('#produto_select').val(null).trigger('change');

        // Limpar campos
        document.getElementById('data_pedido').value = new Date().toISOString().split('T')[0];
        document.getElementById('observacoes').value = '';
        document.getElementById('quantidade_input').value = 1;

        // Limpar produtos
        window.pedidoManager.produtos = [];
        window.pedidoManager.atualizarInterface();
    }
};

// Inicializar quando DOM estiver pronto
document.addEventListener('DOMContentLoaded', function () {
    // Destruir instância existente se houver
    if (window.pedidoManager) {
        delete window.pedidoManager;
    }

    // Criar nova instância
    window.pedidoManager = new PedidoManager();
});