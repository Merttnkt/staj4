<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';

const props = defineProps({
    product: Object,
    similarProducts: Array
});

defineOptions({
    layout: AppLayout
});

const quantity = ref(1);
const selectedColor = ref(null);
const openAccordion = ref('description');
const mainImage = ref(props.product.image_url || 'https://images.unsplash.com/photo-1533090481720-856c6e7c6c54?w=800');

const thumbnails = ref([]);

if (props.product.images && props.product.images.length > 0) {
    thumbnails.value = props.product.images.map(img => img.url || img);
} else if (props.product.image_url) {
    thumbnails.value = [props.product.image_url];
}

const increment = () => quantity.value++;
const decrement = () => {
    if (quantity.value > 1) quantity.value--;
};
const setAccordion = (section) => {
    openAccordion.value = openAccordion.value === section ? null : section;
};

const selectColor = (color) => {
    selectedColor.value = color;
};

const formatPrice = (price) => {
    return new Intl.NumberFormat('tr-TR', { 
        style: 'currency', 
        currency: 'TRY',
        minimumFractionDigits: 0
    }).format(price);
};
</script>

<template>
    <Head :title="product.name" />

    <div class="bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                <div class="space-y-4">
                    <div class="bg-gray-100 rounded-lg shadow-md overflow-hidden aspect-square">
                        <img :src="mainImage" :alt="product.name" class="w-full h-full object-cover">
                    </div>
                    <div v-if="thumbnails.length > 1" class="grid grid-cols-4 gap-4">
                        <div v-for="(thumb, index) in thumbnails" :key="index" 
                             @click="mainImage = thumb"
                             :class="{'border-blue-500': mainImage === thumb}"
                             class="bg-gray-100 rounded-md cursor-pointer border-2 hover:border-blue-500 transition-colors">
                            <img :src="thumb" :alt="`Thumbnail ${index + 1}`" class="w-full h-full object-cover aspect-square rounded-sm">
                        </div>
                    </div>
                </div>

                <div class="flex flex-col">
                    <nav class="text-sm mb-4 text-gray-500">
                        <Link :href="route('welcome')" class="hover:text-blue-600">Ana Sayfa</Link>
                        <span class="mx-2">/</span>
                        <Link :href="route('products.category', { category: product.category.slug })" class="hover:text-blue-600">{{ product.category.name }}</Link>
                        <span class="mx-2">/</span>
                        <span class="font-medium text-gray-700">{{ product.name }}</span>
                    </nav>

                    <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-3">{{ product.name }}</h1>
                    <p v-if="$page.props.auth.user" class="text-3xl font-semibold text-blue-600 mb-6">{{ formatPrice(product.price) }}</p>
                    <div v-else class="mb-6">
                        <p class="text-2xl font-semibold text-gray-600 mb-2">Fiyat için giriş yapın</p>
                        <Link :href="route('login')" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 transition-colors">
                            Giriş Yap
                        </Link>
                    </div>

                    <div v-if="product.colors && product.colors.length > 0" class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Renk Seçimi:</label>
                        <div class="flex flex-wrap gap-3">
                            <button v-for="color in product.colors" :key="color.value"
                                    @click="selectColor(color)"
                                    :class="[
                                        'flex items-center space-x-2 px-4 py-2 rounded-lg border-2 transition-all',
                                        selectedColor?.value === color.value 
                                            ? 'border-blue-600 bg-blue-50' 
                                            : 'border-gray-200 hover:border-gray-300'
                                    ]">
                                <div class="w-6 h-6 rounded-full border border-gray-300" 
                                     :style="{ backgroundColor: color.hex }"></div>
                                <span class="text-sm font-medium text-gray-700">{{ color.name }}</span>
                            </button>
                        </div>
                    </div>

                    <div v-if="$page.props.auth.user" class="flex items-center mb-8">
                        <label for="quantity" class="mr-4 font-medium text-gray-800">Miktar:</label>
                        <div class="flex items-center border border-gray-300 rounded-md overflow-hidden">
                            <button @click="decrement" class="px-4 py-2 text-xl font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 transition-colors">-</button>
                            <input type="text" v-model="quantity" id="quantity" class="w-16 text-center border-x border-gray-300 focus:ring-0 focus:border-gray-300 text-lg font-semibold">
                            <button @click="increment" class="px-4 py-2 text-xl font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 transition-colors">+</button>
                        </div>
                    </div>

                    <div v-if="$page.props.auth.user" class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
                        <button class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg font-semibold text-lg hover:bg-blue-700 transition-transform transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Sepete Ekle
                        </button>
                        <button class="w-full bg-gray-100 text-gray-800 py-3 px-6 rounded-lg font-semibold text-lg hover:bg-gray-200 transition-colors flex items-center justify-center border border-gray-300">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            Favorilere Ekle
                        </button>
                    </div>

                    <div class="border-t border-gray-200">
                        <div class="border-b border-gray-200">
                            <button @click="setAccordion('description')" class="w-full flex justify-between items-center py-4 font-semibold text-left text-lg">
                                Açıklama
                                <svg :class="{'rotate-180': openAccordion === 'description'}" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div v-show="openAccordion === 'description'" class="pb-4 text-gray-600">
                                <p v-if="product.description">{{ product.description }}</p>
                                <p v-else>Bu ürün için henüz açıklama eklenmemiş.</p>
                            </div>
                        </div>
                        <div class="border-b border-gray-200">
                            <button @click="setAccordion('specs')" class="w-full flex justify-between items-center py-4 font-semibold text-left text-lg">
                                Ürün Özellikleri
                                <svg :class="{'rotate-180': openAccordion === 'specs'}" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div v-show="openAccordion === 'specs'" class="pb-4 text-gray-600">
                                <ul v-if="product.attributes && Object.keys(product.attributes).length > 0" class="list-disc list-inside space-y-1">
                                    <li v-for="(value, key) in product.attributes" :key="key">
                                        {{ key }}: {{ value }}
                                    </li>
                                </ul>
                                <p v-else>Bu ürün için henüz özellik eklenmemiş.</p>
                            </div>
                        </div>
                        <div class="border-b border-gray-200">
                            <button @click="setAccordion('shipping')" class="w-full flex justify-between items-center py-4 font-semibold text-left text-lg">
                                Teslimat & İade
                                <svg :class="{'rotate-180': openAccordion === 'shipping'}" class="w-5 h-5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div v-show="openAccordion === 'shipping'" class="pb-4 text-gray-600">
                                <p>Tüm Türkiye'ye ücretsiz kargo. Siparişiniz 3-5 iş günü içinde adresinize teslim edilir. 30 gün içinde koşulsuz iade hakkınız bulunmaktadır.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>