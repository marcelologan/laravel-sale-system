<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-link/20 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-link" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-text-dark leading-tight">
                        Detalhes da Categoria
                    </h2>
                    <p class="text-text-light text-sm">Informações completas da categoria</p>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('categorias.edit', $categoria) }}"
                    class="bg-secondary hover:bg-secondary-dark text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
                    </svg>
                    Editar
                </a>
                @if ($categoria->produtos_count == 0)
                    <button onclick="openModal('deleteModal')"
                        class="bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Excluir
                    </button>
                @endif
                <a href="{{ route('categorias.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" />
                    </svg>
                    Voltar
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Coluna Principal -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Card Principal da Categoria -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-secondary/20">
                        <div class="p-8">

                            <!-- Header da Categoria -->
                            <div class="flex items-center mb-8">
                                <div
                                    class="w-20 h-20 bg-secondary/20 rounded-full flex items-center justify-center mr-6">
                                    <svg class="w-10 h-10 text-secondary-dark" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-2xl font-bold text-text-dark mb-2">{{ $categoria->nome }}</h3>
                                    <div class="flex items-center space-x-4">
                                        <span
                                            class="px-3 py-1 text-sm font-semibold rounded-full {{ $categoria->status == 'ativo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $categoria->status == 'ativo' ? '✅ Ativo' : '❌ Inativo' }}
                                        </span>
                                        <span class="text-sm text-text-light">
                                            Categoria criada em
                                            {{ \Carbon\Carbon::parse($categoria->created_at)->format('d/m/Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Descrição -->
                            @if ($categoria->descricao)
                                <div class="mb-6">
                                    <label class="block text-sm font-semibold text-text-dark mb-2">📝 Descrição</label>
                                    <div class="bg-gray-50 rounded-lg p-4">
                                        <p class="text-text-dark leading-relaxed">{{ $categoria->descricao }}</p>
                                    </div>
                                </div>
                            @endif

                            <!-- Estatísticas -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                                <div
                                    class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-4 border border-blue-200">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M20 7h-3V6a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v1H0v2h3v9a4 4 0 0 0 4 4h10a4 4 0 0 0 4-4V9h3V7z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-2xl font-bold text-blue-700">
                                                {{ $categoria->produtos_count }}</div>
                                            <div class="text-sm text-blue-600">Produtos</div>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-4 border border-green-200">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-2xl font-bold text-green-700">
                                                {{ $produtos->where('status', 'ativo')->count() }}</div>
                                            <div class="text-sm text-green-600">Ativos</div>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="bg-gradient-to-br from-secondary/20 to-primary/20 rounded-xl p-4 border border-secondary/30">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 bg-secondary rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                            </svg>
                                        </div>
                                        <div>
                                            <div class="text-2xl font-bold text-secondary-dark">R\$
                                                {{ number_format($produtos->sum('preco'), 2, ',', '.') }}</div>
                                            <div class="text-sm text-secondary">Valor Total</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Lista de Produtos -->
                    @if ($produtos->count() > 0)
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-primary/20">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-6">
                                    <div class="flex items-center">
                                        <div
                                            class="w-10 h-10 bg-primary/20 rounded-xl flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-primary-dark" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M20 7h-3V6a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v1H0v2h3v9a4 4 0 0 0 4 4h10a4 4 0 0 0 4-4V9h3V7z" />
                                            </svg>
                                        </div>
                                        <h4 class="text-lg font-semibold text-text-dark">📦 Produtos desta Categoria
                                        </h4>
                                    </div>
                                    @if ($categoria->produtos_count > 10)
                                        <a href="{{ route('produtos.index', ['categoria_id' => $categoria->id]) }}"
                                            class="text-link hover:text-primary-dark font-medium text-sm flex items-center">
                                            Ver todos os {{ $categoria->produtos_count }} produtos
                                            <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z" />
                                            </svg>
                                        </a>
                                    @endif
                                </div>

                                <div class="space-y-4">
                                    @foreach ($produtos->take(10) as $produto)
                                        <div
                                            class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-primary/5 transition-colors">
                                            <div class="flex items-center">
                                                @if ($produto->imagem)
                                                    <img class="h-12 w-12 rounded-lg object-cover mr-4 border border-gray-200"
                                                        src="{{ asset('storage/' . $produto->imagem) }}"
                                                        alt="{{ $produto->nome }}">
                                                @else
                                                    <div
                                                        class="h-12 w-12 bg-primary/20 rounded-lg flex items-center justify-center mr-4">
                                                        <svg class="h-6 w-6 text-primary-dark" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="text-sm font-semibold text-text-dark">
                                                        {{ $produto->nome }}</div>
                                                    <div class="text-xs text-text-light flex items-center space-x-3">
                                                        <span>📦 Estoque: {{ $produto->estoque }} unidades</span>
                                                        @if ($produto->codigo_barras)
                                                            <span>🏷️ {{ $produto->codigo_barras }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-4">
                                                <div class="text-right">
                                                    <div class="text-sm font-bold text-primary-dark">R\$
                                                        {{ number_format($produto->preco, 2, ',', '.') }}</div>
                                                    <span
                                                        class="px-2 py-1 text-xs font-semibold rounded-full {{ $produto->status == 'ativo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                        {{ $produto->status == 'ativo' ? '✅ Ativo' : '❌ Inativo' }}
                                                    </span>
                                                </div>
                                                <a href="{{ route('produtos.show', $produto) }}"
                                                    class="bg-link/10 text-link hover:bg-link hover:text-white px-3 py-2 rounded-lg transition-all duration-300">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Estado sem produtos -->
                        <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-200">
                            <div class="text-center py-16">
                                <div
                                    class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-text-dark mb-2">📦 Nenhum produto cadastrado</h3>
                                <p class="text-text-light mb-6">Esta categoria ainda não possui produtos associados.
                                </p>
                                <a href="{{ route('produtos.create', ['categoria_id' => $categoria->id]) }}"
                                    class="bg-primary hover:bg-primary-dark text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105">
                                    🚀 Cadastrar Primeiro Produto
                                </a>
                            </div>
                        </div>
                    @endif

                </div>

                <!-- Sidebar -->
                <div class="space-y-6">

                    <!-- Resumo da Categoria -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-link/20">
                        <div class="p-6">
                            <h4 class="text-lg font-semibold text-text-dark mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-link" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M9 17H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2zm2-7h-1V8c0-2.76-2.24-5-5-5S8 5.24 8 8v2H7c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V12c0-1.1-.9-2-2-2zm-8 0V8c0-1.66 1.34-3 3-3s3 1.34 3 3v2H10z" />
                                </svg>
                                📊 Resumo
                            </h4>

                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-text-light">Status:</span>
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full {{ $categoria->status == 'ativo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $categoria->status == 'ativo' ? '✅ Ativo' : '❌ Inativo' }}
                                    </span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-text-light">Total de Produtos:</span>
                                    <span
                                        class="text-sm font-bold text-secondary-dark">{{ $categoria->produtos_count }}</span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-text-light">Produtos Ativos:</span>
                                    <span
                                        class="text-sm font-medium text-green-600">{{ $produtos->where('status', 'ativo')->count() }}</span>
                                </div>

                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-text-light">Criada em:</span>
                                    <span
                                        class="text-sm font-medium text-text-dark">{{ \Carbon\Carbon::parse($categoria->created_at)->format('d/m/Y') }}</span>
                                </div>

                                <hr class="my-3">

                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-text-light">Última Atualização:</span>
                                    <span
                                        class="text-xs text-text-light">{{ \Carbon\Carbon::parse($categoria->updated_at)->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ações Rápidas -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-secondary/20">
                        <div class="p-6">
                            <h4 class="text-lg font-semibold text-text-dark mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-secondary-dark" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M13,9H11V7H13M13,17H11V11H13M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z" />
                                </svg>
                                ⚡ Ações Rápidas
                            </h4>

                            <div class="space-y-3">
                                <a href="{{ route('categorias.edit', $categoria) }}"
                                    class="w-full bg-secondary hover:bg-secondary-dark text-white font-semibold py-3 px-4 rounded-xl block text-center transition-all duration-300">
                                    ✏️ Editar Categoria
                                </a>

                                <a href="{{ route('produtos.create', ['categoria_id' => $categoria->id]) }}"
                                    class="w-full bg-primary hover:bg-primary-dark text-white font-semibold py-3 px-4 rounded-xl block text-center transition-all duration-300">
                                    📦 Novo Produto
                                </a>

                                @if ($categoria->produtos_count > 0)
                                    <a href="{{ route('produtos.index', ['categoria_id' => $categoria->id]) }}"
                                        class="w-full bg-link hover:bg-blue-600 text-white font-semibold py-3 px-4 rounded-xl block text-center transition-all duration-300">
                                        📋 Ver Todos Produtos
                                    </a>
                                @endif

                                <a href="{{ route('categorias.index') }}"
                                    class="w-full bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-4 rounded-xl block text-center transition-all duration-300">
                                    📂 Lista de Categorias
                                </a>

                                @if ($categoria->produtos_count == 0)
                                    <button onclick="openModal('deleteModal')"
                                        class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300">
                                        🗑️ Excluir Categoria
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmação de Exclusão -->
    @if ($categoria->produtos_count == 0)
        <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white rounded-2xl p-8 max-w-md mx-4 shadow-2xl border border-red-200">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-text-dark">⚠️ Confirmar Exclusão</h3>
                        <p class="text-sm text-text-light">Esta ação não pode ser desfeita</p>
                    </div>
                </div>

                <div class="mb-6">
                    <p class="text-sm text-text-dark mb-4">
                        Tem certeza que deseja excluir a categoria <strong
                            class="text-red-600">{{ $categoria->nome }}</strong>?
                    </p>
                    <div class="bg-red-50 border-2 border-red-200 rounded-xl p-4">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-red-600 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z" />
                            </svg>
                            <div>
                                <p class="text-red-800 text-sm font-semibold">Atenção:</p>
                                <p class="text-red-700 text-xs mt-1">
                                    Todos os dados relacionados a esta categoria serão permanentemente removidos do
                                    sistema.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex space-x-3">
                    <button type="button" onclick="closeModal('deleteModal')"
                        class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300">
                        Cancelar
                    </button>
                    <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300">
                            🗑️ Sim, Excluir
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- JavaScript para Modal -->
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.getElementById(modalId).classList.add('flex');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.getElementById(modalId).classList.remove('flex');
        }

        // Fechar modal clicando fora
        document.addEventListener('click', function(event) {
            const modal = document.getElementById('deleteModal');
            if (event.target === modal) {
                closeModal('deleteModal');
            }
        });

        // Fechar modal com ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal('deleteModal');
            }
        });
    </script>
</x-app-layout>
