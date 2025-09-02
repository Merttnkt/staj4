<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Giriş Yap - Markanız Mobilya" />

        <div class="mb-6 text-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Giriş Yapın</h1>
            <p class="text-gray-600">Hesabınıza giriş yaparak alışverişe devam edin.</p>
        </div>

        <div v-if="$page.props.flash?.success" class="mb-4 text-sm font-medium text-green-600 bg-green-50 border border-green-200 rounded-md p-3">
            {{ $page.props.flash.success }}
        </div>

        <form @submit.prevent="submit" class="space-y-6">
            <div>
                <InputLabel for="email" value="E-posta Adresi" />
                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                    placeholder="ornek@email.com"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div>
                <InputLabel for="password" value="Şifre" />
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    placeholder="Şifrenizi girin"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="flex items-center">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ms-2 text-sm text-gray-600">Beni hatırla</span>
                </label>
            </div>

            <div class="mt-4 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <Link
                        :href="route('register')"
                        class="text-sm text-blue-600 hover:text-blue-900 underline font-medium"
                    >
                        Hesap oluşturun
                    </Link>
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                    >
                        Şifrenizi mi unuttunuz?
                    </Link>
                </div>

                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Giriş Yap
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
