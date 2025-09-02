<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

defineOptions({
  layout: AdminLayout,
});

defineProps({
  userCounts: Object,
  recentUsers: Array,
});

const stats = [
  {
    title: 'Onay Bekleyenler',
    value: null,
    key: 'pending',
    icon: 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-12h2v6h-2v-6zm0 8h2v2h-2v-2z',
    color: 'from-yellow-500 to-orange-600',
  },
  {
    title: 'Onaylı Üyeler',
    value: null,
    key: 'approved',
    icon: 'M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z',
    color: 'from-emerald-500 to-teal-600',
  },
  {
    title: 'Reddedilenler',
    value: null,
    key: 'rejected',
    icon: 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-12h2v6h-2v-6zm0 8h2v2h-2v-2z',
    color: 'from-red-500 to-pink-600',
  },
  {
    title: 'Toplam Kullanıcı',
    value: null,
    key: 'total',
    icon: 'M20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z',
    color: 'from-sky-500 to-blue-600',
  },
];
</script>

<template>
    <Head title="Admin Dashboard" />

    <div class="min-h-screen bg-gradient-to-br from-cyan-50 via-teal-50 to-blue-100 space-y-8 p-6">
        <!-- Page Title -->
        <div class="flex justify-between items-center">
            <h1 class="text-4xl font-bold text-gray-800 tracking-tight">🎯 Admin Dashboard - Hoş Geldiniz!</h1>
            <Link :href="'/admin/users'" class="bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-md hover:bg-purple-700 transition-transform transform hover:scale-105">
                Kullanıcı Yönetimi
            </Link>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div v-for="stat in stats" :key="stat.title"
                 class="text-white p-6 rounded-3xl shadow-2xl border border-white/20 backdrop-blur-sm hover:scale-105 transition-all duration-300 flex items-center justify-between"
                 :class="`bg-gradient-to-br ${stat.color}`">
                <div>
                    <div class="text-sm font-medium uppercase tracking-wider">{{ stat.title }}</div>
                    <div class="text-4xl font-extrabold mt-1">{{ userCounts?.[stat.key] || 0 }}</div>
                </div>
                <div class="bg-white bg-opacity-20 p-3 rounded-full">
                    <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                        <path :d="stat.icon"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Bar Chart -->
            <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-lg">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Satış Grafiği</h3>
                <div class="h-64 flex items-end space-x-4">
                    <div v-for="i in 12" :key="i" class="flex-1 bg-gradient-to-t from-cyan-500 to-blue-600 rounded-t-lg" :style="{ height: `${Math.random() * 80 + 10}%` }"></div>
                </div>
            </div>

            <!-- Donut Chart -->
            <div class="bg-white p-6 rounded-2xl shadow-lg flex flex-col items-center justify-center">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Ziyaretçi Kaynakları</h3>
                <div class="relative w-48 h-48">
                    <svg class="w-full h-full" viewBox="0 0 36 36">
                        <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#f3e8ff" stroke-width="3.8"></path>
                        <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 13.999 22.45" fill="none" stroke="#a855f7" stroke-width="3.8" stroke-dasharray="60, 100"></path>
                         <path d="M31.999 24.5345 a 15.9155 15.9155 0 0 1 -27.998 0" fill="none" stroke="#34d399" stroke-width="3.8" stroke-dasharray="40, 100" transform="rotate(144, 18, 18)"></path>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center text-2xl font-bold text-gray-700">
                        75%
                    </div>
                </div>
                 <div class="mt-4 text-center text-gray-500 text-sm">
                    <span class="font-bold text-purple-600">Organik</span>, <span class="font-bold text-green-500">Referans</span>, <span class="font-bold text-purple-200">Direkt</span>
                </div>
            </div>
        </div>
    </div>
</template>
