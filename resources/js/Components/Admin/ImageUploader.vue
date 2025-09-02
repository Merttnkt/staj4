<script setup>
import { ref, computed } from 'vue';
import { router } from '@inertiajs/vue3';
import { XMarkIcon, PhotoIcon, CloudArrowUpIcon } from '@heroicons/vue/24/outline';

const props = defineProps({
    modelValue: {
        type: Array,
        default: () => []
    },
    multiple: {
        type: Boolean,
        default: true
    },
    maxFiles: {
        type: Number,
        default: 5
    }
});

const emit = defineEmits(['update:modelValue']);

const images = ref([]);

if (props.modelValue && props.modelValue.length > 0) {
    images.value = props.modelValue.map(item => {
        if (typeof item === 'string') {
            return {
                url: item,
                path: item.replace('/storage/', ''),
                filename: item.split('/').pop()
            };
        }
        return item;
    });
}
const uploading = ref(false);
const dragOver = ref(false);

const canAddMore = computed(() => {
    return props.multiple ? images.value.length < props.maxFiles : images.value.length === 0;
});

const handleFileSelect = (event) => {
    const files = Array.from(event.target.files);
    uploadFiles(files);
    event.target.value = '';
};

const handleDrop = (event) => {
    event.preventDefault();
    dragOver.value = false;
    const files = Array.from(event.dataTransfer.files).filter(file => file.type.startsWith('image/'));
    uploadFiles(files);
};

const uploadFiles = async (files) => {
    if (!canAddMore.value) return;
    
    const filesToUpload = props.multiple 
        ? files.slice(0, props.maxFiles - images.value.length)
        : files.slice(0, 1);

    if (!props.multiple) {
        images.value = [];
    }

    uploading.value = true;

    for (const file of filesToUpload) {
        try {
            const formData = new FormData();
            formData.append('image', file);

            const response = await fetch('/admin/upload/product-image', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
                },
                body: formData
            });

            const responseText = await response.text();
            
            let result;
            try {
                result = JSON.parse(responseText);
            } catch (e) {
                return;
            }

            if (result.success) {
                images.value.push({
                    url: result.url,
                    path: result.path,
                    filename: result.filename
                });
            }
        } catch (error) {
        }
    }

    uploading.value = false;
    emit('update:modelValue', images.value);
};

const removeImage = async (index) => {
    const image = images.value[index];
    
    try {
        await fetch('/admin/upload/delete-product-image', {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ path: image.path })
        });
    } catch (error) {
    }

    images.value.splice(index, 1);
    emit('update:modelValue', images.value);
};

const onDragOver = (event) => {
    event.preventDefault();
    dragOver.value = true;
};

const onDragLeave = (event) => {
    event.preventDefault();
    dragOver.value = false;
};
</script>

<template>
    <div class="space-y-4">
        <div v-if="canAddMore"
             @drop="handleDrop"
             @dragover="onDragOver"
             @dragleave="onDragLeave"
             :class="[
                 'border-2 border-dashed rounded-lg p-6 text-center transition-colors',
                 dragOver ? 'border-blue-500 bg-blue-50' : 'border-gray-300 hover:border-gray-400'
             ]">
            <div class="space-y-4">
                <div class="flex justify-center">
                    <CloudArrowUpIcon v-if="!uploading" class="w-12 h-12 text-gray-400" />
                    <div v-else class="flex items-center justify-center">
                        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                    </div>
                </div>
                
                <div v-if="!uploading">
                    <p class="text-gray-600 mb-2">
                        {{ multiple ? 'Resimleri buraya sürükleyin veya' : 'Resmi buraya sürükleyin veya' }}
                    </p>
                    <label class="cursor-pointer inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                        <PhotoIcon class="w-5 h-5 mr-2" />
                        Dosya Seç
                        <input type="file" 
                               :multiple="multiple"
                               accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                               @change="handleFileSelect"
                               class="sr-only">
                    </label>
                    <p class="text-gray-500 text-sm mt-2">
                        JPEG, PNG, JPG, GIF, WebP (Max: 2MB)
                        <span v-if="multiple"> - En fazla {{ maxFiles }} resim</span>
                    </p>
                </div>
                
                <div v-else class="text-blue-600">
                    Resimler yükleniyor...
                </div>
            </div>
        </div>

        <div v-if="images.length > 0" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <div v-for="(image, index) in images" :key="index" 
                 class="relative group bg-gray-100 rounded-lg overflow-hidden aspect-square">
                <img :src="image.url" 
                     :alt="`Resim ${index + 1}`"
                     class="w-full h-full object-cover">
                
                <button @click="removeImage(index)"
                        class="absolute top-2 right-2 p-1 bg-red-600 text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-700">
                    <XMarkIcon class="w-4 h-4" />
                </button>
                
                <div v-if="index === 0 && multiple" 
                     class="absolute bottom-2 left-2 px-2 py-1 bg-blue-600 text-white text-xs rounded">
                    Ana Resim
                </div>
            </div>
        </div>
        
        <div v-if="images.length === 0" class="text-center py-8 text-gray-500">
            <PhotoIcon class="w-16 h-16 mx-auto mb-4 text-gray-300" />
            <p>Henüz resim eklenmemiş</p>
        </div>
    </div>
</template>