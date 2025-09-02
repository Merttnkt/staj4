<script setup>
import { ref, watch } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import debounce from 'lodash.debounce';

const props = defineProps({
    products: {
        type: Object,
        required: true,
    },
    categories: {
        type: Array,
        required: true,
    },
    filters: {
        type: Object,
        default: () => ({}),
    },
});

const filters = ref({
    price: props.filters.price || '',
    color: props.filters.color || '',
    category: props.filters.category ? Number(props.filters.category) : '',
});

watch(filters, debounce(() => {
    router.get(route('products.index'), filters.value, {
        preserveState: true,
        replace: true,
    });
}, 500), { deep: true });

</script>

<template>
    <Head title="Ürünler" />

    <AppLayout>
        <div class="bg-white">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl">
                        Tüm Ürünler
                    </h1>
                    <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-500">
                        Koleksiyonumuzdaki en yeni ve en popüler ürünleri keşfedin.
                    </p>
                </div>

                <div class="lg:grid lg:grid-cols-4 lg:gap-x-8">
                    <!-- Filtreleme Bölümü (Sol Sütun) -->
                    <aside class="hidden lg:block">
                        <h2 class="sr-only">Filtreler</h2>

                        <div class="space-y-10">
                            <!-- Kategori Filtresi -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                    Kategoriler
                                </h3>
                                <ul class="space-y-2">
                                    <li v-for="category in categories" :key="category.id">
                                        <label class="flex items-center space-x-3 cursor-pointer">
                                            <input 
                                                type="radio" 
                                                name="category"
                                                :value="category.id"
                                                v-model.number="filters.category"
                                                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                            />
                                            <span 
                                                class="text-sm"
                                                :class="{'text-indigo-600 font-semibold': filters.category == category.id, 'text-gray-600': filters.category != category.id}"
                                            >
                                                {{ category.name }}
                                            </span>
                                        </label>
                                    </li>
                                    <!-- Tümünü Temizle Seçeneği -->
                                    <li v-if="filters.category">
                                        <button @click="filters.category = ''" class="text-sm text-gray-500 hover:text-indigo-600 mt-2">
                                            Temizle
                                        </button>
                                    </li>
                                </ul>
                            </div>

                            <!-- Fiyat Filtresi (Örnek) -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                    Fiyata Göre Sırala
                                </h3>
                                <select v-model="filters.price" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="">Önerilen</option>
                                    <option value="asc">En Düşük Fiyat</option>
                                    <option value="desc">En Yüksek Fiyat</option>
                                </select>
                            </div>

                            <!-- Renk Filtresi (Örnek) -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                    Renk
                                </h3>
                                <!-- Kendi renk seçeneklerinizi buraya ekleyebilirsiniz -->
                                <div class="flex flex-wrap gap-2">
                                    <button @click="filters.color = 'Siyah'" :class="['px-3 py-1 text-sm rounded-full border', filters.color === 'Siyah' ? 'bg-gray-900 text-white border-gray-900' : 'bg-white text-gray-700 border-gray-300']">Siyah</button>
                                    <button @click="filters.color = 'Beyaz'" :class="['px-3 py-1 text-sm rounded-full border', filters.color === 'Beyaz' ? 'bg-white text-gray-700 border-gray-300' : 'bg-gray-200']">Beyaz</button>
                                    <button @click="filters.color = 'Ahşap'" :class="['px-3 py-1 text-sm rounded-full border', filters.color === 'Ahşap' ? 'bg-yellow-700 text-white border-yellow-700' : 'bg-white text-gray-700 border-gray-300']">Ahşap</button>
                                    <button v-if="filters.color" @click="filters.color = ''" class="text-xs text-gray-500">Temizle</button>
                                </div>
                            </div>
                        </div>
                    </aside>

                    <!-- Ürün Listesi (Sağ Sütun) -->
                    <div class="mt-6 lg:mt-0 lg:col-span-3">
                        <div v-if="products.data.length > 0" class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
                            <Link v-for="product in products.data" :key="product.id" :href="route('product.show', product.slug)" class="group">
                                <div class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden xl:aspect-w-7 xl:aspect-h-8">
                                    <img :src="product.image_url" :alt="product.name" class="w-full h-full object-center object-cover group-hover:opacity-75 transition-opacity">
                                </div>
                                <h3 class="mt-4 text-sm text-gray-700">{{ product.name }}</h3>
                                <p v-if="$page.props.auth.user" class="mt-1 text-lg font-medium text-gray-900">{{ product.price }} TL</p>
                                <p v-else class="mt-1 text-lg font-medium text-blue-600">Fiyat için giriş yapın</p>
                            </Link>
                        </div>
                        <div v-else class="text-center py-12">
                            <p class="text-lg text-gray-500">Seçtiğiniz kriterlere uygun ürün bulunamadı.</p>
                        </div>

                        <!-- Sayfalama (Pagination) -->
                        <div class="mt-12 flex justify-center">
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <Link
                                    v-for="(link, index) in products.links"
                                    :key="index"
                                    :href="link.url"
                                    v-html="link.label"
                                    class="relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                                    :class="{
                                        'z-10 bg-indigo-50 border-indigo-500 text-indigo-600': link.active,
                                        'bg-white border-gray-300 text-gray-500 hover:bg-gray-50': !link.active,
                                        'rounded-l-md': index === 0,
                                        'rounded-r-md': index === products.links.length - 1,
                                        'pointer-events-none opacity-50': !link.url
                                    }"
                                    preserve-state
                                />
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
