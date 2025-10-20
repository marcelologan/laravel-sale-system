<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-primary/20 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-primary-dark" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-text-dark leading-tight">
                        Gestão de Clientes
                    </h2>
                    <p class="text-text-light text-sm">Gerencie sua base de clientes</p>
                </div>
            </div>
            <a href="{{ route('clientes.create') }}" 
               class="warm-gradient text-white font-semibold py-3 px-6 rounded-xl hover:opacity-90 transition-all duration-300 transform hover:scale-105 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4v16m8-8H4"/>
                </svg>
                Novo Cliente
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Card de Filtros -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-primary/20">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-link/20 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-link" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-text-dark">Filtros de Busca</h3>
                    </div>
                    
                    <form method="GET" action="{{ route('clientes.index') }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            
                            <!-- Busca -->
                            <div class="md:col-span-2">
                                <label for="search" class="block text-sm font-semibold text-text-dark mb-2">
                                    🔍 Buscar Cliente
                                </label>
                                <input type="text" 
                                       name="search" 
                                       id="search"
                                       value="{{ request('search') }}"
                                       placeholder="Nome, email ou CPF..."
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-semibold text-text-dark mb-2">
                                    📊 Status
                                </label>
                                <select name="status" 
                                        id="status"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                                    <option value="">Todos os status</option>
                                    <option value="ativo" {{ request('status') == 'ativo' ? 'selected' : '' }}>✅ Ativo</option>
                                    <option value="inativo" {{ request('status') == 'inativo' ? 'selected' : '' }}>❌ Inativo</option>
                                </select>
                            </div>

                            <!-- Ordenação -->
                            <div>
                                <label for="sort_by" class="block text-sm font-semibold text-text-dark mb-2">
                                    📋 Ordenar por
                                </label>
                                <select name="sort_by" 
                                        id="sort_by"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all">
                                    <option value="nome" {{ request('sort_by', 'nome') == 'nome' ? 'selected' : '' }}>Nome</option>
                                    <option value="email" {{ request('sort_by') == 'email' ? 'selected' : '' }}>Email</option>
                                    <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Data de Cadastro</option>
                                </select>
                            </div>

                        </div>

                        <!-- Botões e Direção -->
                        <div class="flex flex-col sm:flex-row justify-between items-center pt-4 space-y-4 sm:space-y-0">
                            <div class="flex space-x-3">
                                <button type="submit" 
                                        class="bg-link hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z"/>
                                    </svg>
                                    Filtrar
                                </button>
                                <a href="{{ route('clientes.index') }}" 
                                   class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.65,6.35C16.2,4.9 14.21,4 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20C15.73,20 18.84,17.45 19.73,14H17.65C16.83,16.33 14.61,18 12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6C13.66,6 15.14,6.69 16.22,7.78L13,11H20V4L17.65,6.35Z"/>
                                    </svg>
                                    Limpar
                                </a>
                            </div>
                            
                            <!-- Direção da ordenação -->
                            <div class="flex items-center space-x-3">
                                <label class="text-sm font-medium text-text-dark">Ordem:</label>
                                <select name="sort_direction" 
                                        class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary">
                                    <option value="asc" {{ request('sort_direction', 'asc') == 'asc' ? 'selected' : '' }}>↑ Crescente</option>
                                    <option value="desc" {{ request('sort_direction') == 'desc' ? 'selected' : '' }}>↓ Decrescente</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Card Principal -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-primary/20">
                <div class="p-6">
                    
                    <!-- Header -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 space-y-4 sm:space-y-0">
                        <div>
                            <h3 class="text-xl font-bold text-text-dark flex items-center">
                                <svg class="w-6 h-6 mr-2 text-primary-dark" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Lista de Clientes
                            </h3>
                            <p class="text-sm text-text-light mt-1">
                                <span class="font-semibold text-primary-dark">{{ $clientes->total() }}</span> cliente(s) encontrado(s)
                                @if(request()->hasAny(['search', 'status']))
                                    <span class="text-link font-medium">
                                        (filtrado{{ request('search') ? ' por "' . request('search') . '"' : '' }}{{ request('status') ? ' - status: ' . request('status') : '' }})
                                    </span>
                                @endif
                            </p>
                        </div>
                        
                        <!-- Stats rápidas -->
                        <div class="flex space-x-4">
                            <div class="text-center">
                                <div class="text-lg font-bold text-green-600">{{ $clientes->where('status', 'ativo')->count() }}</div>
                                <div class="text-xs text-text-light">Ativos</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-bold text-red-600">{{ $clientes->where('status', 'inativo')->count() }}</div>
                                <div class="text-xs text-text-light">Inativos</div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabela -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-primary/10 to-secondary/10">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-text-dark uppercase tracking-wider">
                                        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'nome', 'sort_direction' => request('sort_by') == 'nome' && request('sort_direction') == 'asc' ? 'desc' : 'asc']) }}" 
                                           class="flex items-center hover:text-primary-dark transition-colors">
                                            👤 Nome
                                            @if(request('sort_by', 'nome') == 'nome')
                                                <span class="ml-2 text-primary-dark">
                                                    @if(request('sort_direction', 'asc') == 'asc')
                                                        ↑
                                                    @else
                                                        ↓
                                                    @endif
                                                </span>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-text-dark uppercase tracking-wider">
                                        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'email', 'sort_direction' => request('sort_by') == 'email' && request('sort_direction') == 'asc' ? 'desc' : 'asc']) }}" 
                                           class="flex items-center hover:text-primary-dark transition-colors">
                                            📧 Email
                                            @if(request('sort_by') == 'email')
                                                <span class="ml-2 text-primary-dark">
                                                    @if(request('sort_direction', 'asc') == 'asc')
                                                        ↑
                                                    @else
                                                        ↓
                                                    @endif
                                                </span>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-text-dark uppercase tracking-wider">
                                        🆔 CPF
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-text-dark uppercase tracking-wider">
                                        📊 Status
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-text-dark uppercase tracking-wider">
                                        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'created_at', 'sort_direction' => request('sort_by') == 'created_at' && request('sort_direction') == 'asc' ? 'desc' : 'asc']) }}" 
                                           class="flex items-center hover:text-primary-dark transition-colors">
                                            �� Cadastro
                                            @if(request('sort_by') == 'created_at')
                                                <span class="ml-2 text-primary-dark">
                                                    @if(request('sort_direction', 'asc') == 'asc')
                                                        ↑
                                                    @else
                                                        ↓
                                                    @endif
                                                </span>
                                            @endif
                                        </a>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-text-dark uppercase tracking-wider">
                                        ⚡ Ações
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($clientes as $cliente)
                                    <tr class="hover:bg-primary/5 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="w-10 h-10 bg-primary/20 rounded-full flex items-center justify-center mr-3">
                                                    <svg class="w-5 h-5 text-primary-dark" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-semibold text-text-dark">{{ $cliente->nome }}</div>
                                                    @if($cliente->telefone)
                                                        <div class="text-xs text-text-light">📱 {{ $cliente->telefone }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-text-dark">{{ $cliente->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-text-dark font-mono bg-gray-100 px-2 py-1 rounded">{{ $cliente->cpf }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $cliente->status == 'ativo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $cliente->status == 'ativo' ? '✅ Ativo' : '❌ Inativo' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-text-light">
                                            <div class="flex flex-col">
                                                <span class="font-medium">{{ \Carbon\Carbon::parse($cliente->created_at)->format('d/m/Y') }}</span>
                                                <span class="text-xs">{{ \Carbon\Carbon::parse($cliente->created_at)->format('H:i') }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('clientes.show', $cliente) }}" 
                                                   class="bg-link/10 text-link hover:bg-link hover:text-white px-3 py-2 rounded-lg transition-all duration-300 flex items-center">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                                                    </svg>
                                                </a>
                                                <a href="{{ route('clientes.edit', $cliente) }}" 
                                                   class="bg-secondary/10 text-secondary-dark hover:bg-secondary hover:text-white px-3 py-2 rounded-lg transition-all duration-300 flex items-center">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-16 text-center">
                                            <div class="flex flex-col items-center">
                                                @if(request()->hasAny(['search', 'status']))
                                                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                                        <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.47-.881-6.08-2.33"/>
                                                        </svg>
                                                    </div>
                                                    <h3 class="text-lg font-semibold text-text-dark mb-2">🔍 Nenhum cliente encontrado</h3>
                                                    <p class="text-text-light mb-6">Tente ajustar os filtros de busca ou criar um novo cliente.</p>
                                                    <div class="flex space-x-3">
                                                        <a href="{{ route('clientes.index') }}" 
                                                           class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                                            🔄 Limpar Filtros
                                                        </a>
                                                        <a href="{{ route('clientes.create') }}" 
                                                           class="warm-gradient text-white font-semibold py-2 px-4 rounded-lg hover:opacity-90 transition-all">
                                                            ➕ Novo Cliente
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="w-20 h-20 bg-primary/20 rounded-full flex items-center justify-center mb-4">
                                                        <svg class="h-10 w-10 text-primary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                                        </svg>
                                                    </div>
                                                    <h3 class="text-lg font-semibold text-text-dark mb-2">👥 Nenhum cliente cadastrado</h3>
                                                    <p class="text-text-light mb-6">Comece criando seu primeiro cliente para gerenciar sua base.</p>
                                                    <a href="{{ route('clientes.create') }}" 
                                                       class="warm-gradient text-white font-semibold py-3 px-6 rounded-xl hover:opacity-90 transition-all duration-300 transform hover:scale-105">
                                                        🚀 Criar Primeiro Cliente
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
                        <div class="mt-8 flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
                            <div class="text-sm text-text-light">
                                Mostrando <span class="font-semibold text-text-dark">{{ $clientes->firstItem() }}</span> a 
                                <span class="font-semibold text-text-dark">{{ $clientes->lastItem() }}</span> de 
                                <span class="font-semibold text-text-dark">{{ $clientes->total() }}</span> resultados
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