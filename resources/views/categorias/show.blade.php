<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes da Categoria') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Header com botões -->
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Informações da Categoria</h3>
                        <div class="flex space-x-3">
                            <a href="{{ route('categorias.index') }}" 
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                ← Voltar
                            </a>
                            <a href="{{ route('categorias.edit', $categoria) }}" 
                               class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                ✏️ Editar
                            </a>
                            @if($categoria->produtos_count == 0)
                                <button onclick="openModal('deleteModal')" 
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    🗑️ Excluir
                                </button>
                            @endif
                        </div>
                    </div>

                    <!-- Informações principais -->
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <!-- Nome e Status -->
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $categoria->nome }}</h1>
                                <div class="flex items-center space-x-3">
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full 
                                        {{ $categoria->status == 'ativo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($categoria->status) }}
                                    </span>
                                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $categoria->produtos_count }} produto{{ $categoria->produtos_count != 1 ? 's' : '' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Estatísticas -->
                            <div class="text-right">
                                <div class="text-3xl font-bold text-blue-600 mb-1">{{ $categoria->produtos_count }}</div>
                                <div class="text-sm text-gray-500">Produtos cadastrados</div>
                            </div>

                        </div>

                        <!-- Descrição -->
                        @if($categoria->descricao)
                            <div class="mt-6">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Descrição</label>
                                <div class="bg-white rounded-md p-4 border border-gray-200">
                                    <p class="text-gray-900 leading-relaxed">{{ $categoria->descricao }}</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Lista de Produtos -->
                    @if($produtos->count() > 0)
                        <div class="mb-6">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="text-lg font-medium text-gray-900">Produtos desta Categoria</h4>
                                @if($categoria->produtos_count > 10)
                                    <a href="{{ route('produtos.index', ['categoria_id' => $categoria->id]) }}" 
                                       class="text-blue-600 hover:text-blue-900 text-sm">
                                        Ver todos os {{ $categoria->produtos_count }} produtos
                                    </a>
                                @endif
                            </div>
                            
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="space-y-3">
                                    @foreach($produtos as $produto)
                                        <div class="flex items-center justify-between py-3 px-4 bg-white rounded-md shadow-sm">
                                            <div class="flex items-center">
                                                @if($produto->imagem)
                                                    <img class="h-10 w-10 rounded object-cover mr-3" 
                                                         src="{{ asset('storage/' . $produto->imagem) }}" 
                                                         alt="{{ $produto->nome }}">
                                                @else
                                                    <div class="h-10 w-10 bg-gray-200 rounded flex items-center justify-center mr-3">
                                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                        </svg>
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="text-sm font-medium text-gray-900">{{ $produto->nome }}</div>
                                                    <div class="text-sm text-gray-500">Estoque: {{ $produto->estoque }} unidades</div>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-4">
                                                <div class="text-right">
                                                    <div class="text-sm font-semibold text-gray-900">{{ $produto->preco_formatado }}</div>
                                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                                        {{ $produto->status == 'ativo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                        {{ ucfirst($produto->status) }}
                                                    </span>
                                                </div>
                                                <a href="{{ route('produtos.show', $produto) }}" 
                                                   class="text-blue-600 hover:text-blue-900 text-sm">
                                                    Ver
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">Nenhum produto cadastrado</h3>
                            <p class="mt-1 text-sm text-gray-500">Esta categoria ainda não possui produtos.</p>
                            <div class="mt-6">
                                <a href="{{ route('produtos.create') }}" 
                                   class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    📦 Cadastrar Primeiro Produto
                                </a>
                            </div>
                        </div>
                    @endif

                    <!-- Informações de sistema -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-500">
                            <div>
                                <strong>Cadastrada em:</strong> 
                                {{ \Carbon\Carbon::parse($categoria->created_at)->format('d/m/Y H:i') }}
                            </div>
                            <div>
                                <strong>Última atualização:</strong> 
                                {{ \Carbon\Carbon::parse($categoria->updated_at)->format('d/m/Y H:i') }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmação de Exclusão -->
    @if($categoria->produtos_count == 0)
        <x-modal id="deleteModal" title="Confirmar Exclusão" type="danger">
            <div class="text-sm text-gray-500">
                <p class="mb-4">Tem certeza que deseja excluir a categoria <strong>{{ $categoria->nome }}</strong>?</p>
                <div class="bg-red-50 border border-red-200 rounded-md p-3">
                    <p class="text-red-800 text-xs">
                        ⚠️ <strong>Atenção:</strong> Esta ação não pode ser desfeita. Todos os dados relacionados a esta categoria serão permanentemente removidos.
                    </p>
                </div>
            </div>

            <x-slot name="actions">
                <button type="button" 
                        onclick="closeModal('deleteModal')" 
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                    Cancelar
                </button>
                <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">
                        🗑️ Sim, Excluir
                    </button>
                </form>
            </x-slot>
        </x-modal>
    @endif

</x-app-layout>