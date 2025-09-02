<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);
const showCurrentPassword = ref(false);
const showNewPassword = ref(false);
const showConfirmPassword = ref(false);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const passwordStrength = computed(() => {
    const password = form.password;
    if (!password) return { score: 0, text: '', color: '' };
    
    let score = 0;
    if (password.length >= 8) score++;
    if (/[a-z]/.test(password)) score++;
    if (/[A-Z]/.test(password)) score++;
    if (/[0-9]/.test(password)) score++;
    if (/[^A-Za-z0-9]/.test(password)) score++;
    
    const levels = [
        { score: 0, text: '', color: '' },
        { score: 1, text: 'Çok Zayıf', color: 'text-red-600 bg-red-100' },
        { score: 2, text: 'Zayıf', color: 'text-orange-600 bg-orange-100' },
        { score: 3, text: 'Orta', color: 'text-yellow-600 bg-yellow-100' },
        { score: 4, text: 'Güçlü', color: 'text-green-600 bg-green-100' },
        { score: 5, text: 'Çok Güçlü', color: 'text-green-700 bg-green-200' }
    ];
    
    return levels[score] || levels[0];
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section>
        <form @submit.prevent="updatePassword" class="space-y-6">
            
            <!-- Current Password -->
            <div>
                <InputLabel for="current_password" value="Mevcut Şifreniz" />
                <div class="relative mt-1">
                    <TextInput
                        id="current_password"
                        ref="currentPasswordInput"
                        v-model="form.current_password"
                        :type="showCurrentPassword ? 'text' : 'password'"
                        class="block w-full pr-10"
                        autocomplete="current-password"
                        placeholder="Mevcut şifrenizi girin"
                    />
                    <button
                        type="button"
                        @click="showCurrentPassword = !showCurrentPassword"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600"
                    >
                        <svg v-if="!showCurrentPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <svg v-else class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                        </svg>
                    </button>
                </div>
                <InputError :message="form.errors.current_password" class="mt-2" />
            </div>

            <!-- New Password -->
            <div>
                <InputLabel for="password" value="Yeni Şifre" />
                <div class="relative mt-1">
                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        :type="showNewPassword ? 'text' : 'password'"
                        class="block w-full pr-10"
                        autocomplete="new-password"
                        placeholder="En az 8 karakterli güçlü bir şifre seçin"
                    />
                    <button
                        type="button"
                        @click="showNewPassword = !showNewPassword"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600"
                    >
                        <svg v-if="!showNewPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <svg v-else class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Password Strength Indicator -->
                <div v-if="form.password && passwordStrength.text" class="mt-2">
                    <div class="flex items-center space-x-2">
                        <div class="flex-1 bg-gray-200 rounded-full h-2">
                            <div 
                                class="h-2 rounded-full transition-all duration-300"
                                :class="{
                                    'bg-red-500 w-1/5': passwordStrength.score === 1,
                                    'bg-orange-500 w-2/5': passwordStrength.score === 2,
                                    'bg-yellow-500 w-3/5': passwordStrength.score === 3,
                                    'bg-green-500 w-4/5': passwordStrength.score === 4,
                                    'bg-green-600 w-full': passwordStrength.score === 5
                                }"
                            ></div>
                        </div>
                        <span 
                            class="text-xs px-2 py-1 rounded-full font-medium"
                            :class="passwordStrength.color"
                        >
                            {{ passwordStrength.text }}
                        </span>
                    </div>
                </div>

                <!-- Password Requirements -->
                <div class="mt-3 text-xs text-gray-600">
                    <p class="mb-1">Güçlü bir şifre için:</p>
                    <ul class="space-y-1 ml-4">
                        <li class="flex items-center" :class="form.password.length >= 8 ? 'text-green-600' : 'text-gray-500'">
                            <svg class="w-3 h-3 mr-2" :class="form.password.length >= 8 ? 'text-green-500' : 'text-gray-400'" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            En az 8 karakter
                        </li>
                        <li class="flex items-center" :class="/[A-Z]/.test(form.password) ? 'text-green-600' : 'text-gray-500'">
                            <svg class="w-3 h-3 mr-2" :class="/[A-Z]/.test(form.password) ? 'text-green-500' : 'text-gray-400'" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Büyük harf (A-Z)
                        </li>
                        <li class="flex items-center" :class="/[0-9]/.test(form.password) ? 'text-green-600' : 'text-gray-500'">
                            <svg class="w-3 h-3 mr-2" :class="/[0-9]/.test(form.password) ? 'text-green-500' : 'text-gray-400'" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Rakam (0-9)
                        </li>
                    </ul>
                </div>

                <InputError :message="form.errors.password" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <InputLabel for="password_confirmation" value="Yeni Şifre Tekrar" />
                <div class="relative mt-1">
                    <TextInput
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        :type="showConfirmPassword ? 'text' : 'password'"
                        class="block w-full pr-10"
                        autocomplete="new-password"
                        placeholder="Yeni şifrenizi tekrar girin"
                    />
                    <button
                        type="button"
                        @click="showConfirmPassword = !showConfirmPassword"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600"
                    >
                        <svg v-if="!showConfirmPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <svg v-else class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                        </svg>
                    </button>
                </div>

                <!-- Password Match Indicator -->
                <div v-if="form.password_confirmation && form.password" class="mt-2">
                    <div 
                        class="flex items-center text-xs px-2 py-1 rounded"
                        :class="form.password === form.password_confirmation ? 'text-green-700 bg-green-50' : 'text-red-700 bg-red-50'"
                    >
                        <svg 
                            class="w-4 h-4 mr-1" 
                            :class="form.password === form.password_confirmation ? 'text-green-500' : 'text-red-500'"
                            fill="currentColor" 
                            viewBox="0 0 20 20"
                        >
                            <path v-if="form.password === form.password_confirmation" fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            <path v-else fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                        {{ form.password === form.password_confirmation ? 'Şifreler eşleşiyor' : 'Şifreler eşleşmiyor' }}
                    </div>
                </div>

                <InputError :message="form.errors.password_confirmation" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between pt-4">
                <div class="text-sm text-gray-600">
                    <p>💡 <strong>İpucu:</strong> Güçlü şifreler hesabınızı daha güvenli hale getirir</p>
                </div>
                
                <div class="flex items-center gap-4">
                    <Transition
                        enter-active-class="transition ease-in-out duration-300"
                        enter-from-class="opacity-0 scale-95"
                        enter-to-class="opacity-100 scale-100"
                        leave-active-class="transition ease-in-out duration-300"
                        leave-from-class="opacity-100 scale-100"
                        leave-to-class="opacity-0 scale-95"
                    >
                        <div
                            v-if="form.recentlySuccessful"
                            class="flex items-center text-sm text-green-600 bg-green-50 px-3 py-2 rounded-md"
                        >
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            Şifreniz başarıyla güncellendi!
                        </div>
                    </Transition>

                    <PrimaryButton 
                        :disabled="form.processing || form.password !== form.password_confirmation || !form.current_password || !form.password"
                        class="px-6"
                    >
                        <svg v-if="form.processing" class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        {{ form.processing ? 'Güncelleniyor...' : 'Şifreyi Güncelle' }}
                    </PrimaryButton>
                </div>
            </div>
        </form>
    </section>
</template>
