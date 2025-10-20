<x-guest-layout>
    <!-- Hero Section -->
    <div class="text-center mb-8">
        <div class="inline-block p-4 warm-gradient rounded-full mb-4">
            <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-text-dark mb-2">Bem-vindo de volta!</h1>
        <p class="text-text-light">Acesse seu sistema Laravel</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="E-mail" class="text-text-dark font-semibold" />
            <x-text-input id="email" 
                class="block mt-2 w-full border-gray-300 focus:border-primary focus:ring-primary rounded-lg" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                autocomplete="username"
                placeholder="seu@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Senha" class="text-text-dark font-semibold" />
            <x-text-input id="password" 
                class="block mt-2 w-full border-gray-300 focus:border-primary focus:ring-primary rounded-lg"
                type="password"
                name="password"
                required 
                autocomplete="current-password"
                placeholder="Sua senha" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" 
                type="checkbox" 
                class="rounded border-gray-300 text-primary shadow-sm focus:ring-primary" 
                name="remember">
            <label for="remember_me" class="ml-2 text-sm text-text-light">
                Lembrar de mim
            </label>
        </div>

        <!-- Actions -->
        <div class="space-y-4">
            <button type="submit" 
                class="w-full warm-gradient text-white font-semibold py-3 px-4 rounded-lg hover:opacity-90 transition-all duration-300 transform hover:scale-105">
                🚀 Entrar no Sistema
            </button>

            @if (Route::has('password.request'))
                <div class="text-center">
                    <a class="text-link hover:text-primary-dark font-medium transition-colors" 
                       href="{{ route('password.request') }}">
                        Esqueceu sua senha?
                    </a>
                </div>
            @endif

            @if (Route::has('register'))
                <div class="text-center pt-4 border-t border-gray-200">
                    <p class="text-text-light text-sm mb-2">Ainda não tem uma conta?</p>
                    <a href="{{ route('register') }}" 
                       class="text-link hover:text-primary-dark font-semibold transition-colors">
                        Criar conta gratuita
                    </a>
                </div>
            @endif
        </div>
    </form>
</x-guest-layout>