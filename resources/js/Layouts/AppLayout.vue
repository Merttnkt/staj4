<script setup>
import AppHeader from '@/Components/AppHeader.vue';
import AppFooter from '@/Components/AppFooter.vue';
import { onMounted } from 'vue';
import AOS from 'aos';
import 'aos/dist/aos.css';

onMounted(() => {
  setTimeout(() => {
    AOS.init({
      duration: 800,
      once: true,
    });
  }, 100);
});
</script>

<template>
    <div class="bg-slate-50 text-gray-800 font-sans overflow-x-hidden">
        
        <AppHeader />

        <main>
            <slot />
        </main>

        <AppFooter />

    </div>
</template>