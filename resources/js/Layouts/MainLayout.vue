<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<template>
    <div class="bg-gray-100 text-gray-800 min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white shadow-md sticky top-0 z-50">
            <div class="container mx-auto px-6 py-4 flex justify-between items-center">
                <Link :href="route('welcome')">
                    <h1 class="text-3xl font-bold text-gray-900">Markanız Mobilya</h1>
                </Link>
                <nav class="hidden md:flex items-center space-x-8">
                    <Link :href="route('welcome')" class="text-gray-600 hover:text-gray-900" :class="{ 'font-bold text-blue-600': $page.component === 'Welcome' }">Ana Sayfa</Link>
                    <div class="relative group">
                        <button class="text-gray-600 hover:text-gray-900 focus:outline-none flex items-center" :class="{ 'font-bold text-blue-600': $page.component.startsWith('Products/') }">
                            Ürünler
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>
                        <div class="absolute z-10 hidden group-hover:block bg-white shadow-lg rounded-md mt-2 py-2 w-48">
                            <Link :href="route('products.category', { category: 'masalar' })" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" :class="{ 'font-bold': $page.props.category?.slug === 'masalar' }">Masalar</Link>
                            <Link :href="route('products.category', { category: 'sandalyeler' })" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" :class="{ 'font-bold': $page.props.category?.slug === 'sandalyeler' }">Sandalyeler</Link>
                            <Link :href="route('products.category', { category: 'bahce-mobilyalari' })" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" :class="{ 'font-bold': $page.props.category?.slug === 'bahce-mobilyalari' }">Bahçe Mobilyaları</Link>
                        </div>
                    </div>
                    <Link :href="route('about')" class="text-gray-600 hover:text-gray-900" :class="{ 'font-bold text-blue-600': $page.component === 'About' }">Hakkımızda</Link>
                    <Link :href="route('contact')" class="text-gray-600 hover:text-gray-900" :class="{ 'font-bold text-blue-600': $page.component === 'Contact' }">İletişim</Link>
                </nav>
                <div class="flex items-center">
                    <Link v-if="canLogin" :href="route('login')" class="px-4 py-2 text-gray-600 hover:text-gray-900">Giriş Yap</Link>
                    <Link v-if="canRegister" :href="route('register')" class="ml-4 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Kayıt Ol</Link>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="flex-grow">
            <slot />
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white">
            <div class="container mx-auto px-6 py-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-xl font-bold">Markanız Mobilya</h3>
                        <p class="mt-2 text-gray-400">Kaliteli ve modern mobilyalarla yaşam alanlarınıza değer katıyoruz.</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold">Hızlı Erişim</h3>
                        <ul class="mt-4 space-y-2">
                            <li><Link :href="route('about')" class="hover:text-blue-400">Hakkımızda</Link></li>
                            <li><Link :href="route('contact')" class="hover:text-blue-400">İletişim</Link></li>
                            <li><Link href="#" class="hover:text-blue-400">Gizlilik Politikası</Link></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold">Bizi Takip Edin</h3>
                        <div class="flex space-x-4 mt-4">
                            <a href="#" class="text-gray-400 hover:text-white"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M22.05 7.54a4.47 4.47 0 0 0-3.3-1.46H5.25a4.47 4.47 0 0 0-3.3 1.46 4.5 4.5 0 0 0-1.36 3.39 4.5 4.5 0 0 0 1.36 3.39 4.47 4.47 0 0 0 3.3 1.46h13.5a4.47 4.47 0 0 0 3.3-1.46 4.5 4.5 0 0 0 1.36-3.39 4.5 4.5 0 0 0-1.36-3.39zM12 15.5a3.5 3.5 0 1 1 0-7 3.5 3.5 0 0 1 0 7zm4.5-6.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/></svg></a>
                            <a href="#" class="text-gray-400 hover:text-white"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.04c-5.5 0-10 4.49-10 10.02 0 5.52 4.5 10.02 10 10.02S22 17.56 22 12.04c0-5.53-4.5-10.02-10-10.02zm0 18.04c-4.42 0-8-3.58-8-8.02s3.58-8.02 8-8.02 8 3.58 8 8.02-3.58 8.02-8 8.02z"/><path d="M12 6.5c-3.03 0-5.5 2.47-5.5 5.5s2.47 5.5 5.5 5.5 5.5-2.47 5.5-5.5-2.47-5.5-5.5-5.5zm0 9c-1.93 0-3.5-1.57-3.5-3.5s1.57-3.5 3.5-3.5 3.5 1.57 3.5 3.5-1.57 3.5-3.5 3.5z"/></svg></a>
                        </div>
                    </div>
                </div>
                <div class="mt-8 border-t border-gray-700 pt-4 text-center text-gray-500">
                    &copy; {{ new Date().getFullYear() }} Markanız Mobilya. Tüm Hakları Saklıdır.
                </div>
            </div>
        </footer>
    </div>
</template>
