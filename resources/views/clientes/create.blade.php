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
                        Novo Cliente
                    </h2>
                    <p class="text-text-light text-sm">Cadastre um novo cliente no sistema</p>
                </div>
            </div>
            <a href="{{ route('clientes.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 flex items-center">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                </svg>
                Voltar
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-primary/20">
                <div class="p-8">
                    
                    <!-- Header do Form -->
                    <div class="flex items-center mb-8">
                        <div class="w-10 h-10 bg-primary/20 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 text-primary-dark" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-text-dark">Informações do Cliente</h3>
                            <p class="text-sm text-text-light">Preencha os dados abaixo para cadastrar o cliente</p>
                        </div>
                    </div>

                    <form action="{{ route('clientes.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- Nome -->
                            <div class="md:col-span-2">
                                <label for="nome" class="block text-sm font-semibold text-text-dark mb-2">
                                    👤 Nome Completo *
                                </label>
                                <input type="text"
                                    name="nome"
                                    id="nome"
                                    value="{{ old('nome') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all @error('nome') border-red-500 ring-2 ring-red-200 @enderror"
                                    placeholder="Digite o nome completo do cliente"
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

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-semibold text-text-dark mb-2">
                                    📧 E-mail *
                                </label>
                                <input type="email"
                                    name="email"
                                    id="email"
                                    value="{{ old('email') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all @error('email') border-red-500 ring-2 ring-red-200 @enderror"
                                    placeholder="cliente@email.com"
                                    required>
                                @error('email')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <!-- CPF -->
                            <div>
                                <label for="cpf" class="block text-sm font-semibold text-text-dark mb-2">
                                    🆔 CPF *
                                </label>
                                <input type="text"
                                    name="cpf"
                                    id="cpf"
                                    value="{{ old('cpf') }}"
                                    placeholder="000.000.000-00"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all @error('cpf') border-red-500 ring-2 ring-red-200 @enderror"
                                    required>
                                @error('cpf')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <!-- Telefone -->
                            <div>
                                <label for="telefone" class="block text-sm font-semibold text-text-dark mb-2">
                                    📱 Telefone
                                </label>
                                <input type="text"
                                    name="telefone"
                                    id="telefone"
                                    value="{{ old('telefone') }}"
                                    placeholder="(00) 00000-0000"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all @error('telefone') border-red-500 ring-2 ring-red-200 @enderror">
                                @error('telefone')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <!-- Data de Nascimento -->
                            <div>
                                <label for="data_nascimento" class="block text-sm font-semibold text-text-dark mb-2">
                                    🎂 Data de Nascimento
                                </label>
                                <input type="date"
                                    name="data_nascimento"
                                    id="data_nascimento"
                                    value="{{ old('data_nascimento') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all @error('data_nascimento') border-red-500 ring-2 ring-red-200 @enderror">
                                @error('data_nascimento')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="md:col-span-2">
                                <label for="status" class="block text-sm font-semibold text-text-dark mb-2">
                                    📊 Status *
                                </label>
                                <select name="status"
                                    id="status"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all @error('status') border-red-500 ring-2 ring-red-200 @enderror"
                                    required>
                                    <option value="ativo" {{ old('status', 'ativo') == 'ativo' ? 'selected' : '' }}>✅ Ativo</option>
                                    <option value="inativo" {{ old('status') == 'inativo' ? 'selected' : '' }}>❌ Inativo</option>
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

                            <!-- Endereço -->
                            <div class="md:col-span-2">
                                <label for="endereco" class="block text-sm font-semibold text-text-dark mb-2">
                                    🏠 Endereço
                                </label>
                                <textarea name="endereco"
                                    id="endereco"
                                    rows="3"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all @error('endereco') border-red-500 ring-2 ring-red-200 @enderror"
                                    placeholder="Rua, número, complemento, bairro, cidade...">{{ old('endereco') }}</textarea>
                                @error('endereco')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                                    </svg>
                                    {{ $message }}
                                </p>
                                @enderror
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
                                <a href="{{ route('clientes.index') }}"
                                    class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300">
                                    Cancelar
                                </a>
                                <button type="submit"
                                    class="warm-gradient text-white font-semibold py-3 px-6 rounded-xl hover:opacity-90 transition-all duration-300 transform hover:scale-105 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                                    </svg>
                                    Salvar Cliente
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript para máscaras -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Máscara para CPF
            const cpfInput = document.getElementById('cpf');
            cpfInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                e.target.value = value;
            });

            // Máscara para telefone
            const telefoneInput = document.getElementById('telefone');
            telefoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');
                if (value.length <= 10) {
                    value = value.replace(/(\d{2})(\d)/, '($1) $2');
                    value = value.replace(/(\d{4})(\d)/, '$1-$2');
                } else {
                    value = value.replace(/(\d{2})(\d)/, '($1) $2');
                    value = value.replace(/(\d{5})(\d)/, '$1-$2');
                }
                e.target.value = value;
            });
        });
    </script>
</x-app-layout>