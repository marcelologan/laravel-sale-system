// Função para abrir modal
window.openModal = function (modalId) {
    document.getElementById(modalId).classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

// Função para fechar modal
window.closeModal = function (modalId) {
    document.getElementById(modalId).classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Fechar modal clicando fora dele
document.addEventListener('click', function (event) {
    if (event.target.classList.contains('bg-gray-600')) {
        const modal = event.target;
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
});

// Fechar modal com ESC
document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
        const modals = document.querySelectorAll('[id$="Modal"]');
        modals.forEach(modal => {
            if (!modal.classList.contains('hidden')) {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        });
    }
});

// Função para mostrar modal de confirmação
window.showConfirmModal = function (title, message, callback) {
    const titleElement = document.getElementById('confirmTitle');
    const messageElement = document.getElementById('confirmMessage');

    if (!titleElement || !messageElement) {
        console.error('Elementos do modal de confirmação não encontrados');
        return;
    }

    titleElement.textContent = title;
    messageElement.textContent = message;

    document.getElementById('confirmButton').onclick = function () {
        closeModal('confirmModal');
        if (callback) callback();
    };

    openModal('confirmModal');
}

// Função para mostrar modal de alerta
window.showAlertModal = function (title, message) {
    const titleElement = document.getElementById('alertTitle');
    const messageElement = document.getElementById('alertMessage');

    if (!titleElement || !messageElement) {
        console.error('Elementos do modal de alerta não encontrados');
        return;
    }

    titleElement.textContent = title;
    messageElement.textContent = message;
    openModal('alertModal');
}

// Substituir window.alert e window.confirm
window.alert = function (message) {
    showAlertModal('Atenção', message);
};

window.confirm = function (message) {
    return new Promise((resolve) => {
        showConfirmModal('Confirmação', message, () => resolve(true));
    });
};