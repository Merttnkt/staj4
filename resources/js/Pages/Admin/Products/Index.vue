<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { ref, computed } from 'vue';
import { PencilIcon, TrashIcon, EyeIcon, PlusIcon } from '@heroicons/vue/24/outline';

defineOptions({
    layout: AdminLayout
});

const props = defineProps({
    products: Object,
    categories: Array,
    filters: Object
});

const searchForm = ref({
    search: props.filters.search || '',
    category: props.filters.category || ''
});

const search = () => {
    router.get(route('admin.products.index'), searchForm.value, {
        preserveState: true,
        replace: true
    });
};

const deleteProduct = (product) => {
    if (confirm(`"${product.name}" ürününü silmek istediğinizden emin misiniz?`)) {
        router.delete(route('admin.products.destroy', product.id));
    }
};

const clearFilters = () => {
    searchForm.value = { search: '', category: '' };
    search();
};
</script>

<template>
    <Head title="Ürün Yönetimi - Admin Panel" />

    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Ürün Yönetimi</h1>
                <p class="text-gray-600 mt-1">Tüm ürünleri görüntüleyin ve yönetin</p>
            </div>
            <Link :href="route('admin.products.create')"
                  class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                <PlusIcon class="w-5 h-5 mr-2" />
                Yeni Ürün Ekle
            </Link>
        </div>

        <!-- Filters -->
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ürün Ara</label>
                    <input v-model="searchForm.search" @keyup.enter="search" type="text" 
                           placeholder="Ürün adı..." 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <select v-model="searchForm.category" @change="search" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Tüm Kategoriler</option>
                        <option v-for="category in categories" :key="category.id" :value="category.id">
                            {{ category.name }}
                        </option>
                    </select>
                </div>
                <div class="flex items-end space-x-2">
                    <button @click="search" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                        Filtrele
                    </button>
                    <button @click="clearFilters" 
                            class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition-colors">
                        Temizle
                    </button>
                </div>
            </div>
        </div>

        <!-- Products Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div v-if="products.data.length === 0" class="text-center py-12">
                <p class="text-gray-500">Henüz hiç ürün eklenmemiş.</p>
                <Link :href="route('admin.products.create')"
                      class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                    <PlusIcon class="w-5 h-5 mr-2" />
                    İlk Ürünü Ekle
                </Link>
            </div>

            <div v-else class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ürün</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fiyat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tarih</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">İşlemler</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="product in products.data" :key="product.id" class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-12 w-12">
                                        <img v-if="product.image_url" 
                                             :src="product.image_url" 
                                             :alt="product.name"
                                             class="h-12 w-12 rounded-lg object-cover">
                                        <div v-else class="h-12 w-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <span class="text-gray-400 text-xs">No Image</span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ product.name }}</div>
                                        <div class="text-sm text-gray-500">{{ product.slug }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ product.category.name }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ new Intl.NumberFormat('tr-TR', { 
                                    style: 'currency', 
                                    currency: 'TRY',
                                    minimumFractionDigits: 0
                                }).format(product.price) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ new Date(product.created_at).toLocaleDateString('tr-TR') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <Link :href="route('admin.products.show', product.id)"
                                          class="text-gray-600 hover:text-gray-900 p-2 rounded-md hover:bg-gray-100">
                                        <EyeIcon class="w-5 h-5" />
                                    </Link>
                                    <Link :href="route('admin.products.edit', product.id)"
                                          class="text-blue-600 hover:text-blue-900 p-2 rounded-md hover:bg-blue-100">
                                        <PencilIcon class="w-5 h-5" />
                                    </Link>
                                    <button @click="deleteProduct(product)"
                                            class="text-red-600 hover:text-red-900 p-2 rounded-md hover:bg-red-100">
                                        <TrashIcon class="w-5 h-5" />
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div v-if="products.links.length > 3" class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                <div class="flex justify-between items-center">
                    <div class="text-sm text-gray-700">
                        <span class="font-medium">{{ products.from || 0 }}</span>
                        -
                        <span class="font-medium">{{ products.to || 0 }}</span>
                        arası gösteriliyor,
                        toplam <span class="font-medium">{{ products.total }}</span> ürün
                    </div>
                    <div class="flex space-x-1">
                        <template v-for="(link, index) in products.links" :key="index">
                            <Link v-if="link.url && !link.active"
                                  :href="link.url"
                                  class="px-3 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-md transition-colors"
                                  v-html="link.label">
                            </Link>
                            <span v-else-if="link.active"
                                  class="px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-md"
                                  v-html="link.label">
                            </span>
                            <span v-else
                                  class="px-3 py-2 text-sm font-medium text-gray-300 rounded-md"
                                  v-html="link.label">
                            </span>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>