<x-guest-layout>
    <!-- Hero Section -->
    <div class="text-center mb-8">
        <div class="inline-block p-4 bg-green-100 rounded-full mb-4">
            <svg class="w-12 h-12 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12 1L3 5V11C3 16.55 6.84 21.74 12 23C17.16 21.74 21 16.55 21 11V5L12 1M10 17L6 13L7.41 11.59L10 14.17L16.59 7.58L18 9L10 17Z"/>
            </svg>
        </div>
        <h1 class="text-3xl font-bold text-text-dark mb-2">Nova Senha</h1>
        <p class="text-text-light">Defina sua nova senha de acesso</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" value="E-mail" class="text-text-dark font-semibold" />
            <x-text-input id="email" 
                class="block mt-2 w-full border-gray-300 focus:border-primary focus:ring-primary rounded-lg bg-gray-50" 
                type="email" 
                name="email" 
                :value="old('email', $request->email)" 
                required 
                autofocus 
                autocomplete="username"
                readonly />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Nova Senha" class="text-text-dark font-semibold" />
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
            <x-input-label for="password_confirmation" value="Confirmar Nova Senha" class="text-text-dark font-semibold" />
            <x-text-input id="password_confirmation" 
                class="block mt-2 w-full border-gray-300 focus:border-primary focus:ring-primary rounded-lg"
                type="password"
                name="password_confirmation" 
                required 
                autocomplete="new-password"
                placeholder="Digite a nova senha novamente" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Actions -->
        <div class="space-y-4">
            <button type="submit" 
                class="w-full warm-gradient text-white font-semibold py-3 px-4 rounded-lg hover:opacity-90 transition-all duration-300 transform hover:scale-105">
                🔐 Redefinir Senha
            </button>
        </div>
    </form>
</x-guest-layout>