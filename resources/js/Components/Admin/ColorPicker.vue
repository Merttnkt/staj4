<script setup>
import { ref, computed } from 'vue';
import { PlusIcon, XMarkIcon } from '@heroicons/vue/24/outline';

const props = defineProps({
    modelValue: {
        type: Array,
        default: () => []
    }
});

const emit = defineEmits(['update:modelValue']);

const colors = ref([...props.modelValue]);

const predefinedColors = [
    { name: 'Beyaz', value: '#FFFFFF', hex: '#FFFFFF' },
    { name: 'Siyah', value: '#000000', hex: '#000000' },
    { name: 'Gri', value: '#808080', hex: '#808080' },
    { name: 'Kahverengi', value: '#8B4513', hex: '#8B4513' },
    { name: 'Kırmızı', value: '#DC2626', hex: '#DC2626' },
    { name: 'Mavi', value: '#2563EB', hex: '#2563EB' },
    { name: 'Yeşil', value: '#16A34A', hex: '#16A34A' },
    { name: 'Sarı', value: '#EAB308', hex: '#EAB308' },
    { name: 'Turuncu', value: '#EA580C', hex: '#EA580C' },
    { name: 'Mor', value: '#9333EA', hex: '#9333EA' },
    { name: 'Pembe', value: '#EC4899', hex: '#EC4899' },
    { name: 'Lacivert', value: '#1E3A8A', hex: '#1E3A8A' },
    { name: 'Krem', value: '#FEF3C7', hex: '#FEF3C7' },
    { name: 'Bej', value: '#D2B48C', hex: '#D2B48C' },
    { name: 'Doğal Ahşap', value: '#DEB887', hex: '#DEB887' }
];

const customColorName = ref('');
const customColorHex = ref('#000000');

const addPredefinedColor = (color) => {
    if (!colors.value.some(c => c.value === color.value)) {
        colors.value.push({
            name: color.name,
            value: color.value,
            hex: color.hex
        });
        emit('update:modelValue', colors.value);
    }
};

const addCustomColor = () => {
    if (customColorName.value.trim() && customColorHex.value) {
        if (!colors.value.some(c => c.value === customColorHex.value)) {
            colors.value.push({
                name: customColorName.value.trim(),
                value: customColorHex.value,
                hex: customColorHex.value
            });
            emit('update:modelValue', colors.value);
            customColorName.value = '';
            customColorHex.value = '#000000';
        }
    }
};

const removeColor = (index) => {
    colors.value.splice(index, 1);
    emit('update:modelValue', colors.value);
};

const availablePredefined = computed(() => {
    return predefinedColors.filter(color => 
        !colors.value.some(c => c.value === color.value)
    );
});
</script>

<template>
    <div class="space-y-6">
        <!-- Selected Colors -->
        <div v-if="colors.length > 0" class="space-y-3">
            <h4 class="text-sm font-medium text-gray-700">Seçilen Renkler</h4>
            <div class="flex flex-wrap gap-2">
                <div v-for="(color, index) in colors" :key="index" 
                     class="flex items-center space-x-2 bg-gray-100 rounded-lg px-3 py-2">
                    <div class="w-5 h-5 rounded-full border border-gray-300" 
                         :style="{ backgroundColor: color.hex }"></div>
                    <span class="text-sm text-gray-700">{{ color.name }}</span>
                    <button @click="removeColor(index)" 
                            class="text-red-500 hover:text-red-700">
                        <XMarkIcon class="w-4 h-4" />
                    </button>
                </div>
            </div>
        </div>

        <!-- Predefined Colors -->
        <div class="space-y-3">
            <h4 class="text-sm font-medium text-gray-700">Hazır Renkler</h4>
            <div class="grid grid-cols-3 sm:grid-cols-5 lg:grid-cols-6 gap-2">
                <button v-for="color in availablePredefined" :key="color.value"
                        @click="addPredefinedColor(color)"
                        class="flex flex-col items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 hover:border-gray-300 transition-colors">
                    <div class="w-8 h-8 rounded-full border border-gray-300 mb-2" 
                         :style="{ backgroundColor: color.hex }"></div>
                    <span class="text-xs text-gray-600 text-center">{{ color.name }}</span>
                </button>
            </div>
        </div>

        <!-- Custom Color -->
        <div class="space-y-3">
            <h4 class="text-sm font-medium text-gray-700">Özel Renk Ekle</h4>
            <div class="flex items-end space-x-3">
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-600 mb-1">Renk Adı</label>
                    <input v-model="customColorName" 
                           type="text" 
                           placeholder="Örn: Koyu Kahve"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Renk</label>
                    <input v-model="customColorHex" 
                           type="color" 
                           class="w-12 h-10 border border-gray-300 rounded-md cursor-pointer">
                </div>
                <button @click="addCustomColor" 
                        :disabled="!customColorName.trim()"
                        class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    <PlusIcon class="w-5 h-5" />
                </button>
            </div>
        </div>

        <!-- Empty State -->
        <div v-if="colors.length === 0" class="text-center py-8 text-gray-500">
            <div class="w-16 h-16 bg-gray-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                <div class="w-8 h-8 bg-gradient-to-r from-red-500 via-yellow-500 to-blue-500 rounded-full"></div>
            </div>
            <p>Henüz renk seçilmemiş</p>
            <p class="text-sm">Yukarıdaki hazır renklerden seçin veya özel renk ekleyin</p>
        </div>
    </div>
</template>