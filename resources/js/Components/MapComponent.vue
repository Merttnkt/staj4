<template>
  <div class="map-container relative w-full" :style="{ height: height }">
    <\!-- Loading State -->
    <div v-if="loading" class="absolute inset-0 bg-gray-100 flex items-center justify-center z-10">
      <div class="text-center">
        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500 mx-auto mb-2"></div>
        <p class="text-sm text-gray-500">Harita yükleniyor...</p>
      </div>
    </div>
    
    <\!-- Error State -->
    <div v-else-if="error" class="absolute inset-0 bg-red-50 flex items-center justify-center">
      <div class="text-center p-4">
        <svg class="w-8 h-8 text-red-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <p class="text-red-600 font-medium">Harita yüklenemedi</p>
        <button @click="retry" class="mt-2 text-sm bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
          Tekrar Dene
        </button>
      </div>
    </div>
    
    <\!-- Map iframe -->
    <iframe 
      v-show="\!loading && \!error"
      ref="mapIframe"
      :src="mapSrc"
      width="100%" 
      height="100%" 
      style="border:0;" 
      allowfullscreen 
      loading="lazy" 
      referrerpolicy="no-referrer-when-downgrade"
      @load="onMapLoad"
      @error="onMapError"
      class="w-full h-full"
    />
  </div>
</template>

<script setup>
import { ref, watch, onMounted } from 'vue'

const props = defineProps({
  src: {
    type: String,
    required: true
  },
  height: {
    type: String,
    default: '400px'
  }
})

const loading = ref(true)
const error = ref(false)
const mapIframe = ref(null)

const mapSrc = ref('')

const onMapLoad = () => {
  loading.value = false
  error.value = false
}

const onMapError = () => {
  loading.value = false
  error.value = true
}

const retry = () => {
  error.value = false
  loading.value = true
  mapSrc.value = props.src + (props.src.includes('?') ? '&' : '?') + 'retry=' + Date.now()
}

const loadMap = () => {
  if (props.src) {
    loading.value = true
    error.value = false
    mapSrc.value = props.src
  }
}

onMounted(() => {
  setTimeout(loadMap, 500)
})

watch(() => props.src, () => {
  loadMap()
})
</script>

<style scoped>
.map-container {
  min-height: 300px;
}
</style>
