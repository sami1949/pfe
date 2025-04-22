<nav class="bg-white shadow-sm" x-data="{ isOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/logo.png') }}" 
                            alt="Logo Sublimax" 
                            class="h-12 w-auto">
                </a>
            </div>

            <!-- Liens desktop -->
            <div class="hidden md:flex space-x-8">
                <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')" class="text-gray-600 hover:text-gray-900">
                    {{ __('Accueil') }}
                </x-nav-link>
                <x-nav-link href="#" class="text-gray-600 hover:text-gray-900">
                    {{ __('Services') }}
                </x-nav-link>
                <x-nav-link href="#" class="text-gray-600 hover:text-gray-900">
                    {{ __('Gallerie') }}
                </x-nav-link>
                <x-nav-link href="{{ route('products.index') }}" :active="request()->routeIs('products.index')" class="text-gray-600 hover:text-gray-900 font-semibold">
                    {{ __('Produits') }}
                </x-nav-link>
                <x-nav-link href="#" class="text-gray-600 hover:text-gray-900">
                    {{ __('Contacts') }}
                </x-nav-link>
            </div>

            <!-- Boutons droite desktop -->
            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-gray-900">
                            {{ __('Déconnexion') }}
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900">
                        {{ __('Se connecter') }}
                    </a>
                    <a href="{{ route('register') }}" class="ml-4 bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                        {{ __('S\'inscrire') }}
                    </a>
                @endauth
            </div>

            <!-- Bouton menu mobile -->
            <div class="md:hidden flex items-center">
                <button @click="isOpen = !isOpen" 
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-900 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': isOpen, 'inline-flex': !isOpen}" 
                                stroke-linecap="round" 
                                stroke-linejoin="round" 
                                stroke-width="2" 
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !isOpen, 'inline-flex': isOpen}" 
                                stroke-linecap="round" 
                                stroke-linejoin="round" 
                                stroke-width="2" 
                                d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Menu mobile -->
        <div class="md:hidden" x-show="isOpen" x-cloak @click.away="isOpen = false">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-white shadow-lg">
                <x-responsive-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
                    {{ __('Accueil') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="#">
                    {{ __('Services') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="#">
                    {{ __('Gallerie') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="{{ route('products.index') }}" :active="request()->routeIs('products.index')">
                    {{ __('Produits') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link href="#">
                    {{ __('Contacts') }}
                </x-responsive-nav-link>

                <!-- Authentification mobile -->
                <div class="border-t pt-4 mt-4 space-y-2">
                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full px-3 py-2 text-left text-gray-600 hover:text-gray-900">
                                {{ __('Déconnexion') }}
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block px-3 py-2 text-gray-600 hover:text-gray-900">
                            {{ __('Se connecter') }}
                        </a>
                        <a href="{{ route('register') }}" class="block px-3 py-2 text-white bg-gray-800 rounded-md hover:bg-gray-700">
                            {{ __('S\'inscrire') }}
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>