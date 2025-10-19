<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nova Categoria') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Cadastrar Nova Categoria</h3>
                        <a href="{{ route('categorias.index') }}" 
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
                    <form action="{{ route('categorias.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Nome -->
                        <div>
                            <label for="nome" class="block text-sm font-medium text-gray-700 mb-2">
                                Nome da Categoria *
                            </label>
                            <input type="text" 
                                   name="nome" 
                                   id="nome" 
                                   value="{{ old('nome') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('nome') border-red-500 @enderror"
                                   placeholder="Ex: Eletrônicos, Roupas, Casa e Jardim..."
                                   required>
                            @error('nome')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                Status *
                            </label>
                            <select name="status" 
                                    id="status" 
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

                        <!-- Descrição -->
                        <div>
                            <label for="descricao" class="block text-sm font-medium text-gray-700 mb-2">
                                Descrição
                            </label>
                            <textarea name="descricao" 
                                      id="descricao" 
                                      rows="4"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('descricao') border-red-500 @enderror"
                                      placeholder="Descreva o tipo de produtos que esta categoria irá agrupar...">{{ old('descricao') }}</textarea>
                            @error('descricao')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botões -->
                        <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                            <div class="text-sm text-gray-500">
                                * Campos obrigatórios
                            </div>
                            <div class="flex space-x-3">
                                <a href="{{ route('categorias.index') }}" 
                                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                                    Cancelar
                                </a>
                                <button type="submit" 
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                                    💾 Salvar Categoria
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>