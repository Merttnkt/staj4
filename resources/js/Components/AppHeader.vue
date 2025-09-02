<script setup>
import { computed, ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const page = usePage();
const user = computed(() => page.props.auth.user);
const cart = computed(() => page.props.cart || { items: [] });

const cartCount = computed(() => {
    return cart.value?.items?.reduce((total, item) => total + item.quantity, 0) || 0;
});
const isDropdownOpen = ref(false);
const isMobileMenuOpen = ref(false);

</script>

<template>
    <header class="shadow-md sticky top-0 bg-white z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            
            <div class="flex-shrink-0">
                <Link :href="route('welcome')">
                    <h1 class="text-3xl font-bold text-slate-800 cursor-pointer">Markanız mobilya</h1>
                </Link>
            </div>

            <nav class="hidden md:flex flex-grow justify-center items-center space-x-8">
                <Link 
                    :href="route('welcome')" 
                    class="font-semibold transition-colors duration-200" 
                    :class="{ 'text-blue-600': $page.component === 'Welcome' || $page.url === '/', 'text-slate-600 hover:text-blue-600': !($page.component === 'Welcome' || $page.url === '/') }">
                    Ana Sayfa
                </Link>

                <div class="relative" @mouseenter="isDropdownOpen = true" @mouseleave="isDropdownOpen = false">
                    <button @click="isDropdownOpen = !isDropdownOpen" class="font-semibold flex items-center transition-colors duration-200 text-slate-600 hover:text-blue-600 focus:outline-none"
                        :class="{ 'text-blue-600': $page.url.startsWith('/products') }">
                        <span>Ürünler</span>
                        <svg class="w-4 h-4 ml-1 transition-transform duration-200" :class="{ 'rotate-180': isDropdownOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <transition
                        enter-active-class="transition ease-out duration-200"
                        enter-from-class="opacity-0 scale-95"
                        enter-to-class="opacity-100 scale-100"
                        leave-active-class="transition ease-in duration-75"
                        leave-from-class="opacity-100 scale-100"
                        leave-to-class="opacity-0 scale-95"
                    >
                        <div v-if="isDropdownOpen" class="absolute z-30 mt-2 w-48 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5">
                            <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                                <Link @click="isDropdownOpen = false" :href="route('products.category', 'masalar')" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900" role="menuitem">Masalar</Link>
                                <Link @click="isDropdownOpen = false" :href="route('products.category', 'sandalyeler')" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900" role="menuitem">Sandalyeler</Link>
                                <Link @click="isDropdownOpen = false" :href="route('products.category', 'bahce-mobilyasi')" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 hover:text-slate-900" role="menuitem">Bahçe Mobilyası</Link>
                            </div>
                        </div>
                    </transition>
                </div>

                <Link 
                    :href="route('about')" 
                    class="font-semibold transition-colors duration-200"
                    :class="{ 'text-blue-600': $page.component === 'About', 'text-slate-600 hover:text-blue-600': $page.component !== 'About' }">
                    Hakkımızda
                </Link>
                <Link 
                    :href="route('contact')" 
                    class="font-semibold transition-colors duration-200"
                    :class="{ 'text-blue-600': $page.component === 'Contact', 'text-slate-600 hover:text-blue-600': $page.component !== 'Contact' }">
                    İletişim
                </Link>
            </nav>

            <div class="flex items-center space-x-4">
                
                <div class="relative">
                    <button type="button" class="text-slate-500 hover:text-blue-600 relative transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span v-if="cartCount > 0" class="absolute -top-2 -right-2 bg-blue-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                            {{ cartCount }}
                        </span>
                    </button>
                </div>

                <div class="md:hidden">
                    <button @click="isMobileMenuOpen = !isMobileMenuOpen" type="button" class="text-slate-500 hover:text-blue-600 focus:outline-none focus:text-blue-600">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{'hidden': isMobileMenuOpen, 'inline-flex': !isMobileMenuOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{'hidden': !isMobileMenuOpen, 'inline-flex': isMobileMenuOpen }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <div v-if="user" class="hidden lg:flex items-center space-x-3">
                    <span class="text-sm text-slate-600">Hoş geldin, {{ user.name }}</span>
                    <Link :href="route('logout')" method="post" as="button" class="px-4 py-2 text-sm text-slate-600 hover:text-slate-900 border border-slate-300 rounded-lg hover:bg-slate-50 transition-colors duration-200">
                        Çıkış
                    </Link>
                </div>
                <div v-else class="hidden lg:flex space-x-3">
                    <Link :href="route('register')" class="px-5 py-2.5 border border-blue-600 text-blue-600 rounded-lg text-sm font-semibold hover:bg-blue-50 transition-colors duration-200">
                        Üye Ol
                    </Link>
                    <Link :href="route('login')" class="px-5 py-2.5 bg-blue-600 text-white rounded-lg text-sm font-semibold shadow-md hover:bg-blue-700 transition-colors duration-200">
                        Giriş Yap
                    </Link>
                </div>
                
            </div>
        </div>
        
        <div v-if="isMobileMenuOpen" class="md:hidden bg-white border-t">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <Link @click="isMobileMenuOpen = false" :href="route('welcome')" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-slate-50">
                    Ana Sayfa
                </Link>
                <div class="relative">
                    <button @click="isDropdownOpen = !isDropdownOpen" class="w-full text-left block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-slate-50 flex items-center justify-between">
                        <span>Ürünler</span>
                        <svg class="w-4 h-4 ml-1 transition-transform duration-200" :class="{ 'rotate-180': isDropdownOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    <div v-if="isDropdownOpen" class="pl-6 pr-3 py-1 space-y-1">
                        <Link @click="isMobileMenuOpen = false; isDropdownOpen = false;" :href="route('products.category', 'masalar')" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-slate-50">Masalar</Link>
                        <Link @click="isMobileMenuOpen = false; isDropdownOpen = false;" :href="route('products.category', 'sandalyeler')" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-slate-50">Sandalyeler</Link>
                        <Link @click="isMobileMenuOpen = false; isDropdownOpen = false;" :href="route('products.category', 'bahce-mobilyasi')" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-slate-50">Bahçe Mobilyası</Link>
                    </div>
                </div>
                <Link @click="isMobileMenuOpen = false" :href="route('about')" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-slate-50">
                    Hakkımızda
                </Link>
                <Link @click="isMobileMenuOpen = false" :href="route('contact')" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-slate-50">
                    İletişim
                </Link>
            </div>
            <div class="pt-4 pb-3 border-t border-slate-200">
                <div v-if="user" class="flex items-center px-5">
                    <div class="flex-shrink-0">
                        <div class="h-10 w-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-600 text-lg font-semibold">{{ user.name.charAt(0) }}</div>
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-slate-800">{{ user.name }}</div>
                        <div class="text-sm font-medium text-slate-500">{{ user.email }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    <Link v-if="user" @click="isMobileMenuOpen = false" :href="route('logout')" method="post" as="button" class="block w-full text-left px-4 py-2 text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-slate-50">
                        Çıkış Yap
                    </Link>
                    <div v-else class="space-y-1">
                        <Link @click="isMobileMenuOpen = false" :href="route('register')" class="block w-full text-left px-4 py-2 text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-slate-50">
                            Üye Ol
                        </Link>
                        <Link @click="isMobileMenuOpen = false" :href="route('login')" class="block w-full text-left px-4 py-2 text-base font-medium text-slate-700 hover:text-blue-600 hover:bg-slate-50">
                            Giriş Yap
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>
