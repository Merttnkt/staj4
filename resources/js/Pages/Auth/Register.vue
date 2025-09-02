<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    first_name: '',
    last_name: '',
    store_name: '',
    phone: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Kayıt Ol - Markanız Mobilya" />

        <div class="mb-6 text-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Hesap Oluşturun</h1>
            <p class="text-gray-600">Markanız Mobilya'ya hoş geldiniz! Alışverişe başlamak için kayıt olun.</p>
        </div>

        <form @submit.prevent="submit" class="space-y-6">
            <!-- Müşteri Adı -->
            <div>
                <InputLabel for="name" value="Müşteri Adı / Kullanıcı Adı *" />
                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="Örnek: ahmet_mobilya"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Ad -->
                <div>
                    <InputLabel for="first_name" value="Adınız *" />
                    <TextInput
                        id="first_name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.first_name"
                        required
                        autocomplete="given-name"
                        placeholder="Adınız"
                    />
                    <InputError class="mt-2" :message="form.errors.first_name" />
                </div>

                <!-- Soyad -->
                <div>
                    <InputLabel for="last_name" value="Soyadınız *" />
                    <TextInput
                        id="last_name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.last_name"
                        required
                        autocomplete="family-name"
                        placeholder="Soyadınız"
                    />
                    <InputError class="mt-2" :message="form.errors.last_name" />
                </div>
            </div>

            <!-- Mağaza Adı -->
            <div>
                <InputLabel for="store_name" value="Mağaza / Firma Adı" />
                <TextInput
                    id="store_name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.store_name"
                    autocomplete="organization"
                    placeholder="Opsiyonel - Mağaza veya firma adınız"
                />
                <InputError class="mt-2" :message="form.errors.store_name" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Telefon -->
                <div>
                    <InputLabel for="phone" value="Telefon Numarası *" />
                    <TextInput
                        id="phone"
                        type="tel"
                        class="mt-1 block w-full"
                        v-model="form.phone"
                        required
                        autocomplete="tel"
                        placeholder="0532 123 45 67"
                    />
                    <InputError class="mt-2" :message="form.errors.phone" />
                </div>

                <!-- Email -->
                <div>
                    <InputLabel for="email" value="E-posta Adresi *" />
                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autocomplete="email"
                        placeholder="ornek@email.com"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Şifre -->
                <div>
                    <InputLabel for="password" value="Şifre *" />
                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                        placeholder="En az 8 karakter"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <!-- Şifre Tekrar -->
                <div>
                    <InputLabel for="password_confirmation" value="Şifre Tekrar *" />
                    <TextInput
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="Şifrenizi tekrar girin"
                    />
                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>
            </div>


            <div class="flex items-center justify-between pt-4">
                <Link
                    :href="route('login')"
                    class="text-sm text-gray-600 hover:text-gray-900 underline"
                >
                    Zaten hesabınız var mı? Giriş yapın
                </Link>

                <PrimaryButton
                    class="px-8 py-3 text-lg"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Hesap Oluştur
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
