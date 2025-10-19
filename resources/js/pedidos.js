/**
 * Gerenciamento de Pedidos
 * Sistema de criação e edição de pedidos com produtos
 */

class PedidoManager {
    constructor(dadosIniciais = null) {
        console.log('🚨 NOVA INSTÂNCIA CRIADA!');
        console.trace('Stack trace da criação:'); // Mostra onde foi criada


        this.produtosSelecionados = [];
        this.valorTotal = 0;
        this.init();
        this.initComDados(dadosIniciais);
    }

    init() {
        this.bindEvents();
        this.updateUI();
    }

    // Método para inicializar com dados do servidor
    initComDados(dados = null) {
        if (dados && Array.isArray(dados) && dados.length > 0) {
            this.carregarProdutosExistentes(dados);
        }
    }

    bindEvents() {
        console.log('🔧 BIND EVENTS - this:', this);
        console.log('🔧 BIND EVENTS - window.pedidoManager:', window.pedidoManager);

        const adicionarBtn = document.getElementById('adicionar_produto');
        if (adicionarBtn) {
            adicionarBtn.addEventListener('click', () => {
                console.log('🔧 CLICK - this:', this);
                console.log('�� CLICK - window.pedidoManager:', window.pedidoManager);
                this.adicionarProduto();
            });
        }

        // Event delegation para botões de remover
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('remover-produto')) {
                const index = parseInt(e.target.dataset.index);
                this.removerProduto(index);
            }
        });

        // Enter no campo quantidade
        const quantidadeInput = document.getElementById('quantidade_input');
        if (quantidadeInput) {
            quantidadeInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    this.adicionarProduto();
                }
            });
        }
    }
    adicionarProduto() {
        console.log('🔍 MÉTODO ADICIONAR PRODUTO - INÍCIO');
        console.log('🔍 this === window.pedidoManager:', this === window.pedidoManager);
        console.log('🔍 Array ANTES de adicionar:', this.produtosSelecionados);

        const produtoSelect = document.getElementById('produto_select');
        const quantidadeInput = document.getElementById('quantidade_input');

        const produtoId = produtoSelect.value;
        const quantidade = parseInt(quantidadeInput.value);

        if (!this.validarProduto(produtoId, quantidade)) {
            return;
        }

        const produtoOption = produtoSelect.selectedOptions[0];
        const produtoData = this.extrairDadosProduto(produtoOption, quantidade);

        if (!this.validarEstoque(produtoData.quantidade, produtoData.estoque)) {
            return;
        }

        this.processarProduto(produtoData);

        console.log('🔍 Array DEPOIS de processar:', this.produtosSelecionados);
        console.log('🔍 window.pedidoManager array:', window.pedidoManager.produtosSelecionados);

        this.limparCampos();
        this.updateUI();
    }

    validarProduto(produtoId, quantidade) {
        if (!produtoId) {
            this.showAlert('Selecione um produto.', 'warning');
            return false;
        }

        if (!quantidade || quantidade <= 0) {
            this.showAlert('Informe uma quantidade válida.', 'warning');
            return false;
        }

        return true;
    }

    extrairDadosProduto(produtoOption, quantidade) {
        const texto = produtoOption.text;
        const nome = texto.split(' - ')[0];
        const preco = parseFloat(produtoOption.dataset.preco);
        const estoque = parseInt(produtoOption.dataset.estoque);

        return {
            id: produtoOption.value,
            nome: nome,
            preco: preco,
            quantidade: quantidade,
            estoque: estoque,
            subtotal: quantidade * preco
        };
    }

    validarEstoque(quantidade, estoque) {
        if (quantidade > estoque) {
            this.showAlert(
                `Quantidade solicitada (${quantidade}) é maior que o estoque disponível (${estoque}).`,
                'error'
            );
            return false;
        }
        return true;
    }

    processarProduto(produtoData) {
        const produtoExistente = this.produtosSelecionados.find(p => p.id == produtoData.id);

        if (produtoExistente) {
            produtoExistente.quantidade += produtoData.quantidade;
            produtoExistente.subtotal = produtoExistente.quantidade * produtoExistente.preco;
            this.showAlert('Quantidade do produto atualizada!', 'success');
        } else {
            this.produtosSelecionados.push(produtoData);
            this.showAlert('Produto adicionado com sucesso!', 'success');
        }

        console.log('➕ Produto adicionado. Array atual:', this.produtosSelecionados);
    }

    removerProduto(index) {
        if (index >= 0 && index < this.produtosSelecionados.length) {
            const produto = this.produtosSelecionados[index];
            this.produtosSelecionados.splice(index, 1);
            this.updateUI();
            this.showAlert(`${produto.nome} removido do pedido.`, 'info');
        }
    }

    updateUI() {
        this.atualizarListaProdutos();
        this.atualizarValorTotal();
        this.atualizarBotaoSalvar();
        this.toggleMensagemVazia();
    }

    atualizarListaProdutos() {
        const produtosLista = document.getElementById('produtos_lista');
        if (!produtosLista) return;

        produtosLista.innerHTML = '';

        this.produtosSelecionados.forEach((produto, index) => {
            const produtoElement = this.criarElementoProduto(produto, index);
            produtosLista.appendChild(produtoElement);
        });
    }

    criarElementoProduto(produto, index) {
        const produtoDiv = document.createElement('div');
        produtoDiv.className = 'produto-item flex items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-all duration-300';

        produtoDiv.innerHTML = `
            <div class="flex-1">
                <div class="font-medium text-gray-900">${this.escapeHtml(produto.nome)}</div>
                <div class="text-sm text-gray-500">
                    ${this.formatarMoeda(produto.preco)} x ${produto.quantidade} unidade${produto.quantidade > 1 ? 's' : ''}
                </div>
            </div>
            <div class="text-right mr-4">
                <div class="font-semibold text-gray-900">${this.formatarMoeda(produto.subtotal)}</div>
            </div>
            <button type="button" 
                    class="remover-produto text-red-600 hover:text-red-900 font-bold p-2 rounded hover:bg-red-50 transition-colors"
                    data-index="${index}"
                    title="Remover produto">
                🗑️
            </button>
            <input type="hidden" name="produtos[${index}][produto_id]" value="${produto.id}">
            <input type="hidden" name="produtos[${index}][quantidade]" value="${produto.quantidade}">
        `;

        return produtoDiv;
    }

    atualizarValorTotal() {
        this.valorTotal = this.produtosSelecionados.reduce((total, produto) => total + produto.subtotal, 0);

        const valorTotalElement = document.getElementById('valor_total');
        if (valorTotalElement) {
            valorTotalElement.textContent = this.formatarMoeda(this.valorTotal);
        }
    }

    atualizarBotaoSalvar() {
        const salvarBtn = document.getElementById('salvar_pedido');
        if (salvarBtn) {
            const temProdutos = this.produtosSelecionados.length > 0;
            salvarBtn.disabled = !temProdutos;

            if (!temProdutos) {
                salvarBtn.classList.add('opacity-50', 'cursor-not-allowed');
                salvarBtn.title = 'Adicione pelo menos um produto para salvar o pedido';
            } else {
                salvarBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                salvarBtn.title = 'Salvar pedido';
            }
        }
    }

    toggleMensagemVazia() {
        const semProdutos = document.getElementById('sem_produtos');
        const produtosLista = document.getElementById('produtos_lista');

        if (semProdutos) {
            if (this.produtosSelecionados.length === 0) {
                semProdutos.style.display = 'block';
            } else {
                semProdutos.style.display = 'none';
            }
        }
    }

    limparCampos() {
        const produtoSelect = document.getElementById('produto_select');
        const quantidadeInput = document.getElementById('quantidade_input');

        if (produtoSelect) produtoSelect.value = '';
        if (quantidadeInput) quantidadeInput.value = '';

        // Focar no select de produto para facilitar próxima adição
        if (produtoSelect) produtoSelect.focus();
    }

    formatarMoeda(valor) {
        return new Intl.NumberFormat('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        }).format(valor);
    }

    escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, function (m) { return map[m]; });
    }

    showAlert(message, type = 'info') {
        // Implementação de alerta profissional
        const alertClass = {
            'success': 'bg-green-100 border-green-500 text-green-700',
            'error': 'bg-red-100 border-red-500 text-red-700',
            'warning': 'bg-yellow-100 border-yellow-500 text-yellow-700',
            'info': 'bg-blue-100 border-blue-500 text-blue-700'
        };

        const iconClass = {
            'success': '✅',
            'error': '❌',
            'warning': '⚠️',
            'info': 'ℹ️'
        };

        // Remover alertas existentes
        const existingAlerts = document.querySelectorAll('.pedido-alert');
        existingAlerts.forEach(alert => alert.remove());

        const alertDiv = document.createElement('div');
        alertDiv.className = `pedido-alert fixed top-4 right-4 p-4 border-l-4 rounded shadow-lg z-50 ${alertClass[type]} max-w-sm animate-slide-in`;
        alertDiv.innerHTML = `
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <span class="mr-2">${iconClass[type]}</span>
                    <span>${this.escapeHtml(message)}</span>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" 
                        class="ml-4 font-bold hover:opacity-70 transition-opacity">×</button>
            </div>
        `;

        document.body.appendChild(alertDiv);

        // Auto-remover após 5 segundos
        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.classList.add('animate-slide-out');
                setTimeout(() => alertDiv.remove(), 300);
            }
        }, 5000);
    }

    // Método para carregar produtos existentes (usado na edição)
    carregarProdutosExistentes(produtos) {
        if (!Array.isArray(produtos)) {
            console.warn('Dados de produtos inválidos:', produtos);
            return;
        }

        this.produtosSelecionados = produtos.map(produto => ({
            id: produto.id,
            nome: produto.nome,
            preco: parseFloat(produto.preco),
            quantidade: parseInt(produto.quantidade),
            subtotal: parseFloat(produto.subtotal)
        }));

        this.updateUI();

        if (produtos.length > 0) {
            this.showAlert(`${produtos.length} produto(s) carregado(s) com sucesso!`, 'success');
        }
    }

    // Método para obter dados dos produtos (útil para validações)
    getProdutosSelecionados() {
        // No método que adiciona produtos, adicione:
        return this.produtosSelecionados;
    }

    // Método para limpar todos os produtos
    limparTodosProdutos() {
        if (this.produtosSelecionados.length === 0) {
            this.showAlert('Não há produtos para remover.', 'info');
            return;
        }

        const quantidade = this.produtosSelecionados.length;
        this.produtosSelecionados = [];
        this.updateUI();
        this.showAlert(`${quantidade} produto(s) removido(s).`, 'info');
    }

    // Método para validar se há produtos antes de submeter
    validarAntesSalvar() {
        console.log('🔍 VALIDANDO ANTES DE SALVAR...');
        console.log('🔍 produtosSelecionados:', this.produtosSelecionados);
        console.log('🔍 Length:', this.produtosSelecionados.length);
        console.log('🔍 Tipo:', typeof this.produtosSelecionados);

        if (this.produtosSelecionados.length === 0) {
            console.log('❌ Nenhum produto encontrado');
            this.showAlert('Adicione pelo menos um produto antes de salvar o pedido.', 'warning');
            return false;
        }

        console.log('✅ Produtos encontrados - validação passou');
        return true;
    }

    // Método para debug (desenvolvimento)
    debug() {
        console.log('Produtos selecionados:', this.produtosSelecionados);
        console.log('Valor total:', this.valorTotal);
    }
}

// Adicionar CSS para animações
const style = document.createElement('style');
style.textContent = `
    .animate-slide-in {
        animation: slideIn 0.3s ease-out;
    }
    
    .animate-slide-out {
        animation: slideOut 0.3s ease-in;
    }
    
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
    
    .produto-item:hover {
        transform: translateY(-2px);
    }
`;
document.head.appendChild(style);

// Inicialização automática removida - será feita manualmente nas views

// Exportar para uso global
window.PedidoManager = PedidoManager;
