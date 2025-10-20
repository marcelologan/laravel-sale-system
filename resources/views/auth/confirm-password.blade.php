<x-guest-layout>
    <!-- Hero Section -->
    <div class="text-center mb-8">
        <div class="inline-block p-4 bg-secondary/20 rounded-full mb-4">
            <svg class="w-12 h-12 text-secondary-dark" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12,17A2,2 0 0,0 14,15C14,13.89 13.1,13 12,13A2,2 0 0,0 10,15A2,2 0 0,0 12,17M18,8A2,2 0 0,1 20,10V20A2,2 0 0,1 18,22H6A2,2 0 0,1 4,20V10C4,8.89 4.9,8 6,8H7V6A5,5 0 0,1 12,1A5,5 0 0,1 17,6V8H18M12,3A3,3 0 0,0 9,6V8H15V6A3,3 0 0,0 12,3Z"/>
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-text-dark mb-2">Área Segura</h1>
        <p class="text-text-light">Confirme sua senha para continuar</p>
    </div>

    <div class="mb-6 p-4 bg-secondary/10 border border-secondary/30 rounded-lg">
        <p class="text-sm text-secondary-dark">
            <strong>🔒 Área protegida:</strong> Por segurança, confirme sua senha antes de prosseguir.
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Senha Atual" class="text-text-dark font-semibold" />
            <x-text-input id="password" 
                class="block mt-2 w-full border-gray-300 focus:border-secondary focus:ring-secondary rounded-lg"
                type="password"
                name="password"
                required 
                autocomplete="current-password"
                placeholder="Digite sua senha atual" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Actions -->
        <div class="space-y-4">
            <button type="submit" 
                class="w-full bg-secondary hover:bg-secondary-dark text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 transform hover:scale-105">
                �� Confirmar e Continuar
            </button>
        </div>
    </form>
</x-guest-layout><x-guest-layout>
    <!-- Hero Section -->
    <div class="text-center mb-8">
        <div class="inline-block p-4 bg-blue-100 rounded-full mb-4">
            <svg class="w-12 h-12 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20,8L12,13L4,8V6L12,11L20,6M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z"/>
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-text-dark mb-2">Verificar E-mail</h1>
        <p class="text-text-light">Quase lá! Verifique seu e-mail</p>
    </div>

    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
        <p class="text-sm text-blue-800">
            <strong>📧 Obrigado por se cadastrar!</strong> Antes de começar, verifique seu e-mail clicando no link que enviamos. Não recebeu? Podemos enviar outro!
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
            <p class="text-sm text-green-800">
                <strong>✅ E-mail enviado!</strong> Um novo link de verificação foi enviado para o endereço fornecido no cadastro.
            </p>
        </div>
    @endif

    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" 
                class="w-full bg-link hover:bg-blue-600 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 transform hover:scale-105">
                📨 Reenviar E-mail de Verificação
            </button>
        </form>

        <div class="text-center pt-4 border-t border-gray-200">
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" 
                    class="text-text-light hover:text-text-dark font-medium transition-colors">
                    Sair da conta
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>