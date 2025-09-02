<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const activeTab = ref('profile');

const tabs = [
    { id: 'profile', name: 'Profil Bilgileri', icon: 'user' },
    { id: 'password', name: 'Şifre Değiştir', icon: 'lock' },
    { id: 'addresses', name: 'Adreslerim', icon: 'location' },
    { id: 'orders', name: 'Siparişlerim', icon: 'shopping-bag' },
    { id: 'favorites', name: 'Favorilerim', icon: 'heart' },
    { id: 'settings', name: 'Hesap Ayarları', icon: 'settings' }
];

const setActiveTab = (tabId) => {
    activeTab.value = tabId;
};
</script>

<template>
    <Head title="Hesabım - Markanız Mobilya" />

    <AppLayout>
        <div class="bg-gray-50 min-h-screen py-8">
            <div class="container mx-auto px-4">
                <!-- Page Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Hesabım</h1>
                    <p class="text-gray-600">Profil bilgilerinizi yönetin ve hesap ayarlarınızı düzenleyin</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                    <!-- Sidebar Navigation -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <nav class="space-y-2">
                                <button 
                                    v-for="tab in tabs" 
                                    :key="tab.id"
                                    @click="setActiveTab(tab.id)"
                                    :class="[
                                        'w-full flex items-center px-4 py-3 text-left rounded-md transition-colors duration-200',
                                        activeTab === tab.id 
                                            ? 'bg-blue-50 text-blue-600 border-l-4 border-blue-600' 
                                            : 'text-gray-700 hover:bg-gray-50'
                                    ]"
                                >
                                    <svg v-if="tab.icon === 'user'" class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <svg v-else-if="tab.icon === 'lock'" class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                    <svg v-else-if="tab.icon === 'location'" class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <svg v-else-if="tab.icon === 'shopping-bag'" class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l-1 12H6L5 9z"></path>
                                    </svg>
                                    <svg v-else-if="tab.icon === 'heart'" class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                    <svg v-else-if="tab.icon === 'settings'" class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="font-medium">{{ tab.name }}</span>
                                </button>
                            </nav>
                        </div>
                    </div>

                    <!-- Main Content -->
                    <div class="lg:col-span-3">
                        <div class="bg-white rounded-lg shadow-sm">
                            
                            <!-- Profile Information Tab -->
                            <div v-show="activeTab === 'profile'" class="p-6">
                                <div class="border-b border-gray-200 pb-4 mb-6">
                                    <h2 class="text-2xl font-semibold text-gray-900">Profil Bilgileri</h2>
                                    <p class="text-gray-600 mt-1">Hesap bilgilerinizi güncelleyin</p>
                                </div>
                                <UpdateProfileInformationForm
                                    :must-verify-email="mustVerifyEmail"
                                    :status="status"
                                />
                            </div>

                            <!-- Password Tab -->
                            <div v-show="activeTab === 'password'" class="p-6">
                                <div class="border-b border-gray-200 pb-4 mb-6">
                                    <h2 class="text-2xl font-semibold text-gray-900">Şifre Güvenliği</h2>
                                    <p class="text-gray-600 mt-1">Hesabınızın güvenliği için düzenli olarak şifrenizi değiştirin</p>
                                </div>
                                <UpdatePasswordForm />
                            </div>

                            <!-- Addresses Tab -->
                            <div v-show="activeTab === 'addresses'" class="p-6">
                                <div class="border-b border-gray-200 pb-4 mb-6">
                                    <h2 class="text-2xl font-semibold text-gray-900">Adreslerim</h2>
                                    <p class="text-gray-600 mt-1">Teslimat ve fatura adreslerinizi yönetin</p>
                                </div>
                                <div class="text-center py-12">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">Henüz adres eklenmemiş</h3>
                                    <p class="mt-1 text-sm text-gray-500">Teslimat için yeni bir adres ekleyin</p>
                                    <div class="mt-6">
                                        <button class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                            Yeni Adres Ekle
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Orders Tab -->
                            <div v-show="activeTab === 'orders'" class="p-6">
                                <div class="border-b border-gray-200 pb-4 mb-6">
                                    <h2 class="text-2xl font-semibold text-gray-900">Siparişlerim</h2>
                                    <p class="text-gray-600 mt-1">Geçmiş siparişlerinizi görüntüleyin</p>
                                </div>
                                <div class="text-center py-12">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l-1 12H6L5 9z"></path>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">Henüz sipariş vermediniz</h3>
                                    <p class="mt-1 text-sm text-gray-500">Alışverişe başlamak için ürünlerimizi inceleyin</p>
                                    <div class="mt-6">
                                        <a href="/products" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                            Alışverişe Başla
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Favorites Tab -->
                            <div v-show="activeTab === 'favorites'" class="p-6">
                                <div class="border-b border-gray-200 pb-4 mb-6">
                                    <h2 class="text-2xl font-semibold text-gray-900">Favorilerim</h2>
                                    <p class="text-gray-600 mt-1">Beğendiğiniz ürünleri buradan takip edin</p>
                                </div>
                                <div class="text-center py-12">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">Henüz favori ürününüz yok</h3>
                                    <p class="mt-1 text-sm text-gray-500">Beğendiğiniz ürünleri favorilerinize ekleyin</p>
                                    <div class="mt-6">
                                        <a href="/products" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                            Ürünleri İncele
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Settings Tab -->
                            <div v-show="activeTab === 'settings'" class="p-6">
                                <div class="border-b border-gray-200 pb-4 mb-6">
                                    <h2 class="text-2xl font-semibold text-gray-900">Hesap Ayarları</h2>
                                    <p class="text-gray-600 mt-1">Hesabınızı yönetin ve güvenlik ayarlarınızı yapın</p>
                                </div>
                                
                                <!-- Account Actions -->
                                <div class="space-y-6">
                                    <!-- Email Notifications -->
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <h3 class="text-lg font-medium text-gray-900 mb-2">Bildirim Tercihleri</h3>
                                        <div class="space-y-3">
                                            <label class="flex items-center">
                                                <input type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" checked>
                                                <span class="ml-2 text-sm text-gray-700">Sipariş durumu güncellemeleri</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" checked>
                                                <span class="ml-2 text-sm text-gray-700">Yeni ürün bildirimleri</span>
                                            </label>
                                            <label class="flex items-center">
                                                <input type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                                <span class="ml-2 text-sm text-gray-700">Promosyon ve indirim bildirimleri</span>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Danger Zone -->
                                    <div class="border border-red-200 rounded-lg p-4">
                                        <h3 class="text-lg font-medium text-red-900 mb-4">Tehlikeli İşlemler</h3>
                                        <DeleteUserForm />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
