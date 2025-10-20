<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-12 h-12 warm-gradient rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-text-dark leading-tight">
                        Novo Produto
                    </h2>
                    <p class="text-text-light text-sm">Adicione um novo produto ao seu catálogo</p>
                </div>
            </div>
            <a href="{{ route('produtos.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                </svg>
                Voltar
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-primary/20">
                <div class="p-8">

                    <!-- Header do Form -->
                    <div class="flex items-center mb-8">
                        <div class="w-10 h-10 bg-primary/20 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 text-primary-dark" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20 7h-3V6a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v1H0v2h3v9a4 4 0 0 0 4 4h10a4 4 0 0 0 4-4V9h3V7z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-text-dark">Informações do Produto</h3>
                            <p class="text-sm text-text-light">Preencha os dados abaixo para cadastrar o produto</p>
                        </div>
                    </div>

                    <!-- Mensagens de erro -->
                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border-2 border-red-200 text-red-800 px-6 py-4 rounded-xl">
                            <div class="flex items-center mb-2">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                                <strong>Ops! Alguns campos precisam ser corrigidos:</strong>
                            </div>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li class="text-sm">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Formulário -->
                    <form action="{{ route('produtos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                            <!-- Coluna da Imagem -->
                            <div class="lg:col-span-1">
                                <label class="block text-sm font-semibold text-text-dark mb-2">
                                    📸 Imagem do Produto
                                </label>
                                
                                <!-- Preview da Imagem -->
                                <div class="aspect-square rounded-xl bg-gray-100 border-2 border-dashed border-gray-300 flex items-center justify-center mb-4" id="image-preview">
                                    <div class="text-center">
                                        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <p class="mt-2 text-sm text-gray-500">Clique para adicionar imagem</p>
                                    </div>
                                </div>

                                <!-- Upload Input -->
                                <input type="file" 
                                       name="imagem" 
                                       id="imagem" 
                                       accept="image/*"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all @error('imagem') border-red-500 ring-2 ring-red-200 @enderror">
                                <p class="mt-2 text-xs text-text-light">Formatos: JPEG, PNG, JPG, GIF. Máximo: 2MB</p>
                                @error('imagem')
                                    <p class="mt-2 text-sm text-red-600 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Coluna dos Campos -->
                            <div class="lg:col-span-2 space-y-6">

                                <!-- Nome -->
                                <div>
                                    <label for="nome" class="block text-sm font-semibold text-text-dark mb-2">
                                        📦 Nome do Produto *
                                    </label>
                                    <input type="text" 
                                           name="nome" 
                                           id="nome" 
                                           value="{{ old('nome') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all @error('nome') border-red-500 ring-2 ring-red-200 @enderror"
                                           placeholder="Ex: Smartphone Samsung Galaxy"
                                           required>
                                    @error('nome')
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                    <!-- Categoria -->
                                    <div>
                                        <label for="categoria_id" class="block text-sm font-semibold text-text-dark mb-2">
                                            🏷️ Categoria *
                                        </label>
                                        <select name="categoria_id" 
                                                id="categoria_id"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all @error('categoria_id') border-red-500 ring-2 ring-red-200 @enderror"
                                                required>
                                            <option value="">Selecione uma categoria</option>
                                            @foreach ($categorias as $categoria)
                                                <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                                    {{ $categoria->nome }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('categoria_id')
                                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- Preço -->
                                    <div>
                                        <label for="preco" class="block text-sm font-semibold text-text-dark mb-2">
                                            💰 Preço (R\$) *
                                        </label>
                                        <input type="number" 
                                               name="preco" 
                                               id="preco" 
                                               value="{{ old('preco') }}"
                                               step="0.01"
                                               min="0.01"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all @error('preco') border-red-500 ring-2 ring-red-200 @enderror"
                                               placeholder="0,00"
                                               required>
                                        @error('preco')
                                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- Estoque -->
                                    <div>
                                        <label for="estoque" class="block text-sm font-semibold text-text-dark mb-2">
                                            📊 Quantidade em Estoque *
                                        </label>
                                        <input type="number" 
                                               name="estoque" 
                                               id="estoque" 
                                               value="{{ old('estoque', 0) }}"
                                               min="0"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all @error('estoque') border-red-500 ring-2 ring-red-200 @enderror"
                                               required>
                                        @error('estoque')
                                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- Status -->
                                    <div>
                                        <label for="status" class="block text-sm font-semibold text-text-dark mb-2">
                                            📋 Status *
                                        </label>
                                        <select name="status" 
                                                id="status"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all @error('status') border-red-500 ring-2 ring-red-200 @enderror"
                                                required>
                                            <option value="">Selecione o status</option>
                                            <option value="ativo" {{ old('status', 'ativo') == 'ativo' ? 'selected' : '' }}>
                                                ✅ Ativo
                                            </option>
                                            <option value="inativo" {{ old('status') == 'inativo' ? 'selected' : '' }}>
                                                ❌ Inativo
                                            </option>
                                        </select>
                                        @error('status')
                                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                                </svg>
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                </div>

                                <!-- Código de Barras -->
                                <div>
                                    <label for="codigo_barras" class="block text-sm font-semibold text-text-dark mb-2">
                                        🏷️ Código de Barras
                                    </label>
                                    <input type="text" 
                                           name="codigo_barras" 
                                           id="codigo_barras"
                                           value="{{ old('codigo_barras') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all @error('codigo_barras') border-red-500 ring-2 ring-red-200 @enderror"
                                           placeholder="7891234567890">
                                    @error('codigo_barras')
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Descrição -->
                                <div>
                                    <label for="descricao" class="block text-sm font-semibold text-text-dark mb-2">
                                        �� Descrição
                                    </label>
                                    <textarea name="descricao" 
                                              id="descricao" 
                                              rows="4"
                                              class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all @error('descricao') border-red-500 ring-2 ring-red-200 @enderror"
                                              placeholder="Descreva as características e detalhes do produto...">{{ old('descricao') }}</textarea>
                                    @error('descricao')
                                        <p class="mt-2 text-sm text-red-600 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                            </div>
                        </div>

                                                <!-- Botões -->
                        <div class="flex flex-col sm:flex-row justify-between items-center pt-8 border-t border-gray-200 space-y-4 sm:space-y-0">
                            <div class="text-sm text-text-light flex items-center">
                                <svg class="w-4 h-4 mr-1 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                                * Campos obrigatórios
                            </div>
                            <div class="flex space-x-4">
                                <a href="{{ route('produtos.index') }}"
                                    class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300">
                                    Cancelar
                                </a>
                                <button type="submit"
                                        class="warm-gradient text-white font-semibold py-3 px-6 rounded-xl hover:opacity-90 transition-all duration-300 transform hover:scale-105 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                    </svg>
                                    Salvar Produto
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript para Preview da Imagem -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('imagem');
            const imagePreview = document.getElementById('image-preview');

            imageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.innerHTML = `
                            <img src="${e.target.result}" 
                                 alt="Preview" 
                                 class="w-full h-full object-cover rounded-xl">
                        `;
                    };
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.innerHTML = `
                        <div class="text-center">
                            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="mt-2 text-sm text-gray-500">Clique para adicionar imagem</p>
                        </div>
                    `;
                }
            });
        });
    </script>
</x-app-layout>