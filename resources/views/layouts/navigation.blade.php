<nav x-data="{ open: false }" class="bg-white shadow-lg border-b-4 border-primary">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                        <div class="w-10 h-10 warm-gradient rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-text-dark">Sistema Laravel</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="inline-flex items-center px-4 py-2 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none
                        {{ request()->routeIs('dashboard') 
                            ? 'border-primary text-primary-dark bg-primary/10' 
                            : 'border-transparent text-text-light hover:text-text-dark hover:border-primary/50 hover:bg-primary/5' }}">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
                        </svg>
                        Dashboard
                    </x-nav-link>

                    <x-nav-link :href="route('clientes.index')" :active="request()->routeIs('clientes.*')"
                        class="inline-flex items-center px-4 py-2 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none
                        {{ request()->routeIs('clientes.*') 
                            ? 'border-primary text-primary-dark bg-primary/10' 
                            : 'border-transparent text-text-light hover:text-text-dark hover:border-primary/50 hover:bg-primary/5' }}">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Clientes
                    </x-nav-link>

                    <x-nav-link :href="route('produtos.index')" :active="request()->routeIs('produtos.*')"
                        class="inline-flex items-center px-4 py-2 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none
                        {{ request()->routeIs('produtos.*') 
                            ? 'border-primary text-primary-dark bg-primary/10' 
                            : 'border-transparent text-text-light hover:text-text-dark hover:border-primary/50 hover:bg-primary/5' }}">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 7h-3V6a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v1H0v2h3v9a4 4 0 0 0 4 4h10a4 4 0 0 0 4-4V9h3V7z"/>
                        </svg>
                        Produtos
                    </x-nav-link>

                    <x-nav-link :href="route('categorias.index')" :active="request()->routeIs('categorias.*')"
                        class="inline-flex items-center px-4 py-2 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none
                        {{ request()->routeIs('categorias.*') 
                            ? 'border-secondary text-secondary-dark bg-secondary/10' 
                            : 'border-transparent text-text-light hover:text-text-dark hover:border-secondary/50 hover:bg-secondary/5' }}">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                        </svg>
                        Categorias
                    </x-nav-link>

                    <x-nav-link :href="route('pedidos.index')" :active="request()->routeIs('pedidos.*')"
                        class="inline-flex items-center px-4 py-2 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none
                        {{ request()->routeIs('pedidos.*') 
                            ? 'border-secondary text-secondary-dark bg-secondary/10' 
                            : 'border-transparent text-text-light hover:text-text-dark hover:border-secondary/50 hover:bg-secondary/5' }}">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M7 4V2C7 1.45 7.45 1 8 1H16C16.55 1 17 1.45 17 2V4H20C20.55 4 21 4.45 21 5S20.55 6 20 6H19V19C19 20.1 18.1 21 17 21H7C5.9 21 5 20.1 5 19V6H4C3.45 6 3 5.55 3 5S3.45 4 4 4H7Z"/>
                        </svg>
                        Pedidos
                        <span class="ml-1 bg-secondary text-white text-xs px-2 py-1 rounded-full">★</span>
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-text-light bg-white hover:text-text-dark hover:bg-primary/5 focus:outline-none transition ease-in-out duration-150">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-primary/20 rounded-full flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4 text-primary-dark" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                            </div>

                            <div class="ms-2">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            👤 Meu Perfil
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                🚪 Sair
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-text-light hover:text-text-dark hover:bg-primary/10 focus:outline-none focus:bg-primary/10 focus:text-text-dark transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1 bg-primary/5">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                📊 Dashboard
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('clientes.index')" :active="request()->routeIs('clientes.*')">
                👥 Clientes
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('produtos.index')" :active="request()->routeIs('produtos.*')">
                📦 Produtos
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('categorias.index')" :active="request()->routeIs('categorias.*')">
                🏷️ Categorias
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pedidos.index')" :active="request()->routeIs('pedidos.*')">
                🛒 Pedidos ⭐
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-primary/20 bg-white">
            <div class="px-4">
                <div class="font-medium text-base text-text-dark">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-text-light">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    �� Meu Perfil
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        🚪 Sair
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>