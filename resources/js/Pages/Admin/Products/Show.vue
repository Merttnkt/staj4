<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { ArrowLeftIcon, PencilIcon } from '@heroicons/vue/24/outline';

defineOptions({
    layout: AdminLayout
});

const props = defineProps({
    product: Object
});

const formatPrice = (price) => {
    return new Intl.NumberFormat('tr-TR', { 
        style: 'currency', 
        currency: 'TRY',
        minimumFractionDigits: 0
    }).format(price);
};

const formatDate = (date) => {
    return new Date(date).toLocaleDateString('tr-TR', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
};
</script>

<template>
    <Head :title="`${product.name} - Detay - Admin Panel`" />

    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <Link :href="route('admin.products.index')" 
                      class="inline-flex items-center text-gray-600 hover:text-gray-900">
                    <ArrowLeftIcon class="w-5 h-5 mr-2" />
                    Ürün Listesi
                </Link>
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ product.name }}</h1>
                    <p class="text-gray-600 mt-1">Ürün detayları</p>
                </div>
            </div>
            <Link :href="route('admin.products.edit', product.id)"
                  class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                <PencilIcon class="w-5 h-5 mr-2" />
                Düzenle
            </Link>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Product Image -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Ürün Resmi</h3>
                    <div v-if="product.image_url" class="aspect-square">
                        <img :src="product.image_url" 
                             :alt="product.name"
                             class="w-full h-full object-cover rounded-lg border border-gray-200"
                             @error="$event.target.parentElement.innerHTML = '<div class=\'w-full h-full bg-gray-100 rounded-lg flex items-center justify-center text-gray-400\'>Resim yüklenemedi</div>'">
                    </div>
                    <div v-else class="aspect-square bg-gray-100 rounded-lg flex items-center justify-center">
                        <span class="text-gray-400">Resim bulunmuyor</span>
                    </div>
                </div>
            </div>

            <!-- Product Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Information -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Temel Bilgiler</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ürün Adı</label>
                            <p class="text-gray-900">{{ product.name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                            <p class="text-gray-900 font-mono text-sm">{{ product.slug }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                            <span class="inline-flex px-2 py-1 text-sm font-medium rounded-full bg-blue-100 text-blue-800">
                                {{ product.category.name }}
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Fiyat</label>
                            <p class="text-2xl font-bold text-green-600">{{ formatPrice(product.price) }}</p>
                        </div>
                    </div>

                    <div v-if="product.description" class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Açıklama</label>
                        <div class="prose prose-sm max-w-none">
                            <p class="text-gray-900 leading-relaxed">{{ product.description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Product Attributes -->
                <div v-if="product.attributes && Object.keys(product.attributes).length > 0" class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Ürün Özellikleri</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div v-for="(value, key) in product.attributes" :key="key" 
                             class="flex justify-between items-center py-2 px-3 bg-gray-50 rounded-md">
                            <span class="font-medium text-gray-700">{{ key }}:</span>
                            <span class="text-gray-900">{{ value }}</span>
                        </div>
                    </div>
                </div>

                <!-- Metadata -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Metadata</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Oluşturulma Tarihi</label>
                            <p class="text-gray-900">{{ formatDate(product.created_at) }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Son Güncelleme</label>
                            <p class="text-gray-900">{{ formatDate(product.updated_at) }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ürün ID</label>
                            <p class="text-gray-900 font-mono">#{{ product.id }}</p>
                        </div>
                        <div v-if="product.image_url">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Resim URL</label>
                            <a :href="product.image_url" target="_blank" 
                               class="text-blue-600 hover:text-blue-800 text-sm break-all">
                                {{ product.image_url }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Hızlı İşlemler</h3>
                    <div class="flex space-x-4">
                        <Link :href="route('admin.products.edit', product.id)"
                              class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                            <PencilIcon class="w-4 h-4 mr-2" />
                            Düzenle
                        </Link>
                        <Link :href="route('product.show', product.slug)" target="_blank"
                              class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                            Sitede Görüntüle
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>