<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
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

            <!-- Card de Filtros -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form method="GET" action="{{ route('clientes.index') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            
                            <!-- Busca -->
                            <div class="md:col-span-2">
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                                    Buscar Cliente
                                </label>
                                <input type="text" 
                                       name="search" 
                                       id="search"
                                       value="{{ request('search') }}"
                                       placeholder="Nome, email ou CPF..."
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                                    Status
                                </label>
                                <select name="status" 
                                        id="status"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Todos</option>
                                    <option value="ativo" {{ request('status') == 'ativo' ? 'selected' : '' }}>Ativo</option>
                                    <option value="inativo" {{ request('status') == 'inativo' ? 'selected' : '' }}>Inativo</option>
                                </select>
                            </div>

                            <!-- Ordenação -->
                            <div>
                                <label for="sort_by" class="block text-sm font-medium text-gray-700 mb-1">
                                    Ordenar por
                                </label>
                                <select name="sort_by" 
                                        id="sort_by"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="nome" {{ request('sort_by', 'nome') == 'nome' ? 'selected' : '' }}>Nome</option>
                                    <option value="email" {{ request('sort_by') == 'email' ? 'selected' : '' }}>Email</option>
                                    <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Data de Cadastro</option>
                                </select>
                            </div>

                        </div>

                        <!-- Botões -->
                        <div class="flex justify-between items-center pt-4">
                            <div class="flex space-x-2">
                                <button type="submit" 
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    🔍 Filtrar
                                </button>
                                <a href="{{ route('clientes.index') }}" 
                                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    🔄 Limpar
                                </a>
                            </div>
                            
                            <!-- Direção da ordenação -->
                            <div class="flex items-center space-x-2">
                                <label class="text-sm text-gray-700">Ordem:</label>
                                <select name="sort_direction" 
                                        class="px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="asc" {{ request('sort_direction', 'asc') == 'asc' ? 'selected' : '' }}>↑ Crescente</option>
                                    <option value="desc" {{ request('sort_direction') == 'desc' ? 'selected' : '' }}>↓ Decrescente</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Card Principal -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Header -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-lg font-medium">Lista de Clientes</h3>
                            <p class="text-sm text-gray-500 mt-1">
                                {{ $clientes->total() }} cliente(s) encontrado(s)
                                @if(request()->hasAny(['search', 'status']))
                                    <span class="text-blue-600">
                                        (filtrado{{ request('search') ? ' por "' . request('search') . '"' : '' }}{{ request('status') ? ' - status: ' . request('status') : '' }})
                                    </span>
                                @endif
                            </p>
                        </div>
                        <a href="{{ route('clientes.create') }}" 
                           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            👤 Novo Cliente
                        </a>
                    </div>

                    <!-- Tabela -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'nome', 'sort_direction' => request('sort_by') == 'nome' && request('sort_direction') == 'asc' ? 'desc' : 'asc']) }}" 
                                           class="flex items-center hover:text-gray-700">
                                            Nome
                                            @if(request('sort_by', 'nome') == 'nome')
                                                <span class="ml-1">
                                                    @if(request('sort_direction', 'asc') == 'asc')
                                                        ↑
                                                    @else
                                                        ↓
                                                    @endif
                                                </span>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'email', 'sort_direction' => request('sort_by') == 'email' && request('sort_direction') == 'asc' ? 'desc' : 'asc']) }}" 
                                           class="flex items-center hover:text-gray-700">
                                            Email
                                            @if(request('sort_by') == 'email')
                                                <span class="ml-1">
                                                    @if(request('sort_direction', 'asc') == 'asc')
                                                        ↑
                                                    @else
                                                        ↓
                                                    @endif
                                                </span>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        CPF
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'created_at', 'sort_direction' => request('sort_by') == 'created_at' && request('sort_direction') == 'asc' ? 'desc' : 'asc']) }}" 
                                           class="flex items-center hover:text-gray-700">
                                            Cadastro
                                            @if(request('sort_by') == 'created_at')
                                                <span class="ml-1">
                                                    @if(request('sort_direction', 'asc') == 'asc')
                                                        ↑
                                                    @else
                                                        ↓
                                                    @endif
                                                </span>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Ações
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($clientes as $cliente)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">{{ $cliente->nome }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $cliente->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900 font-mono">{{ $cliente->cpf }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $cliente->status == 'ativo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ ucfirst($cliente->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ \Carbon\Carbon::parse($cliente->created_at)->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <a href="{{ route('clientes.show', $cliente) }}" 
                                               class="text-blue-600 hover:text-blue-900">Ver</a>
                                            <a href="{{ route('clientes.edit', $cliente) }}" 
                                               class="text-yellow-600 hover:text-yellow-900">Editar</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                @if(request()->hasAny(['search', 'status']))
                                                    <svg class="h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.47-.881-6.08-2.33"/>
                                                    </svg>
                                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Nenhum cliente encontrado</h3>
                                                    <p class="text-gray-500 mb-4">Tente ajustar os filtros de busca.</p>
                                                    <a href="{{ route('clientes.index') }}" 
                                                       class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                                        🔄 Limpar Filtros
                                                    </a>
                                                @else
                                                    <svg class="h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                    </svg>
                                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Nenhum cliente cadastrado</h3>
                                                    <p class="text-gray-500 mb-4">Comece criando seu primeiro cliente.</p>
                                                    <a href="{{ route('clientes.create') }}" 
                                                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                        👤 Criar Primeiro Cliente
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginação -->
                    @if($clientes->hasPages())
                        <div class="mt-6 flex items-center justify-between">
                            <div class="text-sm text-gray-700">
                                Mostrando {{ $clientes->firstItem() }} a {{ $clientes->lastItem() }} 
                                de {{ $clientes->total() }} resultados
                            </div>
                            <div>
                                {{ $clientes->links() }}
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>