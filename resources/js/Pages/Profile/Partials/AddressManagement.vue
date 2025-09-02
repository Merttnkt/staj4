<script setup>
import AddressForm from './AddressForm.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { ref, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';

const addresses = ref([]);
const showAddressForm = ref(false);
const editingAddress = ref(null);
const loading = ref(true);

const loadAddresses = async () => {
    try {
        const response = await fetch(route('addresses.index'));
        addresses.value = await response.json();
    } catch (error) {
        console.error('Adresler yüklenirken hata oluştu:', error);
    } finally {
        loading.value = false;
    }
};

const openAddForm = () => {
    editingAddress.value = null;
    showAddressForm.value = true;
};

const openEditForm = (address) => {
    editingAddress.value = address;
    showAddressForm.value = true;
};

const closeForm = () => {
    showAddressForm.value = false;
    editingAddress.value = null;
};

const onAddressSaved = () => {
    loadAddresses();
};

const deleteAddress = async (addressId) => {
    if (!confirm('Bu adresi silmek istediğinizden emin misiniz?')) {
        return;
    }

    try {
        const response = await fetch(route('addresses.destroy', addressId), {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        });

        if (response.ok) {
            loadAddresses();
        } else {
            alert('Adres silinirken bir hata oluştu.');
        }
    } catch (error) {
        console.error('Adres silinirken hata:', error);
        alert('Adres silinirken bir hata oluştu.');
    }
};

const setDefaultAddress = async (addressId) => {
    try {
        const response = await fetch(route('addresses.set-default', addressId), {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        });

        if (response.ok) {
            loadAddresses();
        } else {
            alert('Varsayılan adres ayarlanırken bir hata oluştu.');
        }
    } catch (error) {
        console.error('Varsayılan adres ayarlanırken hata:', error);
        alert('Varsayılan adres ayarlanırken bir hata oluştu.');
    }
};

const getAddressTypeLabel = (type) => {
    switch (type) {
        case 'billing': return 'Fatura Adresi';
        case 'shipping': return 'Teslimat Adresi';
        case 'both': return 'Her İkisi';
        default: return type;
    }
};

const getAddressTypeColor = (type) => {
    switch (type) {
        case 'billing': return 'bg-yellow-100 text-yellow-800';
        case 'shipping': return 'bg-green-100 text-green-800';
        case 'both': return 'bg-blue-100 text-blue-800';
        default: return 'bg-gray-100 text-gray-800';
    }
};

onMounted(() => {
    loadAddresses();
});
</script>

<template>
    <div>
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <div>
                <p class="text-sm text-gray-600">
                    Teslimat ve fatura adreslerinizi yönetin
                </p>
            </div>
            <PrimaryButton @click="openAddForm" class="flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Yeni Adres Ekle
            </PrimaryButton>
        </div>

        <!-- Loading State -->
        <div v-if="loading" class="flex justify-center py-12">
            <div class="flex items-center text-gray-500">
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Adresler yükleniyor...
            </div>
        </div>

        <!-- Empty State -->
        <div v-else-if="addresses.length === 0" class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Henüz adres eklenmemiş</h3>
            <p class="mt-1 text-sm text-gray-500">Teslimat için yeni bir adres ekleyin</p>
            <div class="mt-6">
                <PrimaryButton @click="openAddForm" class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    İlk Adresinizi Ekleyin
                </PrimaryButton>
            </div>
        </div>

        <!-- Address List -->
        <div v-else class="grid gap-4">
            <div
                v-for="address in addresses"
                :key="address.id"
                class="bg-white border border-gray-200 rounded-lg p-6 hover:border-gray-300 transition-colors"
            >
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <!-- Address Header -->
                        <div class="flex items-center space-x-3 mb-3">
                            <h3 class="text-lg font-medium text-gray-900">{{ address.title }}</h3>
                            
                            <!-- Default Badge -->
                            <span v-if="address.is_default" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Varsayılan
                            </span>
                            
                            <!-- Type Badge -->
                            <span :class="['inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium', getAddressTypeColor(address.type)]">
                                {{ getAddressTypeLabel(address.type) }}
                            </span>
                        </div>

                        <!-- Address Details -->
                        <div class="text-sm text-gray-600 space-y-1">
                            <p class="font-medium text-gray-900">{{ address.full_name }}</p>
                            <p>{{ address.phone }}</p>
                            <p>{{ address.address_line }}</p>
                            <p>
                                {{ address.neighborhood ? address.neighborhood + ', ' : '' }}{{ address.district }}, {{ address.city }}
                                {{ address.postal_code ? ' ' + address.postal_code : '' }}
                            </p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center space-x-2 ml-4">
                        <SecondaryButton
                            v-if="!address.is_default"
                            @click="setDefaultAddress(address.id)"
                            class="text-xs px-3 py-1"
                        >
                            Varsayılan Yap
                        </SecondaryButton>
                        
                        <SecondaryButton
                            @click="openEditForm(address)"
                            class="text-xs px-3 py-1"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </SecondaryButton>
                        
                        <button
                            @click="deleteAddress(address.id)"
                            class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Address Form Modal -->
        <AddressForm
            :show="showAddressForm"
            :address="editingAddress"
            @close="closeForm"
            @saved="onAddressSaved"
        />
    </div>
</template>