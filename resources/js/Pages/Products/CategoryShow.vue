<script setup>
import { ref, onMounted, computed } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    category: Object,
    products: Object,
    categories: Array,
    filters: Object,
});

defineOptions({
    layout: AppLayout
});

const openFilters = ref(['price', 'color', 'category']);

const toggleFilter = (filter) => {
    const index = openFilters.value.indexOf(filter);
    if (index === -1) {
        openFilters.value.push(filter);
    } else {
        openFilters.value.splice(index, 1);
    }
};

</script>

<template>
    <Head :title="category.name" />

    <div class="bg-gray-50 py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Breadcrumb and Title -->
            <nav class="text-sm text-gray-500 mb-2">
                <Link :href="route('welcome')" class="hover:text-gray-700">Ana Sayfa</Link>
                <span class="mx-2">/</span>
                <Link :href="route('products.index')" class="hover:text-gray-700">Ürünler</Link>
                <span class="mx-2 font-semibold text-gray-700">/ {{ category.name }}</span>
            </nav>
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">{{ category.name }}</h1>
        </div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex flex-col md:flex-row md:gap-8">
            <!-- Filters Sidebar -->
            <div class="w-full md:w-1/4">
                <aside class="sticky top-24 border border-gray-200 rounded-lg p-6 bg-white shadow-sm">
                    <div class="space-y-4">
                        <!-- Price Range Filter -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-3 cursor-pointer flex justify-between items-center" @click="toggleFilter('price')">
                                Fiyat Aralığı
                                <svg class="w-5 h-5 transition-transform" :class="{'rotate-180': openFilters.includes('price')}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </h3>
                            <div v-show="openFilters.includes('price')" class="flex items-center space-x-2 mt-4">
                                <input type="text" placeholder="Min" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm">
                                <span class="text-gray-400">-</span>
                                <input type="text" placeholder="Max" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                        </div>

                        <!-- Category Filter -->
                        <div class="border-t border-gray-200 pt-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3 cursor-pointer flex justify-between items-center" @click="toggleFilter('category')">
                                Kategori
                                <svg class="w-5 h-5 transition-transform" :class="{'rotate-180': openFilters.includes('category')}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </h3>
                            <div v-show="openFilters.includes('category')" class="space-y-3 mt-4">
                                <Link v-for="cat in categories" :key="cat.id" :href="route('products.category', { category: cat.slug })" class="flex items-center text-gray-700 hover:text-blue-600" :class="{ 'font-bold text-blue-600': category.id === cat.id }">
                                    {{ cat.name }}
                                </Link>
                            </div>
                        </div>

                        <!-- Color Filter -->
                        <div class="border-t border-gray-200 pt-4">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3 cursor-pointer flex justify-between items-center" @click="toggleFilter('color')">
                                Renk
                                <svg class="w-5 h-5 transition-transform" :class="{'rotate-180': openFilters.includes('color')}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </h3>
                            <div v-show="openFilters.includes('color')" class="space-y-3 mt-4">
                                <label class="flex items-center">
                                    <input type="checkbox" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <span class="ml-3 text-gray-700">Beyaz</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <span class="ml-3 text-gray-700">Siyah</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <span class="ml-3 text-gray-700">Ahşap</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <span class="ml-3 text-gray-700">Gri</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>

            <!-- Product Grid -->
            <main class="w-full md:w-3/4 mt-8 md:mt-0">
                <div v-if="products.data.length > 0" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                    <Link v-for="product in products.data" :key="product.id" :href="route('product.show', { product: product.slug })" class="bg-white border border-gray-200 rounded-lg overflow-hidden group transition-all duration-300 ease-in-out hover:shadow-xl hover:-translate-y-1 relative block">
                        <div class="block overflow-hidden">
                            <img :src="product.image_url || 'https://via.placeholder.com/400x300'" :alt="product.name" class="w-full h-64 object-cover transform group-hover:scale-105 transition-transform duration-300">
                        </div>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 truncate">{{ product.name }}</h3>
                            <p v-if="$page.props.auth.user" class="text-md text-gray-600 mt-1">{{ product.price }} TL</p>
                            <p v-else class="text-md text-blue-600 mt-1">Fiyat için giriş yapın</p>
                            <button v-if="$page.props.auth.user" class="absolute bottom-4 right-4 md:opacity-0 group-hover:md:opacity-100 transition-opacity bg-blue-600 text-white py-2 px-4 rounded-md font-semibold hover:bg-blue-700 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Sepete Ekle
                            </button>
                        </div>
                    </Link>
                </div>
                <div v-else class="text-center py-16">
                    <p class="text-xl text-gray-500">Bu kategoride henüz ürün bulunmamaktadır.</p>
                </div>
            </main>
        </div>
    </div>
</template>