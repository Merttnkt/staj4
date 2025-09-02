<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import { MinusIcon, PlusIcon, TrashIcon, ShoppingCartIcon } from '@heroicons/vue/24/outline';

defineOptions({
    layout: AppLayout
});

const props = defineProps({
    cartItems: Array,
    total: Number
});

const loading = ref(false);

const formatPrice = (price) => {
    return new Intl.NumberFormat('tr-TR', { 
        style: 'currency', 
        currency: 'TRY',
        minimumFractionDigits: 0
    }).format(price);
};

const updateQuantity = async (cartItem, newQuantity) => {
    if (newQuantity < 1 || newQuantity > 10) return;
    
    loading.value = true;
    
    try {
        const response = await fetch(route('cart.update', cartItem.id), {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
            },
            body: JSON.stringify({ quantity: newQuantity })
        });

        const result = await response.json();
        
        if (result.success) {
            router.reload({ only: ['cartItems', 'total'] });
        }
    } catch (error) {
    } finally {
        loading.value = false;
    }
};

const removeItem = async (cartItem) => {
    if (!confirm('Bu ürünü sepetten kaldırmak istediğinizden emin misiniz?')) return;
    
    loading.value = true;
    
    try {
        const response = await fetch(route('cart.remove', cartItem.id), {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
            }
        });

        const result = await response.json();
        
        if (result.success) {
            router.reload({ only: ['cartItems', 'total'] });
        }
    } catch (error) {
    } finally {
        loading.value = false;
    }
};

const clearCart = async () => {
    if (!confirm('Sepeti tamamen temizlemek istediğinizden emin misiniz?')) return;
    
    loading.value = true;
    
    try {
        const response = await fetch(route('cart.clear'), {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
            }
        });

        const result = await response.json();
        
        if (result.success) {
            router.reload({ only: ['cartItems', 'total'] });
        }
    } catch (error) {
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <Head title="Sepetim - Markanız Mobilya" />

    <div class="container mx-auto px-6 py-8">
        <div class="flex items-center space-x-2 mb-8">
            <ShoppingCartIcon class="w-8 h-8 text-gray-700" />
            <h1 class="text-3xl font-bold text-gray-900">Sepetim</h1>
        </div>

        <!-- Empty Cart -->
        <div v-if="cartItems.length === 0" class="text-center py-16">
            <ShoppingCartIcon class="w-24 h-24 text-gray-300 mx-auto mb-6" />
            <h2 class="text-2xl font-semibold text-gray-600 mb-4">Sepetiniz Boş</h2>
            <p class="text-gray-500 mb-8">Henüz sepetinize ürün eklemediniz. Alışverişe başlamak için ürünlerimizi inceleyin.</p>
            <Link :href="route('products.index')"
                  class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                Ürünleri İncele
            </Link>
        </div>

        <!-- Cart Items -->
        <div v-else class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items List -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                        <h2 class="text-lg font-semibold text-gray-900">Ürünler ({{ cartItems.length }})</h2>
                        <button @click="clearCart" :disabled="loading"
                                class="text-red-600 hover:text-red-800 text-sm font-medium disabled:opacity-50">
                            Sepeti Temizle
                        </button>
                    </div>
                    
                    <div class="divide-y divide-gray-200">
                        <div v-for="item in cartItems" :key="item.id" class="p-6">
                            <div class="flex items-start space-x-4">
                                <!-- Product Image -->
                                <div class="flex-shrink-0">
                                    <img :src="item.product.image_url" 
                                         :alt="item.product.name"
                                         class="w-20 h-20 object-cover rounded-lg border border-gray-200">
                                </div>
                                
                                <!-- Product Details -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <Link :href="route('product.show', item.product.slug)"
                                                  class="text-lg font-medium text-gray-900 hover:text-blue-600 block">
                                                {{ item.product.name }}
                                            </Link>
                                            <p class="text-sm text-gray-500 mt-1">{{ item.product.category.name }}</p>
                                            <p class="text-lg font-semibold text-gray-900 mt-2">
                                                {{ formatPrice(item.product.price) }}
                                            </p>
                                        </div>
                                        
                                        <!-- Remove Button -->
                                        <button @click="removeItem(item)" :disabled="loading"
                                                class="text-red-600 hover:text-red-800 p-2 rounded-md hover:bg-red-50 transition-colors disabled:opacity-50">
                                            <TrashIcon class="w-5 h-5" />
                                        </button>
                                    </div>
                                    
                                    <!-- Quantity Controls -->
                                    <div class="flex items-center space-x-3 mt-4">
                                        <span class="text-sm text-gray-600">Adet:</span>
                                        <div class="flex items-center border border-gray-300 rounded-md">
                                            <button @click="updateQuantity(item, item.quantity - 1)"
                                                    :disabled="item.quantity <= 1 || loading"
                                                    class="p-2 hover:bg-gray-100 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                                <MinusIcon class="w-4 h-4" />
                                            </button>
                                            <span class="px-4 py-2 text-center min-w-[60px] border-x border-gray-300">
                                                {{ item.quantity }}
                                            </span>
                                            <button @click="updateQuantity(item, item.quantity + 1)"
                                                    :disabled="item.quantity >= 10 || loading"
                                                    class="p-2 hover:bg-gray-100 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                                                <PlusIcon class="w-4 h-4" />
                                            </button>
                                        </div>
                                        <span class="text-sm text-gray-500">(Max: 10 adet)</span>
                                    </div>
                                    
                                    <!-- Item Total -->
                                    <div class="mt-3">
                                        <span class="text-sm text-gray-600">Toplam: </span>
                                        <span class="text-lg font-semibold text-gray-900">
                                            {{ formatPrice(item.quantity * item.product.price) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 sticky top-4">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Sipariş Özeti</h2>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Ara Toplam</span>
                                <span class="font-medium">{{ formatPrice(total) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Kargo</span>
                                <span class="font-medium text-green-600">Ücretsiz</span>
                            </div>
                            <hr class="my-4">
                            <div class="flex justify-between text-lg font-semibold">
                                <span>Toplam</span>
                                <span>{{ formatPrice(total) }}</span>
                            </div>
                        </div>

                        <div class="mt-6 space-y-3">
                            <button v-if="$page.props.auth.user"
                                    class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                                Siparişi Tamamla
                            </button>
                            <div v-else class="text-center space-y-3">
                                <p class="text-sm text-gray-600">Sipariş vermek için giriş yapmalısınız</p>
                                <Link :href="route('login')"
                                      class="w-full inline-block bg-blue-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-blue-700 transition-colors text-center">
                                    Giriş Yap
                                </Link>
                            </div>

                            <Link :href="route('products.index')"
                                  class="w-full border border-gray-300 text-gray-700 py-3 px-4 rounded-lg font-medium hover:bg-gray-50 transition-colors text-center block">
                                Alışverişe Devam Et
                            </Link>
                        </div>

                        <div class="mt-6 text-xs text-gray-500 space-y-1">
                            <p>• Ücretsiz kargo</p>
                            <p>• Güvenli ödeme</p>
                            <p>• 14 gün iade garantisi</p>
                            <p>• 2 yıl garanti</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>