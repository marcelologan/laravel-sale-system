/**
 * JavaScript para Edit de Pedidos
 */

class PedidoEditManager {
    constructor() {
        this.produtos = [];
        this.produtosOriginais = [];
        this.init();
    }

    init() {
        this.initSelect2();
        this.carregarProdutosExistentes();
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

    carregarProdutosExistentes() {
        if (window.pedidoData && window.pedidoData.itens) {
            this.produtos = window.pedidoData.itens.map(item => ({
                id: item.produto_id.toString(),
                nome: item.produto_nome,
                preco: parseFloat(item.preco_unitario),
                quantidade: parseInt(item.quantidade),
                subtotal: parseFloat(item.subtotal),
                estoque: parseInt(item.estoque_disponivel)
            }));

            // Fazer cópia dos produtos originais
            this.produtosOriginais = JSON.parse(JSON.stringify(this.produtos));
            
            this.atualizarInterface();
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
            alert('Selecione um produto.');
            return;
        }

        if (!quantidade || quantidade <= 0) {
            alert('Informe uma quantidade válida.');
            return;
        }

        const produtoOption = produtoSelect.options[produtoSelect.selectedIndex];
        const produtoNome = produtoOption.dataset.nome;
        const produtoPreco = parseFloat(produtoOption.dataset.preco);
        const produtoEstoque = parseInt(produtoOption.dataset.estoque);

        // Verificar estoque (considerando que pode estar editando um pedido confirmado)
        const estoqueDisponivel = this.calcularEstoqueDisponivel(produtoId, produtoEstoque);
        
        if (quantidade > estoqueDisponivel) {
            alert(`Produto "${produtoNome}" possui apenas ${estoqueDisponivel} unidade(s) disponíveis.`);
            return;
        }

        // Verificar se produto já foi adicionado
        const produtoExistente = this.produtos.find(p => p.id === produtoId);
        if (produtoExistente) {
            const novaQuantidade = produtoExistente.quantidade + quantidade;
            if (novaQuantidade > estoqueDisponivel) {
                alert(`Quantidade total (${novaQuantidade}) excede o estoque disponível (${estoqueDisponivel}).`);
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

    calcularEstoqueDisponivel(produtoId, estoqueAtual) {
        // Se o pedido está confirmado, precisa considerar o estoque que já estava reservado
        if (window.pedidoData.status === 'confirmado') {
            const itemOriginal = this.produtosOriginais.find(p => p.id === produtoId);
            if (itemOriginal) {
                return estoqueAtual + itemOriginal.quantidade;
            }
        }
        return estoqueAtual;
    }

    removerProduto(produtoId) {
        if (confirm('Tem certeza que deseja remover este produto do pedido?')) {
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

        const estoqueDisponivel = this.calcularEstoqueDisponivel(produtoId, produto.estoque);
        
        if (novaQuantidade > estoqueDisponivel) {
            alert(`Quantidade não pode ser maior que ${estoqueDisponivel}.`);
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
            const estoqueDisponivel = this.calcularEstoqueDisponivel(produto.id, produto.estoque);
            
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
                           max="${estoqueDisponivel}"
                           value="${produto.quantidade}"
                           name="produtos[${index}][quantidade]"
                           onchange="window.pedidoEditManager.editarQuantidade('${produto.id}', parseInt(this.value))"
                           class="w-20 px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    <div class="text-xs text-gray-500 mt-1">Máx: ${estoqueDisponivel}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-semibold text-gray-900">R$ ${produto.subtotal.toFixed(2).replace('.', ',')}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <button type="button" 
                            onclick="window.pedidoEditManager.removerProduto('${produto.id}')"
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
            alert('Selecione um cliente para o pedido.');
            return false;
        }

        // Validar produtos
        if (this.produtos.length === 0) {
            alert('Adicione pelo menos um produto ao pedido.');
            return false;
        }

        return true;
    }

    restaurarOriginal() {
        this.produtos = JSON.parse(JSON.stringify(this.produtosOriginais));
        this.atualizarInterface();
    }
}

// Funções globais
window.restaurarOriginal = function() {
    if (confirm('Tem certeza que deseja restaurar os produtos originais? Todas as alterações serão perdidas.')) {
        window.pedidoEditManager.restaurarOriginal();
    }
};

// Inicializar quando DOM estiver pronto
document.addEventListener('DOMContentLoaded', function() {
    // Destruir instância existente se houver
    if (window.pedidoEditManager) {
        delete window.pedidoEditManager;
    }

    // Criar nova instância
    window.pedidoEditManager = new PedidoEditManager();
});