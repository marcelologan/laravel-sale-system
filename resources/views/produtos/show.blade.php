<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-link/20 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-link" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-text-dark leading-tight">
                        Detalhes do Produto
                    </h2>
                    <p class="text-text-light text-sm">Informações completas do produto</p>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('produtos.edit', $produto) }}"
                    class="bg-secondary hover:bg-secondary-dark text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                    </svg>
                    Editar
                </a>
                <button onclick="openModal('deleteModal')"
                        class="bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Excluir
                </button>
                <a href="{{ route('produtos.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
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
                    
                    <!-- Card Principal do Produto -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-primary/20">
                        <div class="p-8">
                            
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                                <!-- Imagem do produto -->
                                <div>
                                    @if($produto->imagem)
                                        <div class="aspect-square rounded-xl overflow-hidden bg-white shadow-lg border border-gray-200">
                                            <img src="{{ asset('storage/' . $produto->imagem) }}"
                                                 alt="{{ $produto->nome }}"
                                                 class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <div class="aspect-square rounded-xl bg-gray-100 border-2 border-dashed border-gray-300 flex items-center justify-center">
                                            <div class="text-center">
                                                <svg class="mx-auto h-20 w-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                <p class="mt-4 text-lg text-gray-500 font-medium">Sem imagem</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- Informações principais -->
                                <div class="space-y-6">

                                    <!-- Nome e Status -->
                                    <div>
                                        <h1 class="text-3xl font-bold text-text-dark mb-3">{{ $produto->nome }}</h1>
                                        <div class="flex items-center space-x-3">
                                            <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $produto->status == 'ativo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $produto->status == 'ativo' ? '✅ Ativo' : '❌ Inativo' }}
                                            </span>
                                            @if($produto->estoque <= 0)
                                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                                    ❌ Sem estoque
                                                </span>
                                            @elseif($produto->estoque <= 5)
                                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    ⚠️ Estoque baixo
                                                </span>
                                            @else
                                                <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">
                                                    ✅ Em estoque
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Preço -->
                                    <div class="bg-gradient-to-r from-primary/10 to-secondary/10 rounded-xl p-6 border border-primary/20">
                                        <label class="block text-sm font-semibold text-text-dark mb-2">💰 Preço</label>
                                        <p class="text-4xl font-bold text-primary-dark">R\$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                                    </div>

                                    <!-- Grid de informações -->
                                    <div class="grid grid-cols-1 gap-4">

                                        <!-- Categoria -->
                                        <div class="bg-gray-50 rounded-lg p-4">
                                            <label class="block text-sm font-semibold text-text-dark mb-1">🏷️ Categoria</label>
                                            <p class="text-lg text-text-dark font-medium">{{ $produto->categoria->nome }}</p>
                                        </div>

                                        <!-- Estoque -->
                                        <div class="bg-gray-50 rounded-lg p-4">
                                            <label class="block text-sm font-semibold text-text-dark mb-1">📦 Estoque</label>
                                            <div class="flex items-center">
                                                <p class="text-lg font-bold text-text-dark mr-3">{{ $produto->estoque }} unidades</p>
                                                @if($produto->estoque <= 0)
                                                    <span class="text-red-600 text-sm">⚠️ Reposição necessária</span>
                                                @elseif($produto->estoque <= 5)
                                                    <span class="text-yellow-600 text-sm">⚠️ Estoque baixo</span>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Código de Barras -->
                                        <div class="bg-gray-50 rounded-lg p-4">
                                            <label class="block text-sm font-semibold text-text-dark mb-1">🏷️ Código de Barras</label>
                                            <p class="text-lg text-text-dark font-mono">
                                                @if($produto->codigo_barras)
                                                    {{ $produto->codigo_barras }}
                                                @else
                                                    <span class="text-gray-400 italic">Não informado</span>
                                                @endif
                                            </p>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <!-- Descrição -->
                            @if($produto->descricao)
                            <div class="mt-8 pt-6 border-t border-gray-200">
                                <label class="block text-sm font-semibold text-text-dark mb-3">📝 Descrição</label>
                                <div class="bg-gray-50 rounded-xl p-6">
                                    <p class="text-text-dark leading-relaxed">{{ $produto->descricao }}</p>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>

                    <!-- Informações de Sistema -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-200">
                        <div class="p-6">
                            <h4 class="text-lg font-semibold text-text-dark mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                                ℹ️ Informações do Sistema
                            </h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <strong class="text-text-dark">Cadastrado em:</strong>
                                    <p class="text-text-light mt-1">{{ \Carbon\Carbon::parse($produto->created_at)->format('d/m/Y H:i') }}</p>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <strong class="text-text-dark">Última atualização:</strong>
                                    <p class="text-text-light mt-1">{{ \Carbon\Carbon::parse($produto->updated_at)->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    
                    <!-- Resumo do Produto -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-link/20">
                        <div class="p-6">
                            <h4 class="text-lg font-semibold text-text-dark mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-link" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 17H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2zm2-7h-1V8c0-2.76-2.24-5-5-5S8 5.24 8 8v2H7c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V12c0-1.1-.9-2-2-2zm-8 0V8c0-1.66 1.34-3 3-3s3 1.34 3 3v2H10z"/>
                                </svg>
                                📊 Resumo
                            </h4>
                            
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-text-light">Status:</span>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $produto->status == 'ativo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $produto->status == 'ativo' ? '✅ Ativo' : '❌ Inativo' }}
                                    </span>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-text-light">Categoria:</span>
                                    <span class="text-sm font-medium text-text-dark">{{ $produto->categoria->nome }}</span>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-text-light">Preço:</span>
                                    <span class="text-sm font-bold text-primary-dark">R\$ {{ number_format($produto->preco, 2, ',', '.') }}</span>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-text-light">Estoque:</span>
                                    <span class="text-sm font-medium text-text-dark">{{ $produto->estoque }} unidades</span>
                                </div>
                                
                                <hr class="my-3">
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-text-light">Cadastrado:</span>
                                    <span class="text-sm font-medium text-text-dark">{{ \Carbon\Carbon::parse($produto->created_at)->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ações Rápidas -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-primary/20">
                        <div class="p-6">
                            <h4 class="text-lg font-semibold text-text-dark mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-primary-dark" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M13,9H11V7H13M13,17H11V11H13M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"/>
                                </svg>
                                ⚡ Ações Rápidas
                            </h4>
                            
                            <div class="space-y-3">
                                <a href="{{ route('produtos.edit', $produto) }}" 
                                   class="w-full bg-secondary hover:bg-secondary-dark text-white font-semibold py-3 px-4 rounded-xl block text-center transition-all duration-300">
                                    ✏️ Editar Produto
                                </a>
                                
                                <a href="{{ route('produtos.create') }}" 
                                   class="w-full warm-gradient text-white font-semibold py-3 px-4 rounded-xl block text-center hover:opacity-90 transition-all duration-300">
                                    ➕ Novo Produto
                                </a>
                                
                                <a href="{{ route('produtos.index', ['categoria_id' => $produto->categoria_id]) }}" 
                                   class="w-full bg-link hover:bg-blue-600 text-white font-semibold py-3 px-4 rounded-xl block text-center transition-all duration-300">
                                    🏷️ Ver Categoria
                                </a>
                                
                                <a href="{{ route('produtos.index') }}" 
                                   class="w-full bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-4 rounded-xl block text-center transition-all duration-300">
                                    📦 Lista de Produtos
                                </a>

                                <button onclick="openModal('deleteModal')" 
                                        class="w-full bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300">
                                    🗑️ Excluir Produto
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmação de Exclusão -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl p-8 max-w-md mx-4 shadow-2xl border border-red-200">
            <div class="flex items-center mb-6">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-text-dark">⚠️ Confirmar Exclusão</h3>
                    <p class="text-sm text-text-light">Esta ação não pode ser desfeita</p>
                </div>
            </div>
            
            <div class="mb-6">
                <p class="text-sm text-text-dark mb-4">
                    Tem certeza que deseja excluir o produto <strong class="text-red-600">{{ $produto->nome }}</strong>?
                </p>
                <div class="bg-red-50 border-2 border-red-200 rounded-xl p-4">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-red-600 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                        <div>
                            <p class="text-red-800 text-sm font-semibold">Atenção:</p>
                            <p class="text-red-700 text-xs mt-1">
                                Todos os dados relacionados a este produto serão permanentemente removidos do sistema.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex space-x-3">
                <button type="button" 
                        onclick="closeModal('deleteModal')" 
                        class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300">
                    Cancelar
                </button>
                <form action="{{ route('produtos.destroy', $produto) }}" method="POST" class="flex-1">
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