<template>
    <Head title="İletişim - Markanız Mobilya" />

    <AppLayout>
        
        <section class="relative w-full h-96 bg-gray-200">
            <img 
                src="/images/hero/hero-bg.jpg" 
                alt="Modern ve konforlu bahçe mobilyaları" 
                class="absolute inset-0 w-full h-full object-cover"
            >
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-4">
                <h1 class="text-white text-4xl md:text-5xl font-extrabold leading-tight">
                    Bize Ulaşın
                </h1>
                <p class="text-white mt-4 max-w-xl">
                    Sorularınız, önerileriniz veya işbirliği talepleriniz için bizimle iletişime geçmekten çekinmeyin.
                </p>
            </div>
        </section>

        <section class="bg-slate-50">
            <div class="container mx-auto px-6 py-20">
                <div class="max-w-7xl mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        
                        <div class="bg-white p-8 rounded-lg shadow-lg space-y-8" data-aos="fade-right">
                            <h3 class="text-3xl font-poppins font-bold text-gray-800">İletişim Bilgileri</h3>
                            
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="bg-blue-100 text-blue-600 rounded-full w-12 h-12 flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-poppins font-semibold text-gray-800">Adres</h4>
                                    <p class="text-gray-600">{{ settings?.address }}</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="bg-blue-100 text-blue-600 rounded-full w-12 h-12 flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-poppins font-semibold text-gray-800">Telefon</h4>
                                    <p class="text-gray-600">{{ settings?.phone }}</p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div class="bg-blue-100 text-blue-600 rounded-full w-12 h-12 flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-poppins font-semibold text-gray-800">E-posta</h4>
                                    <p class="text-gray-600">{{ settings?.email }}</p>
                                </div>
                            </div>
                            
                            <div class="pt-4 border-t border-gray-200">
                                <h4 class="text-lg font-poppins font-semibold text-gray-800 mb-4">Bizi Takip Edin</h4>
                                <div class="flex space-x-4">
                                    <a :href="settings?.facebook_url" class="text-gray-500 hover:text-blue-700 transition-transform duration-300 transform hover:scale-110">
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                                    </a>
                                    <a :href="settings?.twitter_url" class="text-gray-500 hover:text-blue-400 transition-transform duration-300 transform hover:scale-110">
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.71v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                                    </a>
                                    <a :href="settings?.instagram_url" class="text-gray-500 hover:text-pink-600 transition-transform duration-300 transform hover:scale-110">
                                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.024.06 1.378.06 3.808s-.012 2.784-.06 3.808c-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.024.048-1.378.06-3.808.06s-2.784-.013-3.808-.06c-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.048-1.024-.06-1.378-.06-3.808s.012-2.784.06-3.808c.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 016.08 2.525c.636-.247 1.363-.416 2.427-.465C9.53 2.013 9.884 2 12.315 2zM12 7a5 5 0 100 10 5 5 0 000-10zm0 8a3 3 0 110-6 3 3 0 010 6zm6.406-11.845a1.25 1.25 0 100 2.5 1.25 1.25 0 000-2.5z" clip-rule="evenodd" /></svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <form @submit.prevent="submit" class="space-y-6 bg-white p-8 rounded-lg shadow-lg" data-aos="fade-left" data-aos-delay="100">
                            <div v-if="successMessage" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                                <strong class="font-bold">Success!</strong>
                                <span class="block sm:inline">{{ successMessage }}</span>
                            </div>
                            <h3 class="text-3xl font-poppins font-bold text-gray-800">Mesaj Gönderin</h3>
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Adınız</label>
                                <input type="text" id="name" name="name" v-model="form.name" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">E-posta Adresiniz</label>
                                <input type="email" id="email" name="email" v-model="form.email" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700">Mesajınız</label>
                                <textarea id="message" name="message" rows="4" v-model="form.message" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                                <InputError class="mt-2" :message="form.errors.message" />
                            </div>
                            <div>
                                <button type="submit" :disabled="form.processing" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Gönder
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Google Maps Section - Düzeltilmiş -->
        <section class="w-full" data-aos="fade-in">
            <div v-if="settings?.map_src" class="w-full h-96">
                <iframe 
                    :src="settings.map_src" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade"
                    class="w-full h-full"
                ></iframe>
            </div>
            
            <!-- Alternatif: Eğer map_src yoksa varsayılan harita -->
            <div v-else class="w-full h-96 bg-gray-200 flex items-center justify-center">
                <div class="text-center">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <p class="text-gray-500">Harita yükleniyor...</p>
                </div>
            </div>
        </section>

    </AppLayout>
</template>

<script setup>
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';

defineProps({ settings: Object });

const page = usePage();

const form = useForm({
    name: '',
    email: '',
    message: '',
});

const successMessage = computed(() => page.props.flash?.success);

const submit = () => {
    form.post(route('contact.store'), {
        onFinish: () => form.reset(),
    });
};

console.log('Settings:', page.props.settings);
</script>