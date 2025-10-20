<x-guest-layout>
    <!-- Hero Section -->
    <div class="text-center mb-8">
        <div class="inline-block p-4 bg-link/20 rounded-full mb-4">
            <svg class="w-12 h-12 text-link" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-text-dark mb-2">Recuperar Senha</h1>
        <p class="text-text-light">Vamos te ajudar a recuperar o acesso</p>
    </div>

    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
        <p class="text-sm text-blue-800">
            <strong>Esqueceu sua senha?</strong> Sem problemas! Digite seu e-mail abaixo e enviaremos um link para redefinir sua senha.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="E-mail" class="text-text-dark font-semibold" />
            <x-text-input id="email" 
                class="block mt-2 w-full border-gray-300 focus:border-link focus:ring-link rounded-lg" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus
                placeholder="Digite seu e-mail cadastrado" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Actions -->
        <div class="space-y-4">
            <button type="submit" 
                class="w-full bg-link hover:bg-blue-600 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 transform hover:scale-105">
                📧 Enviar Link de Recuperação
            </button>

            <div class="text-center pt-4 border-t border-gray-200">
                <a href="{{ route('login') }}" 
                   class="text-text-light hover:text-text-dark font-medium transition-colors">
                    ← Voltar para o login
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>