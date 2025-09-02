<script setup>
import { Head, useForm, usePage } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import TextareaInput from '@/Components/TextareaInput.vue';

const props = defineProps({
    settings: {
        type: Object,
        default: () => ({}),
    },
    errors: Object,
});

const page = usePage();
const showSuccessMessage = ref(false);

const form = useForm({
    about_intro_title: props.settings?.about_intro_title || '',
    about_intro_paragraph: props.settings?.about_intro_paragraph || '',
    about_mission_paragraph: props.settings?.about_mission_paragraph || '',
    about_vision_paragraph: props.settings?.about_vision_paragraph || '',
});

const submit = () => {
    form.put(route('admin.settings.about.update'), {
        preserveScroll: true,
        onSuccess: () => {
        },
    });
};

watch(() => page.props.flash, (newFlash) => {
    if (newFlash && newFlash.success) {
        showSuccessMessage.value = true;
        setTimeout(() => {
            showSuccessMessage.value = false;
        }, 4000); // Mesaj 4 saniye sonra kaybolur
    }
}, { deep: true });

</script>

<template>
    <Head title="Hakkımızda Sayfası Ayarları" />

    <AdminLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Hakkımızda Sayfası Ayarları</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200 relative">
                        
                        <!-- Sayfa Başlığı ve Açıklaması -->
                        <div class="mb-8">
                            <h1 class="text-2xl font-bold text-gray-900 mb-2">Hakkımızda Sayfası Ayarları</h1>
                            <p class="text-gray-600">Web sitenizin hakkımızda sayfasında görünecek içerikleri buradan düzenleyebilirsiniz.</p>
                        </div>
                        
                        <!-- Başarı Mesajı için Transition -->
                        <transition
                            enter-active-class="transition ease-out duration-300"
                            enter-from-class="transform opacity-0 scale-95"
                            enter-to-class="transform opacity-100 scale-100"
                            leave-active-class="transition ease-in duration-200"
                            leave-from-class="transform opacity-100 scale-100"
                            leave-to-class="transform opacity-0 scale-95"
                        >
                            <div v-if="showSuccessMessage && $page.props.flash.success" class="p-4 mb-6 text-sm text-green-800 bg-green-100 rounded-lg shadow-md" role="alert">
                                {{ $page.props.flash.success }}
                            </div>
                        </transition>

                        <form @submit.prevent="submit">
                            <div class="grid grid-cols-1 gap-6">
                                
                                <!-- Biz Kimiz? Başlık -->
                                <div>
                                    <InputLabel for="about_intro_title" value="Tanıtım Başlığı ('Biz Kimiz?' Bölümü)" />
                                    <TextInput
                                        id="about_intro_title"
                                        type="text"
                                        class="mt-1 block w-full"
                                        v-model="form.about_intro_title"
                                        required
                                        autofocus
                                    />
                                    <InputError class="mt-2" :message="form.errors.about_intro_title" />
                                </div>

                                <!-- Biz Kimiz? Paragraf -->
                                <div>
                                    <InputLabel for="about_intro_paragraph" value="Tanıtım Paragrafı" />
                                    <TextareaInput
                                        id="about_intro_paragraph"
                                        class="mt-1 block w-full"
                                        v-model="form.about_intro_paragraph"
                                        rows="5"
                                    />
                                    <InputError class="mt-2" :message="form.errors.about_intro_paragraph" />
                                </div>

                                <!-- Misyonumuz Paragrafı -->
                                <div>
                                    <InputLabel for="about_mission_paragraph" value="Misyonumuz Paragrafı" />
                                    <TextareaInput
                                        id="about_mission_paragraph"
                                        class="mt-1 block w-full"
                                        v-model="form.about_mission_paragraph"
                                        rows="5"
                                    />
                                    <InputError class="mt-2" :message="form.errors.about_mission_paragraph" />
                                </div>

                                <!-- Vizyonumuz Paragrafı -->
                                <div>
                                    <InputLabel for="about_vision_paragraph" value="Vizyonumuz Paragrafı" />
                                    <TextareaInput
                                        id="about_vision_paragraph"
                                        class="mt-1 block w-full"
                                        v-model="form.about_vision_paragraph"
                                        rows="5"
                                    />
                                    <InputError class="mt-2" :message="form.errors.about_vision_paragraph" />
                                </div>

                            </div>

                            <div class="flex items-center justify-end mt-6">
                                <transition
                                    enter-active-class="transition ease-in duration-200"
                                    enter-from-class="opacity-0"
                                    leave-active-class="transition ease-in duration-200"
                                    leave-to-class="opacity-0"
                                >
                                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 mr-4">Kaydedildi.</p>
                                </transition>

                                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Ayarları Kaydet
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>
