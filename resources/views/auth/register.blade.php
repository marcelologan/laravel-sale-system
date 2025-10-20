<x-guest-layout>
    <!-- Hero Section -->
    <div class="text-center mb-8">
        <div class="inline-block p-4 warm-gradient rounded-full mb-4">
            <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 24 24">
                <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-text-dark mb-2">Criar Conta</h1>
        <p class="text-text-light">Junte-se ao Sistema Laravel</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Nome Completo" class="text-text-dark font-semibold" />
            <x-text-input id="name" 
                class="block mt-2 w-full border-gray-300 focus:border-primary focus:ring-primary rounded-lg" 
                type="text" 
                name="name" 
                :value="old('name')" 
                required 
                autofocus 
                autocomplete="name"
                placeholder="Seu nome completo" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="E-mail" class="text-text-dark font-semibold" />
            <x-text-input id="email" 
                class="block mt-2 w-full border-gray-300 focus:border-primary focus:ring-primary rounded-lg" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
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
                autocomplete="new-password"
                placeholder="Mínimo 8 caracteres" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" value="Confirmar Senha" class="text-text-dark font-semibold" />
            <x-text-input id="password_confirmation" 
                class="block mt-2 w-full border-gray-300 focus:border-primary focus:ring-primary rounded-lg"
                type="password"
                name="password_confirmation" 
                required 
                autocomplete="new-password"
                placeholder="Digite a senha novamente" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Actions -->
        <div class="space-y-4">
            <button type="submit" 
                class="w-full warm-gradient text-white font-semibold py-3 px-4 rounded-lg hover:opacity-90 transition-all duration-300 transform hover:scale-105">
                ✨ Criar Minha Conta
            </button>

            <div class="text-center pt-4 border-t border-gray-200">
                <p class="text-text-light text-sm mb-2">Já tem uma conta?</p>
                <a href="{{ route('login') }}" 
                   class="text-link hover:text-primary-dark font-semibold transition-colors">
                    Fazer login
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>