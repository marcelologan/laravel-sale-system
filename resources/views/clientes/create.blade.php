<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Novo Cliente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Cadastrar Novo Cliente</h3>
                        <a href="{{ route('clientes.index') }}"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Voltar
                        </a>
                    </div>

                    <form action="{{ route('clientes.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Nome -->
                        <div>
                            <label for="nome" class="block text-sm font-medium text-gray-700">Nome *</label>
                            <input type="text"
                                name="nome"
                                id="nome"
                                value="{{ old('nome') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('nome') border-red-500 @enderror"
                                required>
                            @error('nome')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
                            <input type="email"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('email') border-red-500 @enderror"
                                required>
                            @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- CPF -->
                        <div>
                            <label for="cpf" class="block text-sm font-medium text-gray-700">CPF *</label>
                            <input type="text"
                                name="cpf"
                                id="cpf"
                                value="{{ old('cpf') }}"
                                placeholder="000.000.000-00"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('cpf') border-red-500 @enderror"
                                required>
                            @error('cpf')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Telefone -->
                        <div>
                            <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
                            <input type="text"
                                name="telefone"
                                id="telefone"
                                value="{{ old('telefone') }}"
                                placeholder="(00) 00000-0000"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('telefone') border-red-500 @enderror">
                            @error('telefone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Data de Nascimento -->
                        <div>
                            <label for="data_nascimento" class="block text-sm font-medium text-gray-700">Data de Nascimento</label>
                            <input type="date"
                                name="data_nascimento"
                                id="data_nascimento"
                                value="{{ old('data_nascimento') }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('data_nascimento') border-red-500 @enderror">
                            @error('data_nascimento')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Endereço -->
                        <div>
                            <label for="endereco" class="block text-sm font-medium text-gray-700">Endereço</label>
                            <textarea name="endereco"
                                id="endereco"
                                rows="3"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('endereco') border-red-500 @enderror">{{ old('endereco') }}</textarea>
                            @error('endereco')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700">Status *</label>
                            <select name="status"
                                id="status"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('status') border-red-500 @enderror"
                                required>
                                <option value="ativo" {{ old('status') == 'ativo' ? 'selected' : '' }}>Ativo</option>
                                <option value="inativo" {{ old('status') == 'inativo' ? 'selected' : '' }}>Inativo</option>
                            </select>
                            @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botões -->
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ route('clientes.index') }}"
                                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                                Cancelar
                            </a>
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Salvar Cliente
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>