<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Cliente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Editar Informações do Cliente</h3>
                        <a href="{{ route('clientes.show', $cliente) }}"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Cancelar
                        </a>
                    </div>

                    <!-- Mensagens de erro -->
                    @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        <strong>Ops! Alguns campos precisam ser corrigidos:</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Formulário -->
                    <form action="{{ route('clientes.update', $cliente) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- Nome -->
                            <div class="md:col-span-2">
                                <label for="nome" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nome Completo *
                                </label>
                                <input type="text"
                                    name="nome"
                                    id="nome"
                                    value="{{ old('nome', $cliente->nome) }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('nome') border-red-500 @enderror"
                                    required>
                                @error('nome')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                    Email *
                                </label>
                                <input type="email"
                                    name="email"
                                    id="email"
                                    value="{{ old('email', $cliente->email) }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                                    required>
                                @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- CPF -->
                            <div>
                                <label for="cpf" class="block text-sm font-medium text-gray-700 mb-2">
                                    CPF *
                                </label>
                                <input type="text"
                                    name="cpf"
                                    id="cpf"
                                    value="{{ old('cpf', $cliente->cpf) }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('cpf') border-red-500 @enderror"
                                    placeholder="000.000.000-00"
                                    maxlength="14"
                                    required>
                                @error('cpf')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Telefone -->
                            <div>
                                <label for="telefone" class="block text-sm font-medium text-gray-700 mb-2">
                                    Telefone
                                </label>
                                <input type="text"
                                    name="telefone"
                                    id="telefone"
                                    value="{{ old('telefone', $cliente->telefone) }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('telefone') border-red-500 @enderror"
                                    placeholder="(00) 00000-0000">
                                @error('telefone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Data de Nascimento -->
                            <div>
                                <label for="data_nascimento" class="block text-sm font-medium text-gray-700 mb-2">
                                    Data de Nascimento
                                </label>
                                <input type="date"
                                    name="data_nascimento"
                                    id="data_nascimento"
                                    value="{{ old('data_nascimento', $cliente->data_nascimento ? \Carbon\Carbon::parse($cliente->data_nascimento)->format('Y-m-d') : '') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('data_nascimento') border-red-500 @enderror">
                                @error('data_nascimento')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="md:col-span-2">
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                    Status *
                                </label>
                                <select name="status"
                                    id="status"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror"
                                    required>
                                    <option value="">Selecione o status</option>
                                    <option value="ativo" {{ old('status', $cliente->status) == 'ativo' ? 'selected' : '' }}>
                                        Ativo
                                    </option>
                                    <option value="inativo" {{ old('status', $cliente->status) == 'inativo' ? 'selected' : '' }}>
                                        Inativo
                                    </option>
                                </select>
                                @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Endereço -->
                            <div class="md:col-span-2">
                                <label for="endereco" class="block text-sm font-medium text-gray-700 mb-2">
                                    Endereço
                                </label>
                                <textarea name="endereco"
                                    id="endereco"
                                    rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 @error('endereco') border-red-500 @enderror"
                                    placeholder="Rua, número, complemento, bairro, cidade...">{{ old('endereco', $cliente->endereco) }}</textarea>
                                @error('endereco')
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
                                <a href="{{ route('clientes.show', $cliente) }}"
                                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                                    Cancelar
                                </a>
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                                    💾 Salvar Alterações
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