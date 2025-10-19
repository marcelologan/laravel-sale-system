<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pedidos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Alertas de Feedback -->
            @if (session('success'))
                <div class="mb-6">
                    <x-alert type="success">
                        {{ session('success') }}
                    </x-alert>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6">
                    <x-alert type="error">
                        {{ session('error') }}
                    </x-alert>
                </div>
            @endif

            <!-- Card de Filtros -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h4 class="text-lg font-medium text-gray-900 mb-4">🔍 Filtros de Busca</h4>

                    <form method="GET" action="{{ route('pedidos.index') }}" class="space-y-4">

                        <!-- Primeira linha de filtros -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                            <!-- Busca -->
                            <div>
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                                    Buscar Pedido
                                </label>
                                <input type="text" name="search" id="search" value="{{ request('search') }}"
                                    placeholder="Número do pedido ou nome do cliente..."
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Cliente -->
                            <div>
                                <label for="cliente_id" class="block text-sm font-medium text-gray-700 mb-1">
                                    Cliente
                                </label>
                                <select name="cliente_id" id="cliente_id"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Todos os clientes</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}"
                                            {{ request('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                            {{ $cliente->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                                    Status
                                </label>
                                <select name="status" id="status"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">Todos</option>
                                    <option value="pendente" {{ request('status') == 'pendente' ? 'selected' : '' }}>
                                        Pendente</option>
                                    <option value="confirmado"
                                        {{ request('status') == 'confirmado' ? 'selected' : '' }}>Confirmado</option>
                                    <option value="entregue" {{ request('status') == 'entregue' ? 'selected' : '' }}>
                                        Entregue</option>
                                    <option value="cancelado" {{ request('status') == 'cancelado' ? 'selected' : '' }}>
                                        Cancelado</option>
                                </select>
                            </div>

                        </div>

                        <!-- Segunda linha de filtros -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                            <!-- Data Início -->
                            <div>
                                <label for="data_inicio" class="block text-sm font-medium text-gray-700 mb-1">
                                    Data Início
                                </label>
                                <input type="date" name="data_inicio" id="data_inicio"
                                    value="{{ request('data_inicio') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Data Fim -->
                            <div>
                                <label for="data_fim" class="block text-sm font-medium text-gray-700 mb-1">
                                    Data Fim
                                </label>
                                <input type="date" name="data_fim" id="data_fim" value="{{ request('data_fim') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Valor Mínimo -->
                            <div>
                                <label for="valor_min" class="block text-sm font-medium text-gray-700 mb-1">
                                    Valor Mínimo (R$)
                                </label>
                                <input type="number" name="valor_min" id="valor_min"
                                    value="{{ request('valor_min') }}" step="0.01" min="0" placeholder="0,00"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Ordenação -->
                            <div>
                                <label for="sort_by" class="block text-sm font-medium text-gray-700 mb-1">
                                    Ordenar por
                                </label>
                                <select name="sort_by" id="sort_by"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="data_pedido"
                                        {{ request('sort_by', 'data_pedido') == 'data_pedido' ? 'selected' : '' }}>Data
                                        do Pedido</option>
                                    <option value="id" {{ request('sort_by') == 'id' ? 'selected' : '' }}>Número
                                    </option>
                                    <option value="valor_total"
                                        {{ request('sort_by') == 'valor_total' ? 'selected' : '' }}>Valor Total
                                    </option>
                                    <option value="status" {{ request('sort_by') == 'status' ? 'selected' : '' }}>
                                        Status</option>
                                </select>
                            </div>

                        </div>

                        <!-- Botões -->
                        <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                            <div class="flex space-x-2">
                                <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    🔍 Filtrar
                                </button>
                                <a href="{{ route('pedidos.index') }}"
                                    class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                    🔄 Limpar
                                </a>
                            </div>

                            <!-- Direção da ordenação -->
                            <div class="flex items-center space-x-2">
                                <label class="text-sm text-gray-700">Ordem:</label>
                                <select name="sort_direction"
                                    class="px-2 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="desc"
                                        {{ request('sort_direction', 'desc') == 'desc' ? 'selected' : '' }}>↓ Mais
                                        recente</option>
                                    <option value="asc" {{ request('sort_direction') == 'asc' ? 'selected' : '' }}>↑
                                        Mais antigo</option>
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
                            <h3 class="text-lg font-medium">Lista de Pedidos</h3>
                            <p class="text-sm text-gray-500 mt-1">
                                {{ $pedidos->total() }} pedido(s) encontrado(s)
                                @if (request()->hasAny(['search', 'cliente_id', 'status', 'data_inicio', 'data_fim', 'valor_min']))
                                    <span class="text-blue-600">(filtrado)</span>
                                @endif
                            </p>
                        </div>
                        <a href="{{ route('pedidos.create') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            📋 Novo Pedido
                        </a>
                    </div>

                    <!-- Tabela -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'id', 'sort_direction' => request('sort_by') == 'id' && request('sort_direction', 'desc') == 'desc' ? 'asc' : 'desc']) }}"
                                            class="flex items-center hover:text-gray-700">
                                            Pedido
                                            @if (request('sort_by') == 'id')
                                                <span class="ml-1">
                                                    @if (request('sort_direction', 'desc') == 'desc')
                                                        ↓
                                                    @else
                                                        ↑
                                                    @endif
                                                </span>
                                            @endif
                                        </a>
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Cliente
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'data_pedido', 'sort_direction' => request('sort_by', 'data_pedido') == 'data_pedido' && request('sort_direction', 'desc') == 'desc' ? 'asc' : 'desc']) }}"
                                            class="flex items-center hover:text-gray-700">
                                            Data
                                            @if (request('sort_by', 'data_pedido') == 'data_pedido')
                                                <span class="ml-1">
                                                    @if (request('sort_direction', 'desc') == 'desc')
                                                        ↓
                                                    @else
                                                        ↑
                                                    @endif
                                                </span>
                                            @endif
                                        </a>
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'valor_total', 'sort_direction' => request('sort_by') == 'valor_total' && request('sort_direction', 'desc') == 'desc' ? 'asc' : 'desc']) }}"
                                            class="flex items-center hover:text-gray-700">
                                            Valor Total
                                            @if (request('sort_by') == 'valor_total')
                                                <span class="ml-1">
                                                    @if (request('sort_direction', 'desc') == 'desc')
                                                        ↓
                                                    @else
                                                        ↑
                                                    @endif
                                                </span>
                                            @endif
                                        </a>
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Itens
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Ações
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($pedidos as $pedido)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">#{{ $pedido->id }}</div>
                                            <div class="text-sm text-gray-500">{{ $pedido->data_pedido_formatada }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $pedido->cliente->nome }}</div>
                                            @if ($pedido->cliente->telefone)
                                                <div class="text-sm text-gray-500">{{ $pedido->cliente->telefone }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $pedido->data_pedido_formatada }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $pedido->created_at->diffForHumans() }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-semibold text-gray-900">
                                                {{ $pedido->valor_total_formatado }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $pedido->status_cor }}">
                                                {{ ucfirst($pedido->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">{{ $pedido->itens->count() }} item(ns)
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $pedido->itens->sum('quantidade') }} unidade(s)
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-2">
                                                <!-- Ver -->
                                                <a href="{{ route('pedidos.show', $pedido) }}"
                                                    class="text-blue-600 hover:text-blue-900 inline-flex items-center"
                                                    title="Ver detalhes">
                                                    👁️
                                                </a>

                                                <!-- Editar (apenas se pendente) -->
                                                @if ($pedido->podeSerEditado())
                                                    <a href="{{ route('pedidos.edit', $pedido) }}"
                                                        class="text-yellow-600 hover:text-yellow-900 inline-flex items-center"
                                                        title="Editar pedido">
                                                        ✏️
                                                    </a>
                                                @endif

                                                <!-- Confirmar (apenas se pendente) -->
                                                @if ($pedido->status === 'pendente')
                                                    <button onclick="confirmarPedido({{ $pedido->id }})"
                                                        class="text-green-600 hover:text-green-900 inline-flex items-center"
                                                        title="Confirmar pedido">
                                                        ✅
                                                    </button>
                                                @endif

                                                <!-- Entregar (apenas se confirmado) -->
                                                @if ($pedido->status === 'confirmado')
                                                    <button onclick="entregarPedido({{ $pedido->id }})"
                                                        class="text-purple-600 hover:text-purple-900 inline-flex items-center"
                                                        title="Marcar como entregue">
                                                        🚚
                                                    </button>
                                                @endif

                                                <!-- Cancelar (se pode ser cancelado) -->
                                                @if ($pedido->podeSerCancelado())
                                                    <button onclick="cancelarPedido({{ $pedido->id }})"
                                                        class="text-red-600 hover:text-red-900 inline-flex items-center"
                                                        title="Cancelar pedido">
                                                        ❌
                                                    </button>
                                                @endif

                                                <!-- Imprimir -->
                                                <a href="{{ route('pedidos.show', $pedido) }}"
                                                    onclick="setTimeout(() => window.print(), 500)"
                                                    class="text-gray-600 hover:text-gray-900 inline-flex items-center"
                                                    title="Imprimir">
                                                    🖨️
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                @if (request()->hasAny(['search', 'cliente_id', 'status', 'data_inicio', 'data_fim', 'valor_min']))
                                                    <svg class="h-12 w-12 text-gray-400 mb-4" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                                    </svg>
                                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Nenhum pedido
                                                        encontrado</h3>
                                                    <p class="text-gray-500 mb-4">Tente ajustar os filtros de busca.
                                                    </p>
                                                    <a href="{{ route('pedidos.index') }}"
                                                        class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                                        🔄 Limpar Filtros
                                                    </a>
                                                @else
                                                    <svg class="h-12 w-12 text-gray-400 mb-4" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    <h3 class="text-lg font-medium text-gray-900 mb-2">Nenhum pedido
                                                        cadastrado</h3>
                                                    <p class="text-gray-500 mb-4">Comece criando seu primeiro pedido.
                                                    </p>
                                                    <a href="{{ route('pedidos.create') }}"
                                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                        📋 Criar Primeiro Pedido
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
                    @if ($pedidos->hasPages())
                        <div class="mt-6 flex items-center justify-between">
                            <div class="text-sm text-gray-700">
                                Mostrando {{ $pedidos->firstItem() }} a {{ $pedidos->lastItem() }}
                                de {{ $pedidos->total() }} resultados
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

    @push('scripts')
        @vite(['resources/js/pedidos-index.js'])
    @endpush
</x-app-layout>
