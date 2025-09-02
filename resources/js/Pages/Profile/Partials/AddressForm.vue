<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    address: {
        type: Object,
        default: null
    },
    show: {
        type: Boolean,
        default: false
    }
});

const emit = defineEmits(['close', 'saved']);

const form = useForm({
    title: props.address?.title || '',
    full_name: props.address?.full_name || '',
    phone: props.address?.phone || '',
    city: props.address?.city || '',
    district: props.address?.district || '',
    neighborhood: props.address?.neighborhood || '',
    address_line: props.address?.address_line || '',
    postal_code: props.address?.postal_code || '',
    type: props.address?.type || 'both',
    is_default: props.address?.is_default || false,
});

const submit = () => {
    const url = props.address 
        ? route('addresses.update', props.address.id)
        : route('addresses.store');
    
    const method = props.address ? 'put' : 'post';
    
    form[method](url, {
        preserveScroll: true,
        onSuccess: () => {
            emit('saved');
            emit('close');
        },
    });
};

const closeModal = () => {
    form.reset();
    form.clearErrors();
    emit('close');
};
</script>

<template>
    <div v-if="show" class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" @click="closeModal"></div>

            <!-- Modal panel -->
            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form @submit.prevent="submit" class="px-6 pt-5 pb-4">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">
                            {{ address ? 'Adresi Düzenle' : 'Yeni Adres Ekle' }}
                        </h3>
                        <p class="text-sm text-gray-600">Adres bilgilerinizi eksiksiz doldurun</p>
                    </div>

                    <div class="space-y-4">
                        <!-- Address Title -->
                        <div>
                            <InputLabel for="title" value="Adres Başlığı *" />
                            <TextInput
                                id="title"
                                v-model="form.title"
                                type="text"
                                class="block w-full mt-1"
                                placeholder="Ev, İş, Depo vb."
                                required
                            />
                            <InputError :message="form.errors.title" class="mt-2" />
                        </div>

                        <!-- Full Name -->
                        <div>
                            <InputLabel for="full_name" value="Ad Soyad *" />
                            <TextInput
                                id="full_name"
                                v-model="form.full_name"
                                type="text"
                                class="block w-full mt-1"
                                placeholder="Alıcının tam adı"
                                required
                            />
                            <InputError :message="form.errors.full_name" class="mt-2" />
                        </div>

                        <!-- Phone -->
                        <div>
                            <InputLabel for="phone" value="Telefon *" />
                            <TextInput
                                id="phone"
                                v-model="form.phone"
                                type="tel"
                                class="block w-full mt-1"
                                placeholder="0555 555 55 55"
                                required
                            />
                            <InputError :message="form.errors.phone" class="mt-2" />
                        </div>

                        <!-- City and District -->
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <InputLabel for="city" value="İl *" />
                                <TextInput
                                    id="city"
                                    v-model="form.city"
                                    type="text"
                                    class="block w-full mt-1"
                                    placeholder="İstanbul"
                                    required
                                />
                                <InputError :message="form.errors.city" class="mt-2" />
                            </div>
                            
                            <div>
                                <InputLabel for="district" value="İlçe *" />
                                <TextInput
                                    id="district"
                                    v-model="form.district"
                                    type="text"
                                    class="block w-full mt-1"
                                    placeholder="Kadıköy"
                                    required
                                />
                                <InputError :message="form.errors.district" class="mt-2" />
                            </div>
                        </div>

                        <!-- Neighborhood -->
                        <div>
                            <InputLabel for="neighborhood" value="Mahalle" />
                            <TextInput
                                id="neighborhood"
                                v-model="form.neighborhood"
                                type="text"
                                class="block w-full mt-1"
                                placeholder="Mahalle adı (opsiyonel)"
                            />
                            <InputError :message="form.errors.neighborhood" class="mt-2" />
                        </div>

                        <!-- Address Line -->
                        <div>
                            <InputLabel for="address_line" value="Adres *" />
                            <textarea
                                id="address_line"
                                v-model="form.address_line"
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                rows="3"
                                placeholder="Sokak, cadde, bina no, daire no"
                                required
                            ></textarea>
                            <InputError :message="form.errors.address_line" class="mt-2" />
                        </div>

                        <!-- Postal Code -->
                        <div>
                            <InputLabel for="postal_code" value="Posta Kodu" />
                            <TextInput
                                id="postal_code"
                                v-model="form.postal_code"
                                type="text"
                                class="block w-full mt-1"
                                placeholder="34000"
                                maxlength="5"
                            />
                            <InputError :message="form.errors.postal_code" class="mt-2" />
                        </div>

                        <!-- Address Type -->
                        <div>
                            <InputLabel value="Adres Tipi *" />
                            <div class="flex items-center space-x-4 mt-2">
                                <label class="flex items-center">
                                    <input
                                        v-model="form.type"
                                        type="radio"
                                        value="billing"
                                        class="text-blue-600 border-gray-300 focus:ring-blue-500"
                                    />
                                    <span class="ml-2 text-sm text-gray-700">Fatura Adresi</span>
                                </label>
                                <label class="flex items-center">
                                    <input
                                        v-model="form.type"
                                        type="radio"
                                        value="shipping"
                                        class="text-blue-600 border-gray-300 focus:ring-blue-500"
                                    />
                                    <span class="ml-2 text-sm text-gray-700">Teslimat Adresi</span>
                                </label>
                                <label class="flex items-center">
                                    <input
                                        v-model="form.type"
                                        type="radio"
                                        value="both"
                                        class="text-blue-600 border-gray-300 focus:ring-blue-500"
                                    />
                                    <span class="ml-2 text-sm text-gray-700">Her İkisi</span>
                                </label>
                            </div>
                            <InputError :message="form.errors.type" class="mt-2" />
                        </div>

                        <!-- Default Address -->
                        <div class="flex items-center">
                            <input
                                id="is_default"
                                v-model="form.is_default"
                                type="checkbox"
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            />
                            <InputLabel for="is_default" value="Varsayılan adres olarak ayarla" class="ml-2" />
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end px-6 py-3 mt-6 space-x-3 bg-gray-50 -mx-6 -mb-4 rounded-b-lg">
                        <SecondaryButton @click="closeModal" :disabled="form.processing">
                            İptal
                        </SecondaryButton>
                        <PrimaryButton :disabled="form.processing" class="px-6">
                            <svg v-if="form.processing" class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            {{ form.processing ? 'Kaydediliyor...' : (address ? 'Güncelle' : 'Kaydet') }}
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>