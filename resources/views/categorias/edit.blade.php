<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-secondary/20 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-secondary-dark" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-text-dark leading-tight">
                        Editar Categoria
                    </h2>
                    <p class="text-text-light text-sm">Atualize as informações da categoria</p>
                </div>
            </div>
            <a href="{{ route('categorias.show', $categoria) }}" 
                class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                </svg>
                Cancelar
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Card de Info da Categoria -->
            <div class="bg-gradient-to-r from-secondary/10 to-primary/10 rounded-2xl p-6 border border-secondary/20">
                <div class="flex items-center">
                    <div class="w-16 h-16 bg-secondary/20 rounded-full flex items-center justify-center mr-4">
                        <svg class="w-8 h-8 text-secondary-dark" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-text-dark">{{ $categoria->nome }}</h3>
                        <p class="text-text-light">Categoria criada em {{ \Carbon\Carbon::parse($categoria->created_at)->format('d/m/Y') }}</p>
                        <div class="flex items-center mt-2 space-x-3">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $categoria->status == 'ativo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $categoria->status == 'ativo' ? '✅ Ativo' : '❌ Inativo' }}
                            </span>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                📦 {{ $categoria->produtos_count }} produto(s)
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulário de Edição -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-secondary/20">
                <div class="p-8">

                    <!-- Header do Form -->
                    <div class="flex items-center mb-8">
                        <div class="w-10 h-10 bg-secondary/20 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 text-secondary-dark" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-text-dark">Atualizar Informações</h3>
                            <p class="text-sm text-text-light">Modifique os dados da categoria conforme necessário</p>
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
                    <form action="{{ route('categorias.update', $categoria) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Nome -->
                        <div>
                            <label for="nome" class="block text-sm font-semibold text-text-dark mb-2">
                                🏷️ Nome da Categoria *
                            </label>
                            <input type="text" 
                                   name="nome" 
                                   id="nome" 
                                   value="{{ old('nome', $categoria->nome) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary transition-all @error('nome') border-red-500 ring-2 ring-red-200 @enderror"
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

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-semibold text-text-dark mb-2">
                                📊 Status *
                            </label>
                            <select name="status" 
                                    id="status" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary transition-all @error('status') border-red-500 ring-2 ring-red-200 @enderror"
                                    required>
                                <option value="">Selecione o status</option>
                                <option value="ativo" {{ old('status', $categoria->status) == 'ativo' ? 'selected' : '' }}>
                                    ✅ Ativo
                                </option>
                                <option value="inativo" {{ old('status', $categoria->status) == 'inativo' ? 'selected' : '' }}>
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

                        <!-- Descrição -->
                        <div>
                            <label for="descricao" class="block text-sm font-semibold text-text-dark mb-2">
                                📝 Descrição
                            </label>
                            <textarea name="descricao" 
                                      id="descricao" 
                                      rows="4"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary transition-all @error('descricao') border-red-500 ring-2 ring-red-200 @enderror"
                                      placeholder="Descreva o tipo de produtos que esta categoria irá agrupar...">{{ old('descricao', $categoria->descricao) }}</textarea>
                            @error('descricao')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Aviso sobre produtos -->
                        @if($categoria->produtos_count > 0)
                        <div class="bg-yellow-50 border-2 border-yellow-200 rounded-xl p-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-yellow-600 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                </svg>
                                <div>
                                    <h4 class="text-sm font-semibold text-yellow-800">⚠️ Atenção</h4>
                                    <p class="text-sm text-yellow-700 mt-1">
                                        Esta categoria possui <strong>{{ $categoria->produtos_count }} produto(s)</strong> associado(s). 
                                        Alterar o status para "Inativo" pode afetar a visibilidade destes produtos.
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Preview da Categoria -->
                        <div class="bg-gradient-to-br from-secondary/5 to-primary/5 rounded-xl p-6 border border-secondary/20">
                            <h4 class="text-sm font-semibold text-text-dark mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-secondary-dark" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                </svg>
                                Preview das Alterações
                            </h4>
                            <div class="bg-white rounded-lg p-4 border border-gray-200">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-secondary/20 rounded-xl flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-secondary-dark" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="text-sm font-semibold text-text-dark" id="preview-nome">{{ $categoria->nome }}</div>
                                        <div class="text-xs text-text-light" id="preview-descricao">{{ $categoria->descricao ?: 'Sem descrição' }}</div>
                                    </div>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $categoria->status == 'ativo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}" id="preview-status">
                                        {{ $categoria->status == 'ativo' ? '✅ Ativo' : '❌ Inativo' }}
                                    </span>
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
                                <a href="{{ route('categorias.show', $categoria) }}" 
                                   class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300">
                                    Cancelar
                                </a>
                                <button type="submit" 
                                        class="bg-secondary hover:bg-secondary-dark text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                    </svg>
                                    Salvar Alterações
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript para Preview -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nomeInput = document.getElementById('nome');
            const descricaoInput = document.getElementById('descricao');
            const statusSelect = document.getElementById('status');
            
            const previewNome = document.getElementById('preview-nome');
            const previewDescricao = document.getElementById('preview-descricao');
            const previewStatus = document.getElementById('preview-status');

            function updatePreview() {
                // Atualizar nome
                const nome = nomeInput.value || '{{ $categoria->nome }}';
                previewNome.textContent = nome;

                // Atualizar descrição
                const descricao = descricaoInput.value || 'Sem descrição';
                previewDescricao.textContent = descricao;

                // Atualizar status
                const status = statusSelect.value;
                if (status === 'ativo') {
                    previewStatus.className = 'px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800';
                    previewStatus.textContent = '✅ Ativo';
                } else if (status === 'inativo') {
                    previewStatus.className = 'px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800';
                    previewStatus.textContent = '❌ Inativo';
                }
            }

            nomeInput.addEventListener('input', updatePreview);
            descricaoInput.addEventListener('input', updatePreview);
            statusSelect.addEventListener('change', updatePreview);
        });
    </script>
</x-app-layout>