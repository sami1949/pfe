<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Élégancelle</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        /* Base styles */
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }
        
        /* Navbar styles */
        nav {
            background-color: transparent;
            position: absolute;
            width: 100%;
            z-index: 50;
            transition: all 0.3s ease;
            align-items: center;
        }
        
        nav.scrolled {
            background-color: #f8e8e8;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: fixed;
            height: 90px;
            padding: 5px 0;
        }
        
        /* Navbar link colors */
        .nav-link {
            color: #f8e8e8 !important;
            transition: color 0.3s ease;
        }
        
        .nav-link:hover {
            color: rgba(255, 255, 255, 0.57) !important;
        }

        nav.scrolled .nav-link {
            color: #333 !important;
        }
        
        nav.scrolled .nav-link:hover {
            color: #000 !important;
        }
        
        nav .flex-shrink-0.group {
            margin-top: 0;
            transition: all 0.3s ease;
        }

        nav.scrolled .flex-shrink-0.group {
            transform: scale(0.9);
        }
        
        /* Logo styles */
        .logo-text {
            transition: 0.3s ease;
            font-size: 1.1rem;
            color: #f8e8e8;
        }
        
        .logo-img {
            transition: all 0.3s ease;
            height: 60px;
            width: 60px;
        }
        
        nav.scrolled .logo-img {
            height: 50px;
            width: 50px;
        }

        nav.scrolled .logo-text {
            font-size: 1rem !important;
            color: black;
        }
        
        .underline-animation {
            background-color: #f8e8e8;
            transition: all 0.4s ease-in-out;
        }

        nav.scrolled .underline-animation {
            background-color: black !important;
        }

        .group:hover .underline-animation {
            width: 100%;
        }

        nav > div > div {
            height: 100%;
            align-items: center;
        }
        
        /* Button styles */
        .btn-dex {
            background: transparent;
            border: none;
            cursor: pointer;
            color: white !important;
            transition: color 0.3s ease;
        }
        
        nav.scrolled .btn-dex {
            color: #333 !important;
        }
        
        .btn-dex:hover {
            opacity: 0.8;
        }
        
        /* Hero section */
        .hero {
            height: 100vh;
            width: 100%;
            position: relative;
            background-image: url("/images/image.png");            
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: space-around;
            text-align: start;
            color: white;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.3);
        }
        
        .hero-content {
            position: relative;
            z-index: 10;
            max-width: 800px;
            padding: 0 20px;
        }
        
        .hero h2 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1px;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
            font-family: 'Playfair Display';
        }
        
        .hero p {
            font-size: 1.25rem;
            margin-bottom: 25px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
            font-family: 'Playfair Display';
        }
        
        .hero {
    position: relative;
    height: 100vh;
    width: 100%;
    overflow: hidden;
}

.hero video {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    min-width: 100%;
    min-height: 100%;
    z-index: 0;
}

.hero-content {
    position: relative;
    z-index: 10;
}

        .shop-now-btn {
            background-color: white;
            color: #333;
            padding: 12px 30px;
            border-radius: 4px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .shop-now-btn:hover {
            background-color: #f8f8f8;
            transform: translateY(-2px);
        }
        
        /* Content styles */
        .content {
            padding-top: 100vh;
        }
        
        /* Transitions */
        nav {
            transition: all 0.4s ease-out;
        }

        nav * {
            transition: all 0.3s ease;
        }
        
        /* Mobile styles */
        @media (max-width: 767px) {
            .mobile-menu {
                background-color: white !important;
            }
            
            .responsive-nav-link {
                color: black !important;
            }
            
            .hero h2 {
                font-size: 2rem !important;
                line-height: 1.2;
                padding: 0 15px;
            }
            
            .hero p {
                font-size: 1rem !important;
                padding: 0 15px;
            }
            
            .hero-content {
                width: 100%;
                padding: 0 10px;
            }
            
            .shop-now-btn {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
            
            .logo-text {
                font-size: 0.9rem !important;
            }
            
            .logo-img {
                height: 3rem !important;
                width: 3rem !important;
            }
        }

        nav.scrolled .scrolled\:text-black {
    color: black !important;
}

        /* For the button text */
nav.scrolled .nav-button {
    color: black !important;
}

/* For the SVG icon */
nav.scrolled .nav-button svg {
    stroke: black !important;
}

/* Hover state */
nav.scrolled .nav-button:hover {
    color: #333 !important;
}

nav.scrolled .nav-button:hover svg {
    stroke: #333 !important;
}

.products-dropdown {
            position: relative;
        }
        
        .products-dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #f8e8e8;
            min-width: 200px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.1);
            z-index: 100;
            border-radius: 4px;
            overflow: hidden;
        }
        
        nav.scrolled .products-dropdown-content {
            background-color: white;
        }
        
        .products-dropdown:hover .products-dropdown-content {
            display: block;
        }
        
        .products-dropdown-link {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            transition: all 0.3s ease;
        }
        
        .products-dropdown-link:hover {
            background-color: #f0f0f0;
            padding-left: 20px;
        }
        
        /* Update the nav-link styles to accommodate dropdown */
        .nav-link {
            position: relative;
            display: inline-block;
        }

        /* For mobile dropdown */
.mobile-products-dropdown {
    position: relative;
    display: block;
}

.mobile-products-dropdown-content {
    display: none;
    padding-left: 1rem;
}

.mobile-products-dropdown:hover .mobile-products-dropdown-content,
.mobile-products-dropdown:focus-within .mobile-products-dropdown-content {
    display: block;
}

/* Style for mobile nav links */
.mobile-products-dropdown .responsive-nav-link {
    display: block;
    padding: 0.5rem 1rem;
    color: inherit;
    text-decoration: none;
}

.mobile-products-dropdown .responsive-nav-link:hover {
    background-color: rgba(0, 0, 0, 0.05);
}
/* When nav is not scrolled */
.nav-scrolled\:text-black {
    transition: color 0.3s ease;
}

/* When nav has 'scrolled' class */
nav.scrolled .nav-scrolled\:text-black {
    color: #000 !important;
}
        /* Utility classes */
        [x-cloak] { display: none !important; }
    </style>
</head>
<body>
    <div class="relative">
        <!-- Navigation -->
        <nav class="" x-data="{ isOpen: false, logoVisible: true }" id="mainNav">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex-shrink-0 group logoImgTxt" style="margin-top: 30px;">
                    @auth
                        <a href="{{ route('welcome') }}" 
                        x-show="logoVisible" 
                        x-transition
                        class="flex flex-col items-center no-underline">
                            <div class="relative mb-1">
                                <div class="absolute inset-0 rounded-full bg-purple-100 blur-md opacity-0 group-hover:opacity-70 transition-all duration-500 -z-10"></div>
                                <img src="{{ asset('images/logo.png') }}" 
                                    alt="EleganceVibe Logo" 
                                    class="logo-img h-16 w-16 rounded-full object-cover border-2 border-white shadow-lg transition-all duration-500 ease-out group-hover:scale-110 group-hover:rotate-3">
                            </div>
                            <span class="relative overflow-hidden -mt-1">
                                <span class="text-xl tracking-wider logo-text" style="font-family: 'Kaushan Script';">
                                    EleganceVibe
                                    <span class="absolute lkhat bottom-0 left-0 h-0.5 w-0 group-hover:w-full transition-all duration-700 ease-in-out underline-animation"></span>
                                </span>
                            </span>
                        </a>
                        @else
                        <a href="{{ route('welcomeWithoutLogin') }}" 
                        x-show="logoVisible" 
                        x-transition
                        class="flex flex-col items-center no-underline">
                            <div class="relative mb-1">
                                <div class="absolute inset-0 rounded-full bg-purple-100 blur-md opacity-0 group-hover:opacity-70 transition-all duration-500 -z-10"></div>
                                <img src="{{ asset('images/logo.png') }}" 
                                    alt="EleganceVibe Logo" 
                                    class="logo-img h-16 w-16 rounded-full object-cover border-2 border-white shadow-lg transition-all duration-500 ease-out group-hover:scale-110 group-hover:rotate-3">
                            </div>
                            <span class="relative overflow-hidden -mt-1">
                                <span class="text-xl tracking-wider logo-text" style="font-family: 'Kaushan Script';">
                                    EleganceVibe
                                    <span class="absolute lkhat bottom-0 left-0 h-0.5 w-0 group-hover:w-full transition-all duration-700 ease-in-out underline-animation"></span>
                                </span>
                            </span>
                        </a>
                        @endauth

                    </div>

                    <!-- Desktop Links -->
                    <div class="hidden md:flex space-x-8">
                    @auth
    <x-nav-link href="{{ route('welcome') }}"  
                :active="request()->routeIs('welcome')" 
                class="nav-link font-semibold">
        {{ __('Accueil') }}
    </x-nav-link>
@else
    <x-nav-link href="{{ route('welcomeWithoutLogin') }}" 
                :active="request()->routeIs('welcomeWithoutLogin')" 
                class="nav-link font-semibold">
        {{ __('Accueil') }}
    </x-nav-link>
@endauth
                        <x-nav-link href="{{ route('serviceClient') }}" 
                            :active="request()->routeIs('serviceClient')" 
                            class="nav-link font-semibold">
                            {{ __('Services') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('galleryClient') }}" 
                            :active="request()->routeIs('galleryClient')" 
                            class="nav-link font-semibold">
                            {{ __('Gallerie') }}
                        </x-nav-link>
                        
                        <div class="products-dropdown">
    @auth
        <x-nav-link 
            href="{{ route('product.private') }}" 
            :active="request()->routeIs('product.private')" 
            class="nav-link font-semibold">  
            {{ __("Produits") }}
        </x-nav-link>
    @else
        <x-nav-link 
            href="{{ route('product.public') }}" 
            :active="request()->routeIs('product.public')" 
            class="nav-link font-semibold">  
            {{ __("Produits") }}
        </x-nav-link>
    @endauth
    <div class="products-dropdown-content">
        @auth
            <a href="{{ route('product.private', ['category' => 'homme']) }}" class="products-dropdown-link">
        @else
            <a href="{{ route('product.public', ['category' => 'homme']) }}" class="products-dropdown-link">
        @endauth
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Pour Hommes
            </div>
        </a>
        
        @auth
            <a href="{{ route('product.private', ['category' => 'femme']) }}" class="products-dropdown-link">
        @else
            <a href="{{ route('product.public', ['category' => 'femme']) }}" class="products-dropdown-link">
        @endauth
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Pour Femmes
            </div>
        </a>
    </div>
</div>

                        <x-nav-link href="{{ route('contactClient') }}" 
                            :active="request()->routeIs('contactClient')" 
                            class="nav-link font-semibold">
                            {{ __('Contacts') }}
                        </x-nav-link>
                    </div>

                    <!-- Desktop Buttons -->
                    <div class="hidden md:flex items-center space-x-4">
                        <!-- Cart Icon -->
                        <div id="cart-icon" class="relative">
                        @auth
                        <a href="{{ route('cart') }}" class="text-[#f8e8e8] hover:text-teal-600 transition-colors duration-300 nav-scrolled:text-black">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M3 1a1 1 0 000 2h1l.8 3h10.4l.8-3h1a1 1 0 100-2H3zm2.6 6l1.4 5.6A2 2 0 009 14h4a2 2 0 001.9-1.4L16.4 7H5.6zM6 17a1 1 0 102 0 1 1 0 00-2 0zm6 1a1 1 0 100-2 1 1 0 000 2z"/>
                            </svg>
                            <span id="cart-count" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full px-1.5">
                            0
                            </span>
                        </a>
                        @else
                        <span></span>
                        @endauth
                    </div>

                        @auth
                        <div x-data="{ open: false }" class="relative ml-6">
                            <button @click="open = !open" 
                                    class="flex items-center space-x-2 focus:outline-none transition-all duration-200">
                                    <div class="flex items-center space-x-2 transition-colors duration-200 text-[#f8e8e8] scrolled:text-black">
                                    <!-- User avatar and name -->
                                    <div class="relative h-10 w-10 rounded-full bg-gradient-to-tr from-gray-100 to-gray-300 flex items-center justify-center overflow-hidden shadow-sm">
                                        <span class="text-gray-600 font-medium text-sm uppercase">
                                            {{ substr(Auth::user()->name, 0, 1) }}
                                        </span>
                                        <span class="absolute bottom-1 right-1 h-2.5 w-2.5 rounded-full bg-green-400 border-2 border-white"></span>
                                    </div>
                                    
                                    <p class="font-bold">
                                        {{ Auth::user()->name }}
                                    </p>        
                                    
                                    <!-- Chevron Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                        class="h-4 w-4 transition-all duration-200 scrolled:text-black"
                                        :class="{ 'rotate-180': open }"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>

                            <div x-show="open"
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95"
                                    @click.away="open = false"
                                    class="absolute right-0 mt-2 w-56 origin-top-right rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none z-50 overflow-hidden">
                                
                                <div class="px-4 py-3 bg-gray-50 border-b border-gray-100">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                </div>
                                
                                <div class="py-1">
                                    <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150">
                                        <svg class="h-5 w-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        Profile
                                    </a>
                                    
                                    <a href="" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition-colors duration-150">
                                        <svg class="h-5 w-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        Mes commandes
                                    </a>
                                </div>
                                
                                <div class="py-1 border-t border-gray-100">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="flex w-full items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-150">
                                            <svg class="h-5 w-5 mr-3 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            Déconnexion
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @else
                            <a href="{{ route('login') }}" class="nav-link">
                                {{ __('Se connecter') }}
                            </a>
                            <a href="{{ route('register') }}" class="ml-4 bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-700">
                                {{ __('S\'inscrire') }}
                            </a>
                        @endauth
                    </div>

                    <!-- Mobile Menu Button -->
                    <div class="md:hidden flex items-center">
                        <button @click="isOpen = !isOpen" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-gray-200 focus:outline-none nav-button">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{'hidden': isOpen, 'inline-flex': !isOpen}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{'hidden': !isOpen, 'inline-flex': isOpen}" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div class="md:hidden mobile-menu" style="margin-top: 20px;" x-show="isOpen" x-cloak @click.away="isOpen = false" x-transition>
                    <div class="px-2 pt-2 pb-3 space-y-1 shadow-lg">
                        <x-responsive-nav-link href="{{ route('welcome') }}" 
                            :active="request()->routeIs('welcome')" 
                            class="">
                            {{ __('Accueil') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('serviceClient') }}" 
                            :active="request()->routeIs('serviceClient')" 
                            class="">
                            {{ __('Services') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('galleryClient') }}" 
                            :active="request()->routeIs('galleryClient')" 
                            class="">
                            {{ __('Gallerie') }}
                        </x-responsive-nav-link>
                        <!-- Mobile version -->
<div class="mobile-products-dropdown">
    <x-responsive-nav-link class="font-semibold">
        {{ __("Produits") }}
    </x-responsive-nav-link>
    
    <div class="mobile-products-dropdown-content">
        @auth
            <x-responsive-nav-link href="{{ route('product.private') }}" :active="request()->routeIs('product.private')">
                Tous les produits
            </x-responsive-nav-link>
            
            <x-responsive-nav-link href="{{ route('product.private', ['category' => 'homme']) }}" :active="request()->routeIs('product.private') && request()->category == 'homme'">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Pour Hommes
                </div>
            </x-responsive-nav-link>
            
            <x-responsive-nav-link href="{{ route('product.private', ['category' => 'femme']) }}" :active="request()->routeIs('product.private') && request()->category == 'femme'">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Pour Femmes
                </div>
            </x-responsive-nav-link>
        @else
            <x-responsive-nav-link href="{{ route('product.public') }}" :active="request()->routeIs('product.public')">
                Tous les produits
            </x-responsive-nav-link>
            
            <x-responsive-nav-link href="{{ route('product.public', ['category' => 'homme']) }}" :active="request()->routeIs('product.public') && request()->category == 'homme'">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Pour Hommes
                </div>
            </x-responsive-nav-link>
            
            <x-responsive-nav-link href="{{ route('product.public', ['category' => 'femme']) }}" :active="request()->routeIs('product.public') && request()->category == 'femme'">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Pour Femmes
                </div>
            </x-responsive-nav-link>
        @endauth
    </div>
</div>
                        <x-responsive-nav-link href="#" style="display: ;">
                            {{ __('Contacts') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link href="{{ route('profile.edit') }}" 
                            :active="request()->routeIs('profile.edit')" 
                            class="">
                            {{ __('Profile') }}
                        </x-responsive-nav-link>

                        <div class="border-t pt-4 mt-4 space-y-2">
                            @auth
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full px-3 py-2 text-left text-white hover:text-gray-200 responsive-nav-link" style="color: #000;">
                                        {{ __('Déconnexion') }}
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="block px-3 py-2 text-white hover:text-gray-200 responsive-nav-link">
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

        <!-- Hero Section -->
        <!-- Replace your hero div with this video version -->
<div class="hero">
    <video autoplay muted loop playsinline class="absolute w-full h-full object-cover">
        <source src="/images/bghVid.mp4" type="video/mp4">
        <!-- Fallback image if video can't load -->
        <img src="/images/fallback-image.jpg" alt="Background fallback">
    </video>
    <div class="hero-content" style="margin-top: 120px;">
        <!-- Your existing hero content -->
        <h2>Sublimez votre beauté <br> naturelle</h2>
        <p>Découvrez notre collection soigneusement <br> sélectionnée de soins de la peau et d'essentiels beauté haut de gamme.</p>
        <a href="" class="shop-now-btn" onclick="smoothScroll()">Shop now</a>
    </div>
    <div class="hero-content" style="margin-bottom: 10px">
        <!-- Your existing hero content -->
        <h2 style="font-weight: lighter;">Get 10% off <br>of your first order</h2>
    </div>
    
</div>
    </div>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
    const nav = document.getElementById('mainNav');
    if (window.scrollY > 50) {
        nav.classList.add('scrolled');
    } else {
        nav.classList.remove('scrolled');
    }
    });

    function smoothScroll() {
        const productsSection = document.getElementById('products');
        productsSection.scrollIntoView({ 
        behavior: 'smooth' 
        });
    }
    </script>
</body>
</html> 