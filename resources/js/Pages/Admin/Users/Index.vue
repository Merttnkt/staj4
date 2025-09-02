<template>
    <AdminLayout>
        <Head title="Kullanıcı Yönetimi" />

        <div class="p-6">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Kullanıcı Yönetimi</h1>
                <p class="mt-2 text-sm text-gray-600">
                    Kayıt olan kullanıcıları yönetin ve onaylayın.
                </p>
            </div>

            <!-- Success Message -->
            <div v-if="$page.props.flash?.success" class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ $page.props.flash.success }}
            </div>

            <!-- Tab Buttons -->
            <div class="mb-6">
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8">
                        <a 
                            :href="'/admin/users?status=approved'"
                            :class="[
                                'py-2 px-1 border-b-2 font-medium text-sm',
                                currentStatus === 'approved' 
                                    ? 'border-green-500 text-green-600' 
                                    : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                            ]"
                        >
                            Mevcut Üyeler
                            <span class="ml-2 bg-green-100 text-green-800 py-0.5 px-2 rounded-full text-xs">
                                {{ counts?.approved || 0 }}
                            </span>
                        </a>
                        <a 
                            :href="'/admin/users?status=pending'"
                            :class="[
                                'py-2 px-1 border-b-2 font-medium text-sm',
                                currentStatus === 'pending' || !currentStatus
                                    ? 'border-yellow-500 text-yellow-600' 
                                    : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                            ]"
                        >
                            Onay Bekleyenler
                            <span class="ml-2 bg-yellow-100 text-yellow-800 py-0.5 px-2 rounded-full text-xs">
                                {{ counts?.pending || 0 }}
                            </span>
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Users Table -->
            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kullanıcı Bilgileri
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                İletişim
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Mağaza/Firma
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Kayıt Tarihi
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                İşlemler
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="user in users?.data || []" :key="user.id" class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 flex-shrink-0">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center">
                                            <span class="text-sm font-medium text-blue-600">
                                                {{ (user.first_name?.charAt(0) || '') + (user.last_name?.charAt(0) || '') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ user.first_name }} {{ user.last_name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            @{{ user.name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ user.email }}</div>
                                <div class="text-sm text-gray-500">{{ user.phone }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ user.store_name || 'Bireysel Müşteri' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ formatDate(user.created_at) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <button
                                        v-if="user.status === 'pending'"
                                        @click="approveUser(user.id)"
                                        class="bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded-md text-xs font-medium transition-colors"
                                    >
                                        Onayla
                                    </button>
                                    <button
                                        v-if="user.status === 'pending'"
                                        @click="rejectUser(user.id)"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-md text-xs font-medium transition-colors"
                                    >
                                        Reddet
                                    </button>
                                    <button
                                        v-if="user.status === 'approved'"
                                        @click="suspendUser(user.id)"
                                        class="bg-yellow-600 hover:bg-yellow-700 text-white px-3 py-1.5 rounded-md text-xs font-medium transition-colors"
                                    >
                                        Askıya Al
                                    </button>
                                    <button
                                        @click="deleteUser(user.id, user.first_name + ' ' + user.last_name)"
                                        class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1.5 rounded-md text-xs font-medium transition-colors"
                                    >
                                        Sil
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Empty State -->
                <div v-if="!users?.data || users.data.length === 0" class="text-center py-12">
                    <div class="text-gray-500">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">
                            {{ currentStatus === 'pending' || !currentStatus ? 'Onay bekleyen kullanıcı yok' : 'Onaylı kullanıcı yok' }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            {{ currentStatus === 'pending' || !currentStatus ? 'Henüz onaylanmayı bekleyen kullanıcı bulunmuyor.' : 'Henüz onaylanmış kullanıcı bulunmuyor.' }}
                        </p>
                    </div>
                </div>

                <!-- Pagination -->
                <div v-if="users?.links && users.data?.length > 0" class="bg-gray-50 px-4 py-3 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            <span class="font-medium">{{ users?.from || 0 }}</span>
                            -
                            <span class="font-medium">{{ users?.to || 0 }}</span>
                            arası, toplam
                            <span class="font-medium">{{ users?.total || 0 }}</span>
                            kullanıcı
                        </div>
                        <div class="flex space-x-2">
                            <a
                                v-for="link in users?.links || []"
                                :key="link.label"
                                :href="link.url"
                                v-html="link.label"
                                :class="[
                                    'px-3 py-2 text-sm border rounded-md',
                                    link.active 
                                        ? 'bg-blue-500 text-white border-blue-500' 
                                        : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'
                                ]"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, Link, useForm, router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminLayout.vue'

defineProps({
    users: Object,
    counts: Object,
    currentStatus: String,
})

const approveUser = (userId) => {
    if (confirm('Bu kullanıcıyı onaylamak istediğinizden emin misiniz?')) {
        router.patch(`/admin/users/${userId}/approve`)
    }
}

const rejectUser = (userId) => {
    if (confirm('Bu kullanıcıyı reddetmek istediğinizden emin misiniz?')) {
        router.patch(`/admin/users/${userId}/reject`)
    }
}

const suspendUser = (userId) => {
    if (confirm('Bu kullanıcıyı askıya almak istediğinizden emin misiniz?')) {
        router.patch(`/admin/users/${userId}/suspend`)
    }
}

const deleteUser = (userId, userName) => {
    if (confirm(`${userName} kullanıcısını kalıcı olarak silmek istediğinizden emin misiniz? Bu işlem geri alınamaz.`)) {
        router.delete(`/admin/users/${userId}`)
    }
}

const formatDate = (dateString) => {
    return new Date(dateString).toLocaleDateString('tr-TR', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    })
}
</script>