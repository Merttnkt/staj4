<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const sidebarOpen = ref(false);
</script>

<template>
    <div class="relative min-h-screen bg-gray-100 font-sans lg:flex">
        <!-- Mobile Header -->
        <header class="lg:hidden bg-gradient-to-b from-slate-800 to-slate-900 text-white p-4 flex justify-between items-center fixed top-0 left-0 right-0 z-30 shadow-lg">
            <button @click="sidebarOpen = !sidebarOpen" class="text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
            <h1 class="text-xl font-bold tracking-wider">Markanız Mobilya Admin</h1>
            <div></div> <!-- Spacer -->
        </header>

        <!-- Overlay -->
        <div v-if="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden"></div>

        <!-- Sidebar -->
        <div :class="['fixed inset-y-0 left-0 w-64 bg-gradient-to-b from-slate-800 to-slate-900 text-white flex flex-col shadow-lg z-40 transform lg:translate-x-0 lg:static lg:inset-0', { 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }]" class="transition-transform duration-300 ease-in-out">
            <div class="p-5 text-2xl font-bold border-b border-slate-700 tracking-wider">
                Markanız Mobilya Admin
            </div>
            <nav class="flex-1 p-4 space-y-2 mt-4">
                <Link :href="route('admin.dashboard')" class="flex items-center py-3 px-4 rounded-lg transition-colors duration-200" :class="{ 'bg-blue-600 font-bold': route().current('admin.dashboard'), 'hover:bg-slate-700': !route().current('admin.dashboard') }">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    <span>Dashboard</span>
                </Link>
                <Link :href="route('admin.settings.contact')" class="flex items-center py-3 px-4 rounded-lg transition-colors duration-200" :class="{ 'bg-blue-600 font-bold': route().current('admin.settings.contact'), 'hover:bg-slate-700': !route().current('admin.settings.contact') }">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span>İletişim Ayarları</span>
                </Link>
                <Link :href="route('admin.settings.about')" class="flex items-center py-3 px-4 rounded-lg transition-colors duration-200" :class="{ 'bg-blue-600 font-bold': route().current('admin.settings.about'), 'hover:bg-slate-700': !route().current('admin.settings.about') }">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Hakkımızda Ayarları</span>
                </Link>
                <Link :href="route('admin.product-categories.index')" class="flex items-center py-3 px-4 rounded-lg transition-colors duration-200" :class="{ 'bg-blue-600 font-bold': route().current('admin.product-categories.index'), 'hover:bg-slate-700': !route().current('admin.product-categories.index') }">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    <span>Kategori Yönetimi</span>
                </Link>
                <Link :href="route('admin.products.index')" class="flex items-center py-3 px-4 rounded-lg transition-colors duration-200" :class="{ 'bg-blue-600 font-bold': route().current('admin.products.*'), 'hover:bg-slate-700': !route().current('admin.products.*') }">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    <span>Ürün & Özellik Yönetimi</span>
                </Link>
                <Link :href="route('admin.users.index')" class="flex items-center py-3 px-4 rounded-lg transition-colors duration-200" :class="{ 'bg-blue-600 font-bold': route().current('admin.users.index'), 'hover:bg-slate-700': !route().current('admin.users.index') }">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path></svg>
                    <span>Kullanıcı Yönetimi</span>
                </Link>
            </nav>
            <div class="p-4 mt-auto border-t border-slate-700">
                 <div v-if="$page.props.auth.admin" class="mb-4">
                    <div class="text-sm text-gray-400">Logged in as:</div>
                    <div class="text-lg font-semibold">{{ $page.props.auth.admin.name }}</div>
                </div>
                <Link :href="route('admin.logout')" method="post" as="button" class="w-full flex items-center text-left py-3 px-4 rounded-lg bg-red-600 hover:bg-red-700 transition-colors duration-200">
                     <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    <span>Admin Çıkış Yap</span>
                </Link>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col">
            <main class="flex-1 p-6 bg-gray-50 pt-20 lg:pt-6">
                <slot />
            </main>
        </div>
    </div>
</template>
