/**
 * JavaScript para Index de Pedidos
 */

document.addEventListener('DOMContentLoaded', function() {
    console.log('Pedidos Index JS carregado');
    
    // Inicializar Select2 para cliente
    if (typeof $ !== 'undefined' && $.fn.select2) {
        $('#cliente_id').select2({
            placeholder: 'Selecione um cliente...',
            allowClear: true,
            width: '100%'
        });
    }
    
    // Inicializar filtros automáticos
    initAutoFilters();
});

/**
 * Confirmar pedido
 */
window.confirmarPedido = function(pedidoId) {
    console.log('Confirmando pedido:', pedidoId);
    
    if (typeof showConfirmModal === 'function') {
        showConfirmModal(
            'Confirmar Pedido',
            'Tem certeza que deseja confirmar este pedido? Esta ação irá atualizar o estoque dos produtos.',
            function() {
                submitForm('/pedidos/' + pedidoId + '/confirmar');
            }
        );
    } else {
        // Fallback para confirm simples
        if (confirm('Tem certeza que deseja confirmar este pedido? Esta ação irá atualizar o estoque dos produtos.')) {
            submitForm('/pedidos/' + pedidoId + '/confirmar');
        }
    }
};

/**
 * Cancelar pedido
 */
window.cancelarPedido = function(pedidoId) {
    console.log('Cancelando pedido:', pedidoId);
    
    if (typeof showConfirmModal === 'function') {
        showConfirmModal(
            'Cancelar Pedido',
            'Tem certeza que deseja cancelar este pedido? Se o pedido estiver confirmado, o estoque será devolvido.',
            function() {
                submitForm('/pedidos/' + pedidoId + '/cancelar');
            }
        );
    } else {
        // Fallback para confirm simples
        if (confirm('Tem certeza que deseja cancelar este pedido? Se o pedido estiver confirmado, o estoque será devolvido.')) {
            submitForm('/pedidos/' + pedidoId + '/cancelar');
        }
    }
};

/**
 * Marcar como entregue
 */
window.entregarPedido = function(pedidoId) {
    console.log('Entregando pedido:', pedidoId);
    
    if (typeof showConfirmModal === 'function') {
        showConfirmModal(
            'Marcar como Entregue',
            'Tem certeza que deseja marcar este pedido como entregue?',
            function() {
                submitForm('/pedidos/' + pedidoId + '/entregar');
            }
        );
    } else {
        // Fallback para confirm simples
        if (confirm('Tem certeza que deseja marcar este pedido como entregue?')) {
            submitForm('/pedidos/' + pedidoId + '/entregar');
        }
    }
};

/**
 * Função auxiliar para submeter formulários
 */
function submitForm(action) {
    console.log('Submetendo para:', action);
    
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = action;
    form.style.display = 'none';
    
    // CSRF Token
    const csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    
    const metaToken = document.querySelector('meta[name="csrf-token"]');
    if (metaToken) {
        csrfToken.value = metaToken.getAttribute('content');
    } else {
        console.error('CSRF token não encontrado');
        alert('Erro: Token de segurança não encontrado. Recarregue a página.');
        return;
    }
    
    form.appendChild(csrfToken);
    document.body.appendChild(form);
    form.submit();
}

/**
 * Filtros automáticos
 */
function initAutoFilters() {
    // Auto-submit quando mudar status
    const statusSelect = document.getElementById('status');
    if (statusSelect) {
        statusSelect.addEventListener('change', function() {
            if (this.form) {
                this.form.submit();
            }
        });
    }

    // Auto-submit quando mudar ordenação
    const sortSelect = document.getElementById('sort_by');
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            if (this.form) {
                this.form.submit();
            }
        });
    }
}