<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-link/20 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-link" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-2xl text-text-dark leading-tight">
                        Detalhes do Cliente
                    </h2>
                    <p class="text-text-light text-sm">Informações completas do cliente</p>
                </div>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('clientes.edit', $cliente) }}"
                    class="bg-secondary hover:bg-secondary-dark text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                    </svg>
                    Editar
                </a>
                <a href="{{ route('clientes.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300 flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                    </svg>
                    Voltar
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Coluna Principal -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Card Principal do Cliente -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-primary/20">
                        <div class="p-8">
                            
                            <!-- Header do Cliente -->
                            <div class="flex items-center mb-8">
                                <div class="w-20 h-20 warm-gradient rounded-full flex items-center justify-center mr-6">
                                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-2xl font-bold text-text-dark mb-2">{{ $cliente->nome }}</h3>
                                    <div class="flex items-center space-x-4">
                                        <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $cliente->status == 'ativo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $cliente->status == 'ativo' ? '✅ Ativo' : '❌ Inativo' }}
                                        </span>
                                        <span class="text-sm text-text-light">
                                            Cliente desde {{ \Carbon\Carbon::parse($cliente->created_at)->format('d/m/Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Informações Pessoais -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-text-dark mb-1">📧 E-mail</label>
                                        <div class="bg-gray-50 rounded-lg p-3">
                                            <a href="mailto:{{ $cliente->email }}" class="text-link hover:text-primary-dark transition-colors">
                                                {{ $cliente->email }}
                                            </a>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-semibold text-text-dark mb-1">🆔 CPF</label>
                                        <div class="bg-gray-50 rounded-lg p-3">
                                            <span class="font-mono text-text-dark">{{ $cliente->cpf }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    @if($cliente->telefone)
                                    <div>
                                        <label class="block text-sm font-semibold text-text-dark mb-1">�� Telefone</label>
                                        <div class="bg-gray-50 rounded-lg p-3">
                                            <a href="tel:{{ $cliente->telefone }}" class="text-link hover:text-primary-dark transition-colors">
                                                {{ $cliente->telefone }}
                                            </a>
                                        </div>
                                    </div>
                                    @endif

                                    @if($cliente->data_nascimento)
                                    <div>
                                        <label class="block text-sm font-semibold text-text-dark mb-1">�� Data de Nascimento</label>
                                        <div class="bg-gray-50 rounded-lg p-3">
                                            <span class="text-text-dark">
                                                {{ \Carbon\Carbon::parse($cliente->data_nascimento)->format('d/m/Y') }}
                                                <span class="text-text-light text-sm">
                                                    ({{ \Carbon\Carbon::parse($cliente->data_nascimento)->age }} anos)
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                            </div>

                            <!-- Endereço -->
                            @if($cliente->endereco)
                            <div class="mt-6">
                                <label class="block text-sm font-semibold text-text-dark mb-2">🏠 Endereço</label>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <p class="text-text-dark">{{ $cliente->endereco }}</p>
                                </div>
                            </div>
                            @endif

                        </div>
                    </div>

                    <!-- Histórico de Pedidos -->
                    @if(isset($pedidos) && $pedidos->count() > 0)
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-secondary/20">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-6">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-secondary/20 rounded-xl flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-secondary-dark" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M7 4V2C7 1.45 7.45 1 8 1H16C16.55 1 17 1.45 17 2V4H20C20.55 4 21 4.45 21 5S20.55 6 20 6H19V19C19 20.1 18.1 21 17 21H7C5.9 21 5 20.1 5 19V6H4C3.45 6 3 5.55 3 5S3.45 4 4 4H7Z"/>
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-semibold text-text-dark">🛒 Histórico de Pedidos</h4>
                                </div>
                                <span class="text-sm text-text-light">{{ $pedidos->count() }} pedido(s)</span>
                            </div>
                            
                            <div class="space-y-4">
                                @foreach($pedidos->take(5) as $pedido)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-secondary/5 transition-colors">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-secondary/20 rounded-lg flex items-center justify-center mr-3">
                                            <span class="text-sm font-bold text-secondary-dark">#{{ $pedido->id }}</span>
                                        </div>
                                        <div>
                                            <div class="text-sm font-semibold text-text-dark">Pedido #{{ $pedido->id }}</div>
                                            <div class="text-xs text-text-light">{{ $pedido->created_at->format('d/m/Y H:i') }}</div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm font-bold text-secondary-dark">R\$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</div>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $pedido->status == 'entregue' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($pedido->status) }}
                                        </span>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            @if($pedidos->count() > 5)
                            <div class="mt-4 text-center">
                                <a href="{{ route('pedidos.index', ['cliente_id' => $cliente->id]) }}" 
                                   class="text-link hover:text-secondary-dark font-medium text-sm">
                                    Ver todos os pedidos deste cliente →
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    
                    <!-- Resumo do Cliente -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-link/20">
                        <div class="p-6">
                            <h4 class="text-lg font-semibold text-text-dark mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-link" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 17H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2zm2-7h-1V8c0-2.76-2.24-5-5-5S8 5.24 8 8v2H7c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V12c0-1.1-.9-2-2-2zm-8 0V8c0-1.66 1.34-3 3-3s3 1.34 3 3v2H10z"/>
                                </svg>
                                📊 Resumo
                            </h4>
                            
                            <div class="space-y-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-text-light">Status:</span>
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $cliente->status == 'ativo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $cliente->status == 'ativo' ? '✅ Ativo' : '❌ Inativo' }}
                                    </span>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-text-light">Cadastro:</span>
                                    <span class="text-sm font-medium text-text-dark">{{ \Carbon\Carbon::parse($cliente->created_at)->format('d/m/Y') }}</span>
                                </div>
                                
                                @if(isset($pedidos))
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-text-light">Total de Pedidos:</span>
                                    <span class="text-sm font-medium text-text-dark">{{ $pedidos->count() }}</span>
                                </div>
                                
                                @if($pedidos->count() > 0)
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-text-light">Valor Total:</span>
                                    <span class="text-sm font-bold text-secondary-dark">R\$ {{ number_format($pedidos->sum('valor_total'), 2, ',', '.') }}</span>
                                </div>
                                @endif
                                @endif
                                
                                <hr class="my-3">
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-text-light">Última Atualização:</span>
                                    <span class="text-xs text-text-light">{{ \Carbon\Carbon::parse($cliente->updated_at)->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ações Rápidas -->
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-primary/20">
                        <div class="p-6">
                            <h4 class="text-lg font-semibold text-text-dark mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-primary-dark" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M13,9H11V7H13M13,17H11V11H13M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"/>
                                </svg>
                                ⚡ Ações Rápidas
                            </h4>
                            
                            <div class="space-y-3">
                                <a href="{{ route('clientes.edit', $cliente) }}" 
                                   class="w-full bg-secondary hover:bg-secondary-dark text-white font-semibold py-3 px-4 rounded-xl block text-center transition-all duration-300">
                                    ✏️ Editar Cliente
                                </a>
                                
                                <a href="{{ route('pedidos.create', ['cliente_id' => $cliente->id]) }}" 
                                   class="w-full warm-gradient text-white font-semibold py-3 px-4 rounded-xl block text-center hover:opacity-90 transition-all duration-300">
                                    🛒 Novo Pedido
                                </a>
                                
                                <a href="{{ route('clientes.index') }}" 
                                   class="w-full bg-gray-500 hover:bg-gray-600 text-white font-semibold py-3 px-4 rounded-xl block text-center transition-all duration-300">
                                    📋 Lista de Clientes
                                </a>

                                @if($cliente->email)
                                <a href="mailto:{{ $cliente->email }}" 
                                   class="w-full bg-link hover:bg-blue-600 text-white font-semibold py-3 px-4 rounded-xl block text-center transition-all duration-300">
                                    📧 Enviar E-mail
                                </a>
                                @endif

                                @if($cliente->telefone)
                                <a href="tel:{{ $cliente->telefone }}" 
                                   class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3 px-4 rounded-xl block text-center transition-all duration-300">
                                    📱 Ligar
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>