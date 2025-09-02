<script setup>
import AdminLayout from '@/Layouts/AdminLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    settings: Object,
});

const form = useForm({
    address: props.settings?.address || '',
    phone: props.settings?.phone || '',
    email: props.settings?.email || '',
    map_src: props.settings?.map_src || '',
    facebook_url: props.settings?.facebook_url || '',
    instagram_url: props.settings?.instagram_url || '',
    twitter_url: props.settings?.twitter_url || '',
    linkedin_url: props.settings?.linkedin_url || '',
});

const submit = () => {
    form.post(route('admin.settings.contact.store'), {
        preserveScroll: true,
    });
};

defineOptions({
  layout: AdminLayout,
});
</script>

<template>
    <Head title="İletişim Ayarları" />

    <form @submit.prevent="submit">
        <div class="space-y-10">
            <div class="flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-800">İletişim Sayfası Ayarları</h1>
                <PrimaryButton :disabled="form.processing">
                    <span v-if="form.processing">Kaydediliyor...</span>
                    <span v-else>Ayarları Kaydet</span>
                </PrimaryButton>
            </div>

            <div v-if="form.wasSuccessful" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p class="font-bold">Başarılı!</p>
                <p>Ayarlar başarıyla kaydedildi.</p>
            </div>

            <!-- Section: Contact Information -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <div class="lg:col-span-1">
                    <h2 class="text-xl font-semibold text-gray-700">İletişim Bilgileri</h2>
                    <p class="mt-1 text-sm text-gray-500">
                        İletişim kartında ve haritada gösterilecek temel bilgiler.
                    </p>
                </div>
                <div class="lg:col-span-2">
                    <div class="bg-white p-6 rounded-lg shadow-md space-y-6">
                        <div>
                            <InputLabel for="address" value="Adres" />
                            <textarea id="address" v-model="form.address" rows="3" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Markanız Mobilya A.Ş.&#10;Mobilya Caddesi No: 123&#10;34000, İstanbul, Türkiye"></textarea>
                        </div>
                        <div>
                            <InputLabel for="phone" value="Telefon Numarası" />
                            <TextInput id="phone" type="text" v-model="form.phone" class="mt-1 block w-full" placeholder="+90 212 123 45 67" />
                        </div>
                        <div>
                            <InputLabel for="email" value="E-posta Adresi" />
                            <TextInput id="email" type="email" v-model="form.email" class="mt-1 block w-full" placeholder="info@markanizmobilya.com" />
                        </div>
                        <div>
                            <InputLabel for="map_src" value="Google Maps Gömme Kodu (src)" />
                            <TextInput id="map_src" type="text" v-model="form.map_src" class="mt-1 block w-full" placeholder="Örnek: https://www.google.com/maps/embed?pb=..." />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section: Social Media -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <div class="lg:col-span-1">
                    <h2 class="text-xl font-semibold text-gray-700">Sosyal Medya Hesapları</h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Sitenizin alt kısmında görünecek sosyal medya profil URL'leri.
                    </p>
                </div>
                <div class="lg:col-span-2">
                    <div class="bg-white p-6 rounded-lg shadow-md space-y-6">
                        <div>
                            <InputLabel for="facebook_url" value="Facebook URL" />
                            <TextInput id="facebook_url" type="url" v-model="form.facebook_url" class="mt-1 block w-full" placeholder="https://facebook.com/kullaniciadiniz" />
                        </div>
                        <div>
                            <InputLabel for="instagram_url" value="Instagram URL" />
                            <TextInput id="instagram_url" type="url" v-model="form.instagram_url" class="mt-1 block w-full" placeholder="https://instagram.com/kullaniciadiniz" />
                        </div>
                        <div>
                            <InputLabel for="twitter_url" value="X (Twitter) URL" />
                            <TextInput id="twitter_url" type="url" v-model="form.twitter_url" class="mt-1 block w-full" placeholder="https://x.com/kullaniciadiniz" />
                        </div>
                         <div>
                            <InputLabel for="linkedin_url" value="LinkedIn URL" />
                            <TextInput id="linkedin_url" type="url" v-model="form.linkedin_url" class="mt-1 block w-full" placeholder="https://linkedin.com/in/kullaniciadiniz" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Button -->
            <div class="flex justify-end">
                <PrimaryButton :disabled="form.processing">
                    <span v-if="form.processing">Kaydediliyor...</span>
                    <span v-else>Ayarları Kaydet</span>
                </PrimaryButton>
            </div>
        </div>
    </form>
</template>
