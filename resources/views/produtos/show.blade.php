<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes do Produto') }}
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
                        <h3 class="text-lg font-medium">Informações do Produto</h3>
                        <div class="flex space-x-3">
                            <a href="{{ route('produtos.index') }}"
                                class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                ← Voltar
                            </a>
                            <a href="{{ route('produtos.edit', $produto) }}"
                                class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                ✏️ Editar
                            </a>
                            <button onclick="openModal('deleteModal')"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                🗑️ Excluir
                            </button>
                        </div>
                    </div>

                    <!-- Card principal com imagem e informações -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                            <!-- Imagem do produto -->
                            <div class="lg:col-span-1">
                                @if($produto->imagem)
                                <div class="aspect-square rounded-lg overflow-hidden bg-white shadow-sm">
                                    <img src="{{ asset('storage/' . $produto->imagem) }}"
                                        alt="{{ $produto->nome }}"
                                        class="w-full h-full object-cover">
                                </div>
                                @else
                                <div class="aspect-square rounded-lg bg-gray-200 flex items-center justify-center">
                                    <div class="text-center">
                                        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-500">Sem imagem</p>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <!-- Informações principais -->
                            <div class="lg:col-span-2 space-y-6">

                                <!-- Nome e Status -->
                                <div>
                                    <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $produto->nome }}</h1>
                                    <div class="flex items-center space-x-3">
                                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full 
                                            {{ $produto->status == 'ativo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($produto->status) }}
                                        </span>
                                        @if($produto->estoque <= 0)
                                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800">
                                            Sem estoque
                                            </span>
                                            @elseif($produto->estoque <= 5)
                                                <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Estoque baixo
                                                </span>
                                                @endif
                                    </div>
                                </div>

                                <!-- Preço -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Preço</label>
                                    <p class="text-3xl font-bold text-green-600">{{ $produto->preco_formatado }}</p>
                                </div>

                                <!-- Grid de informações -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                    <!-- Categoria -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Categoria</label>
                                        <p class="text-lg text-gray-900">{{ $produto->categoria->nome }}</p>
                                    </div>

                                    <!-- Estoque -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Estoque</label>
                                        <div class="flex items-center">
                                            <p class="text-lg font-semibold text-gray-900 mr-2">{{ $produto->estoque }} unidades</p>
                                        </div>
                                    </div>

                                    <!-- Código de Barras -->
                                    <div class="md:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Código de Barras</label>
                                        <p class="text-lg text-gray-900 font-mono">
                                            @if($produto->codigo_barras)
                                            {{ $produto->codigo_barras }}
                                            @else
                                            <span class="text-gray-400 italic">Não informado</span>
                                            @endif
                                        </p>
                                    </div>

                                </div>

                                <!-- Descrição -->
                                @if($produto->descricao)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Descrição</label>
                                    <div class="bg-white rounded-md p-4 border border-gray-200">
                                        <p class="text-gray-900 leading-relaxed">{{ $produto->descricao }}</p>
                                    </div>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>

                    <!-- Informações de sistema -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-500">
                            <div>
                                <strong>Cadastrado em:</strong>
                                {{ \Carbon\Carbon::parse($produto->created_at)->format('d/m/Y H:i') }}
                            </div>
                            <div>
                                <strong>Última atualização:</strong>
                                {{ \Carbon\Carbon::parse($produto->updated_at)->format('d/m/Y H:i') }}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmação de Exclusão -->
    <x-modal id="deleteModal" title="Confirmar Exclusão" type="danger">
        <div class="text-sm text-gray-500">
            <p class="mb-4">Tem certeza que deseja excluir o produto <strong>{{ $produto->nome }}</strong>?</p>
            <div class="bg-red-50 border border-red-200 rounded-md p-3">
                <p class="text-red-800 text-xs">
                    ⚠️ <strong>Atenção:</strong> Esta ação não pode ser desfeita. Todos os dados relacionados a este produto serão permanentemente removidos.
                </p>
            </div>
        </div>

        <x-slot name="actions">
            <button type="button"
                onclick="closeModal('deleteModal')"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                Cancelar
            </button>
            <form action="{{ route('produtos.destroy', $produto) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">
                    🗑️ Sim, Excluir
                </button>
            </form>
        </x-slot>
    </x-modal>

</x-app-layout>