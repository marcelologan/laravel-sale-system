<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Produto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Cadastrar Novo Produto</h3>
                        <a href="{{ route('produtos.index') }}"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            ← Voltar
                        </a>
                    </div>

                    <!-- Mensagens de erro -->
                    @if ($errors->any())
                        <div class="mb-6">
                            <x-alert type="error">
                                <strong>Ops! Alguns campos precisam ser corrigidos:</strong>
                                <ul class="mt-2 list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </x-alert>
                        </div>
                    @endif

                    <!-- Formulário -->
                    <form action="{{ route('produtos.store') }}" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- Nome -->
                            <div class="md:col-span-2">
                                <label for="nome" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nome do Produto *
                                </label>
                                <input type="text" name="nome" id="nome" value="{{ old('nome') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('nome') border-red-500 @enderror"
                                    placeholder="Ex: Smartphone Samsung Galaxy" required>
                                @error('nome')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Categoria -->
                            <div>
                                <label for="categoria_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    Categoria *
                                </label>
                                <select name="categoria_id" id="categoria_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('categoria_id') border-red-500 @enderror"
                                    required>
                                    <option value="">Selecione uma categoria</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}"
                                            {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                            {{ $categoria->nome }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('categoria_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Preço -->
                            <div>
                                <label for="preco" class="block text-sm font-medium text-gray-700 mb-2">
                                    Preço (R\$) *
                                </label>
                                <input type="number" name="preco" id="preco" value="{{ old('preco') }}"
                                    step="0.01" min="0.01"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('preco') border-red-500 @enderror"
                                    placeholder="0,00" required>
                                @error('preco')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Estoque -->
                            <div>
                                <label for="estoque" class="block text-sm font-medium text-gray-700 mb-2">
                                    Quantidade em Estoque *
                                </label>
                                <input type="number" name="estoque" id="estoque" value="{{ old('estoque', 0) }}"
                                    min="0"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('estoque') border-red-500 @enderror"
                                    required>
                                @error('estoque')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Código de Barras -->
                            <div>
                                <label for="codigo_barras" class="block text-sm font-medium text-gray-700 mb-2">
                                    Código de Barras
                                </label>
                                <input type="text" name="codigo_barras" id="codigo_barras"
                                    value="{{ old('codigo_barras') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('codigo_barras') border-red-500 @enderror"
                                    placeholder="7891234567890">
                                @error('codigo_barras')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                    Status *
                                </label>
                                <select name="status" id="status"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror"
                                    required>
                                    <option value="">Selecione o status</option>
                                    <option value="ativo" {{ old('status', 'ativo') == 'ativo' ? 'selected' : '' }}>
                                        Ativo
                                    </option>
                                    <option value="inativo" {{ old('status') == 'inativo' ? 'selected' : '' }}>
                                        Inativo
                                    </option>
                                </select>
                                @error('status')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Imagem -->
                            <div class="md:col-span-2">
                                <label for="imagem" class="block text-sm font-medium text-gray-700 mb-2">
                                    Imagem do Produto
                                </label>
                                <input type="file" name="imagem" id="imagem" accept="image/*"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('imagem') border-red-500 @enderror">
                                <p class="mt-1 text-sm text-gray-500">Formatos aceitos: JPEG, PNG, JPG, GIF. Tamanho
                                    máximo: 2MB</p>
                                @error('imagem')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Descrição -->
                            <div class="md:col-span-2">
                                <label for="descricao" class="block text-sm font-medium text-gray-700 mb-2">
                                    Descrição
                                </label>
                                <textarea name="descricao" id="descricao" rows="4"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('descricao') border-red-500 @enderror"
                                    placeholder="Descreva as características e detalhes do produto...">{{ old('descricao') }}</textarea>
                                @error('descricao')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <!-- Botões -->
                        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                            <div class="text-sm text-gray-500">
                                * Campos obrigatórios
                            </div>
                            <div class="flex space-x-3">
                                <a href="{{ route('produtos.index') }}"
                                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                                    Cancelar
                                </a>
                                <button type="submit" id="salvar_pedido"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded transition-colors"
                                    title="Salvar pedido">
                                    💾 Salvar Pedido
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
