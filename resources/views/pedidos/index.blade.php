<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-secondary/20 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-secondary-dark" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7 4V2C7 1.45 7.45 1 8 1H16C16.55 1 17 1.45 17 2V4H20C20.55 4 21 4.45 21 5S20.55 6 20 6H19V19C19 20.1 18.1 21 17 21H7C5.9 21 5 20.1 5 19V6H4C3.45 6 3 5.55 3 5S3.45 4 4 4H7Z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-text-dark leading-tight">
                        Gestão de Pedidos
                    </h2>
                    <p class="text-text-light text-sm">Gerencie todos os pedidos do sistema</p>
                </div>
            </div>
            <a href="{{ route('pedidos.create') }}" 
               class="bg-secondary hover:bg-secondary-dark text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 4v16m8-8H4"/>
                </svg>
                Novo Pedido
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Card de Filtros -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-secondary/20">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-link/20 rounded-lg flex items-center justify-center mr-3">
                            <svg class="w-4 h-4 text-link" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-text-dark">🔍 Filtros Avançados</h3>
                    </div>

                    <form method="GET" action="{{ route('pedidos.index') }}" class="space-y-4">

                        <!-- Primeira linha de filtros -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                            <!-- Busca -->
                            <div>
                                <label for="search" class="block text-sm font-semibold text-text-dark mb-2">
                                    🔍 Buscar Pedido
                                </label>
                                <input type="text" 
                                       name="search" 
                                       id="search" 
                                       value="{{ request('search') }}"
                                       placeholder="Número do pedido ou nome do cliente..."
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary transition-all">
                            </div>

                            <!-- Cliente -->
                            <div>
                                <label for="cliente_id" class="block text-sm font-semibold text-text-dark mb-2">
                                    👤 Cliente
                                </label>
                                <select name="cliente_id" 
                                        id="cliente_id"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary transition-all">
                                    <option value="">Todos os clientes</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}" {{ request('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                            {{ $cliente->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-semibold text-text-dark mb-2">
                                    📊 Status
                                </label>
                                <select name="status" 
                                        id="status"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary transition-all">
                                    <option value="">Todos os status</option>
                                    <option value="pendente" {{ request('status') == 'pendente' ? 'selected' : '' }}>
                                        ⏳ Pendente
                                    </option>
                                    <option value="confirmado" {{ request('status') == 'confirmado' ? 'selected' : '' }}>
                                        ✅ Confirmado
                                    </option>
                                    <option value="entregue" {{ request('status') == 'entregue' ? 'selected' : '' }}>
                                        🚚 Entregue
                                    </option>
                                    <option value="cancelado" {{ request('status') == 'cancelado' ? 'selected' : '' }}>
                                        ❌ Cancelado
                                    </option>
                                </select>
                            </div>

                        </div>

                        <!-- Segunda linha de filtros -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                            <!-- Data Início -->
                            <div>
                                <label for="data_inicio" class="block text-sm font-semibold text-text-dark mb-2">
                                    📅 Data Início
                                </label>
                                <input type="date" 
                                       name="data_inicio" 
                                       id="data_inicio"
                                       value="{{ request('data_inicio') }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary transition-all">
                            </div>

                            <!-- Data Fim -->
                            <div>
                                <label for="data_fim" class="block text-sm font-semibold text-text-dark mb-2">
                                    📅 Data Fim
                                </label>
                                <input type="date" 
                                       name="data_fim" 
                                       id="data_fim" 
                                       value="{{ request('data_fim') }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary transition-all">
                            </div>

                            <!-- Valor Mínimo -->
                            <div>
                                <label for="valor_min" class="block text-sm font-semibold text-text-dark mb-2">
                                    💰 Valor Mínimo (R\$)
                                </label>
                                <input type="number" 
                                       name="valor_min" 
                                       id="valor_min"
                                       value="{{ request('valor_min') }}" 
                                       step="0.01" 
                                       min="0" 
                                       placeholder="0,00"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary transition-all">
                            </div>

                            <!-- Ordenação -->
                            <div>
                                <label for="sort_by" class="block text-sm font-semibold text-text-dark mb-2">
                                    📋 Ordenar por
                                </label>
                                <select name="sort_by" 
                                        id="sort_by"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary transition-all">
                                    <option value="data_pedido" {{ request('sort_by', 'data_pedido') == 'data_pedido' ? 'selected' : '' }}>Data do Pedido</option>
                                    <option value="id" {{ request('sort_by') == 'id' ? 'selected' : '' }}>Número</option>
                                    <option value="valor_total" {{ request('sort_by') == 'valor_total' ? 'selected' : '' }}>Valor Total</option>
                                    <option value="status" {{ request('sort_by') == 'status' ? 'selected' : '' }}>Status</option>
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
                                <a href="{{ route('pedidos.index') }}"
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
                                        class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-secondary focus:border-secondary">
                                    <option value="desc" {{ request('sort_direction', 'desc') == 'desc' ? 'selected' : '' }}>↓ Mais recente</option>
                                    <option value="asc" {{ request('sort_direction') == 'asc' ? 'selected' : '' }}>↑ Mais antigo</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Card Principal -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-secondary/20">
                <div class="p-6">

                    <!-- Header -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 space-y-4 sm:space-y-0">
                        <div>
                            <h3 class="text-xl font-bold text-text-dark flex items-center">
                                <svg class="w-6 h-6 mr-2 text-secondary-dark" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M7 4V2C7 1.45 7.45 1 8 1H16C16.55 1 17 1.45 17 2V4H20C20.55 4 21 4.45 21 5S20.55 6 20 6H19V19C19 20.1 18.1 21 17 21H7C5.9 21 5 20.1 5 19V6H4C3.45 6 3 5.55 3 5S3.45 4 4 4H7Z"/>
                                </svg>
                                Lista de Pedidos
                            </h3>
                            <p class="text-sm text-text-light mt-1">
                                <span class="font-semibold text-secondary-dark">{{ $pedidos->total() }}</span> pedido(s) encontrado(s)
                                @if (request()->hasAny(['search', 'cliente_id', 'status', 'data_inicio', 'data_fim', 'valor_min']))
                                    <span class="text-link font-medium">(filtrado)</span>
                                @endif
                            </p>
                        </div>

                        <!-- Stats rápidas -->
                        <div class="flex space-x-4">
                            <div class="text-center">
                                <div class="text-lg font-bold text-yellow-600">{{ $pedidos->where('status', 'pendente')->count() }}</div>
                                <div class="text-xs text-text-light">Pendentes</div>
                            </div>
                            <div class="text-center">
                                <div class="text-lg font-bold text-green-600">{{ $pedidos->where('status', 'entregue')->count() }}</div>
                                <div class="text-xs text-text-light">Entregues</div>
                            </div>
                        </div>
                    </div>

                    <!-- Grid de Pedidos (Cards) -->
                    @if($pedidos->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($pedidos as $pedido)
                                <div class="bg-gradient-to-br from-secondary/5 to-primary/5 rounded-xl border border-secondary/20 hover:shadow-xl transition-all duration-300 transform hover:scale-105 overflow-hidden">
                                    
                                    <!-- Header do Card -->
                                    <div class="bg-gradient-to-r from-secondary/10 to-primary/10 p-4 border-b border-secondary/20">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h4 class="text-lg font-bold text-text-dark">#{{ $pedido->id }}</h4>
                                                <p class="text-sm text-text-light">{{ $pedido->data_pedido_formatada }}</p>
                                            </div>
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $pedido->status_cor }}">
                                                @switch($pedido->status)
                                                    @case('pendente')
                                                        ⏳ Pendente
                                                        @break
                                                    @case('confirmado')
                                                        ✅ Confirmado
                                                        @break
                                                    @case('entregue')
                                                        🚚 Entregue
                                                        @break
                                                    @case('cancelado')
                                                        ❌ Cancelado
                                                        @break
                                                @endswitch
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Corpo do Card -->
                                    <div class="p-4">
                                        <!-- Cliente -->
                                        <div class="mb-4">
                                            <div class="flex items-center">
                                                <div class="w-8 h-8 bg-primary/20 rounded-full flex items-center justify-center mr-3">
                                                    <svg class="w-4 h-4 text-primary-dark" fill="currentColor" viewBox="0 0 24 24">
                                                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <div class="text-sm font-semibold text-text-dark">{{ $pedido->cliente->nome }}</div>
                                                    @if ($pedido->cliente->telefone)
                                                        <div class="text-xs text-text-light">📱 {{ $pedido->cliente->telefone }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Valor e Itens -->
                                        <div class="grid grid-cols-2 gap-4 mb-4">
                                            <div class="bg-white rounded-lg p-3 border border-gray-200">
                                                <div class="text-xs text-text-light mb-1">💰 Valor Total</div>
                                                <div class="text-lg font-bold text-secondary-dark">{{ $pedido->valor_total_formatado }}</div>
                                            </div>
                                            <div class="bg-white rounded-lg p-3 border border-gray-200">
                                                <div class="text-xs text-text-light mb-1">📦 Itens</div>
                                                <div class="text-sm font-semibold text-text-dark">{{ $pedido->itens->count() }} item(ns)</div>
                                                <div class="text-xs text-text-light">{{ $pedido->itens->sum('quantidade') }} unidades</div>
                                            </div>
                                        </div>

                                        <!-- Tempo -->
                                        <div class="text-xs text-text-light mb-4">
                                            🕒 {{ $pedido->created_at->diffForHumans() }}
                                        </div>

                                        <!-- Ações -->
                                        <div class="flex flex-wrap gap-2">
                                            <!-- Ver -->
                                            <a href="{{ route('pedidos.show', $pedido) }}"
                                               class="flex-1 bg-link/10 text-link hover:bg-link hover:text-white px-3 py-2 rounded-lg transition-all duration-300 text-center text-xs font-medium">
                                                👁️ Ver
                                            </a>

                                            <!-- Editar (apenas se pendente) -->
                                            @if ($pedido->podeSerEditado())
                                                <a href="{{ route('pedidos.edit', $pedido) }}"
                                                   class="flex-1 bg-secondary/10 text-secondary-dark hover:bg-secondary hover:text-white px-3 py-2 rounded-lg transition-all duration-300 text-center text-xs font-medium">
                                                    ✏️ Editar
                                                </a>
                                            @endif

                                            <!-- Confirmar (apenas se pendente) -->
                                            @if ($pedido->status === 'pendente')
                                                <button onclick="confirmarPedido({{ $pedido->id }})"
                                                        class="flex-1 bg-green-100 text-green-800 hover:bg-green-500 hover:text-white px-3 py-2 rounded-lg transition-all duration-300 text-xs font-medium">
                                                    ✅ Confirmar
                                                </button>
                                            @endif

                                            <!-- Entregar (apenas se confirmado) -->
                                            @if ($pedido->status === 'confirmado')
                                                <button onclick="entregarPedido({{ $pedido->id }})"
                                                        class="flex-1 bg-purple-100 text-purple-800 hover:bg-purple-500 hover:text-white px-3 py-2 rounded-lg transition-all duration-300 text-xs font-medium">
                                                    �� Entregar
                                                </button>
                                            @endif

                                            <!-- Cancelar (se pode ser cancelado) -->
                                            @if ($pedido->podeSerCancelado())
                                                <button onclick="cancelarPedido({{ $pedido->id }})"
                                                        class="flex-1 bg-red-100 text-red-800 hover:bg-red-500 hover:text-white px-3 py-2 rounded-lg transition-all duration-300 text-xs font-medium">
                                                    ❌ Cancelar
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Estado Vazio -->
                        <div class="text-center py-16">
                            @if (request()->hasAny(['search', 'cliente_id', 'status', 'data_inicio', 'data_fim', 'valor_min']))
                                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-text-dark mb-2">🔍 Nenhum pedido encontrado</h3>
                                <p class="text-text-light mb-6">Tente ajustar os filtros de busca ou criar um novo pedido.</p>
                                <div class="flex justify-center space-x-3">
                                    <a href="{{ route('pedidos.index') }}"
                                       class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                        �� Limpar Filtros
                                    </a>
                                    <a href="{{ route('pedidos.create') }}"
                                       class="bg-secondary hover:bg-secondary-dark text-white font-semibold py-2 px-4 rounded-lg transition-all">
                                        ➕ Novo Pedido
                                    </a>
                                </div>
                            @else
                                <div class="w-20 h-20 bg-secondary/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="h-10 w-10 text-secondary-dark" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-semibold text-text-dark mb-2">🛒 Nenhum pedido cadastrado</h3>
                                <p class="text-text-light mb-6">Comece criando seu primeiro pedido para gerenciar as vendas.</p>
                                <a href="{{ route('pedidos.create') }}"
                                   class="bg-secondary hover:bg-secondary-dark text-white font-semibold py-3 px-6 rounded-xl hover:opacity-90 transition-all duration-300 transform hover:scale-105">
                                    🚀 Criar Primeiro Pedido
                                </a>
                            @endif
                        </div>
                    @endif

                    <!-- Paginação -->
                    @if ($pedidos->hasPages())
                        <div class="mt-8 flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0">
                            <div class="text-sm text-text-light">
                                Mostrando <span class="font-semibold text-text-dark">{{ $pedidos->firstItem() }}</span> a 
                                <span class="font-semibold text-text-dark">{{ $pedidos->lastItem() }}</span> de 
                                <span class="font-semibold text-text-dark">{{ $pedidos->total() }}</span> resultados
                            </div>
                            <div>
                                {{ $pedidos->links() }}
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript para Ações dos Pedidos -->
    <script>
        function confirmarPedido(id) {
            if (confirm('Tem certeza que deseja confirmar este pedido?')) {
                fetch(`/pedidos/${id}/confirmar`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Erro ao confirmar pedido: ' + data.message);
                    }
                })
                .catch(error => {
                    alert('Erro ao confirmar pedido');
                });
            }
        }

        function entregarPedido(id) {
            if (confirm('Tem certeza que deseja marcar este pedido como entregue?')) {
                fetch(`/pedidos/${id}/entregar`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Erro ao entregar pedido: ' + data.message);
                    }
                })
                .catch(error => {
                    alert('Erro ao entregar pedido');
                });
            }
        }

        function cancelarPedido(id) {
            if (confirm('Tem certeza que deseja cancelar este pedido? Esta ação não pode ser desfeita.')) {
                fetch(`/pedidos/${id}/cancelar`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Erro ao cancelar pedido: ' + data.message);
                    }
                })
                .catch(error => {
                    alert('Erro ao cancelar pedido');
                });
            }
        }
    </script>
</x-app-layout>