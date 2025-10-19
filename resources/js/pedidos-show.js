/**
 * JavaScript para Show de Pedidos
 */

document.addEventListener('DOMContentLoaded', function() {
    // Adicionar efeitos visuais
    initAnimations();
});

/**
 * Confirmar pedido
 */
window.confirmarPedido = function(pedidoId) {
    if (confirm('Tem certeza que deseja confirmar este pedido? Esta ação irá atualizar o estoque dos produtos.')) {
        // Criar form e submeter
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/pedidos/${pedidoId}/confirmar`;
        
        // CSRF Token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        form.appendChild(csrfToken);
        
        // ❌ REMOVER ESTA LINHA:
        // const methodInput = document.createElement('input');
        // methodInput.type = 'hidden';
        // methodInput.name = '_method';
        // methodInput.value = 'PUT';
        // form.appendChild(methodInput);
        
        document.body.appendChild(form);
        form.submit();
    }
};

/**
 * Cancelar pedido
 */
window.cancelarPedido = function(pedidoId) {
    if (confirm('Tem certeza que deseja cancelar este pedido? Se o pedido estiver confirmado, o estoque será devolvido.')) {
        // Criar form e submeter
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/pedidos/${pedidoId}/cancelar`;
        
        // CSRF Token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        form.appendChild(csrfToken);
        
        // ❌ REMOVER ESTA LINHA:
        // const methodInput = document.createElement('input');
        // methodInput.type = 'hidden';
        // methodInput.name = '_method';
        // methodInput.value = 'PUT';
        // form.appendChild(methodInput);
        
        document.body.appendChild(form);
        form.submit();
    }
};

/**
 * Marcar como entregue
 */
window.entregarPedido = function(pedidoId) {
    if (confirm('Tem certeza que deseja marcar este pedido como entregue?')) {
        // Criar form e submeter
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/pedidos/${pedidoId}/entregar`;
        
        // CSRF Token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        form.appendChild(csrfToken);
        
        // ❌ REMOVER ESTA LINHA:
        // const methodInput = document.createElement('input');
        // methodInput.type = 'hidden';
        // methodInput.name = '_method';
        // methodInput.value = 'PUT';
        // form.appendChild(methodInput);
        
        document.body.appendChild(form);
        form.submit();
    }
};

/**
 * Imprimir pedido
 */
window.imprimirPedido = function() {
    window.print();
};

/**
 * Inicializar animações
 */
function initAnimations() {
    // Animação suave para os cards
    const cards = document.querySelectorAll('.bg-white');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.3s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
}