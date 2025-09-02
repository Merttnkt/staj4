<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';
import ColorPicker from '@/Components/Admin/ColorPicker.vue';
import ImageUploader from '@/Components/Admin/ImageUploader.vue';
import { ref } from 'vue';
import { ArrowLeftIcon } from '@heroicons/vue/24/outline';

defineOptions({
    layout: AdminLayout
});

const props = defineProps({
    categories: Array
});

const form = useForm({
    name: '',
    description: '',
    price: '',
    product_category_id: '',
    image_url: '',
    images: [],
    colors: [],
    attributes: {}
});

const handleImagesUpdate = (images) => {
    form.images = images;
    if (images.length > 0) {
        form.image_url = images[0].url;
    } else {
        form.image_url = '';
    }
};

const attributeKeys = ref(['']);

const addAttributeField = () => {
    attributeKeys.value.push('');
};

const removeAttributeField = (index) => {
    attributeKeys.value.splice(index, 1);
    const newAttributes = { ...form.attributes };
    const keyToRemove = Object.keys(newAttributes)[index];
    if (keyToRemove) {
        delete newAttributes[keyToRemove];
        form.attributes = newAttributes;
    }
};

const updateAttributeKey = (oldKey, newKey, index) => {
    if (oldKey && oldKey !== newKey) {
        const value = form.attributes[oldKey];
        delete form.attributes[oldKey];
        if (newKey) {
            form.attributes[newKey] = value || '';
        }
    } else if (newKey) {
        form.attributes[newKey] = form.attributes[newKey] || '';
    }
};

const submit = () => {
    const cleanAttributes = {};
    Object.keys(form.attributes).forEach(key => {
        if (key.trim() && form.attributes[key].trim()) {
            cleanAttributes[key.trim()] = form.attributes[key].trim();
        }
    });
    form.attributes = cleanAttributes;
    
    form.post(route('admin.products.store'));
};
</script>

<template>
    <Head title="Yeni Ürün Ekle - Admin Panel" />

    <div class="space-y-6">
        <div class="flex items-center space-x-4">
            <Link :href="route('admin.products.index')" 
                  class="inline-flex items-center text-gray-600 hover:text-gray-900">
                <ArrowLeftIcon class="w-5 h-5 mr-2" />
                Geri Dön
            </Link>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Yeni Ürün Ekle</h1>
                <p class="text-gray-600 mt-1">Sisteme yeni ürün ekleyin</p>
            </div>
        </div>

        <form @submit.prevent="submit" class="space-y-6">
            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Temel Bilgiler</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Ürün Adı <span class="text-red-500">*</span>
                        </label>
                        <input v-model="form.name" type="text" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               :class="{ 'border-red-500': form.errors.name }"
                               placeholder="Örn: Modern Ahşap Masa">
                        <p v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select v-model="form.product_category_id" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                :class="{ 'border-red-500': form.errors.product_category_id }">
                            <option value="">Kategori Seçin</option>
                            <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.name }}
                            </option>
                        </select>
                        <p v-if="form.errors.product_category_id" class="text-red-500 text-sm mt-1">{{ form.errors.product_category_id }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Fiyat (TL) <span class="text-red-500">*</span>
                    </label>
                    <input v-model="form.price" type="number" step="0.01" min="0" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           :class="{ 'border-red-500': form.errors.price }"
                           placeholder="0.00">
                    <p v-if="form.errors.price" class="text-red-500 text-sm mt-1">{{ form.errors.price }}</p>
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Açıklama</label>
                    <textarea v-model="form.description" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                              :class="{ 'border-red-500': form.errors.description }"
                              placeholder="Ürün hakkında detaylı açıklama..."></textarea>
                    <p v-if="form.errors.description" class="text-red-500 text-sm mt-1">{{ form.errors.description }}</p>
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ürün Resimleri</label>
                    <ImageUploader @update:modelValue="handleImagesUpdate" :multiple="true" :maxFiles="5" />
                    <p v-if="form.errors.images" class="text-red-500 text-sm mt-1">{{ form.errors.images }}</p>
                    <p class="text-gray-500 text-sm mt-1">En fazla 5 resim yükleyebilirsiniz. İlk resim ana resim olacaktır.</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Renk Seçenekleri</h2>
                <ColorPicker v-model="form.colors" />
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold text-gray-900">Ürün Özellikleri</h2>
                    <button type="button" @click="addAttributeField"
                            class="px-3 py-1 bg-green-600 text-white text-sm rounded-md hover:bg-green-700 transition-colors">
                        + Özellik Ekle
                    </button>
                </div>

                <div v-if="attributeKeys.length === 1 && !attributeKeys[0]" class="text-gray-500 text-center py-4">
                    <p>Henüz özellik eklenmemiş. Yukarıdaki "Özellik Ekle" butonunu kullanarak özellik ekleyebilirsiniz.</p>
                </div>

                <div v-else class="space-y-4">
                    <div v-for="(key, index) in attributeKeys" :key="index" class="flex items-center space-x-4">
                        <div class="flex-1">
                            <input v-model="attributeKeys[index]" 
                                   @input="updateAttributeKey(key, attributeKeys[index], index)"
                                   type="text" 
                                   placeholder="Özellik adı (örn: Renk, Malzeme)"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div class="flex-1">
                            <input v-model="form.attributes[attributeKeys[index]]" 
                                   type="text" 
                                   placeholder="Özellik değeri"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <button type="button" @click="removeAttributeField(index)"
                                class="px-3 py-2 text-red-600 hover:text-red-800 hover:bg-red-50 rounded-md transition-colors">
                            Sil
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <Link :href="route('admin.products.index')" 
                      class="px-6 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors">
                    İptal
                </Link>
                <button type="submit" :disabled="form.processing"
                        class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors disabled:opacity-50">
                    <span v-if="form.processing">Kaydediliyor...</span>
                    <span v-else>Ürün Ekle</span>
                </button>
            </div>
        </form>
    </div>
</template>