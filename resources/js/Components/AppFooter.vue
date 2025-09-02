<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <footer class="bg-gray-800 text-white">
        <div class="container mx-auto px-6 pt-16 pb-8">
            <div class="flex flex-wrap text-center md:text-left -mx-4">

                <div class="w-full sm:w-1/2 md:w-1/4 px-4 mb-8 md:mb-0">
                    <h5 class="uppercase mb-6 font-bold font-poppins">Markanız Mobilya</h5>
                    <ul class="mb-4 text-sm">
                        <li class="mt-2"><Link :href="route('about')" class="text-slate-300 hover:text-white hover:underline">Hakkımızda</Link></li>
                        <li class="mt-2"><Link href="#" class="text-slate-300 hover:text-white hover:underline">Blog</Link></li>
                        <li class="mt-2"><Link :href="route('contact')" class="text-slate-300 hover:text-white hover:underline">İletişim</Link></li>
                    </ul>
                </div>

                <div class="w-full sm:w-1/2 md:w-1/4 px-4 mb-8 md:mb-0">
                    <h5 class="uppercase mb-6 font-bold font-poppins">Müşteri Hizmetleri</h5>
                    <ul class="mb-4 text-sm">
                        <li class="mt-2"><Link href="#" class="text-slate-300 hover:text-white hover:underline">Sıkça Sorulan Sorular</Link></li>
                        <li class="mt-2"><Link href="#" class="text-slate-300 hover:text-white hover:underline">Teslimat ve Kargo</Link></li>
                        <li class="mt-2"><Link href="#" class="text-slate-300 hover:text-white hover:underline">İptal ve İade Politikası</Link></li>
                        <li class="mt-2"><Link href="#" class="text-slate-300 hover:text-white hover:underline">Sipariş Takibi</Link></li>
                    </ul>
                </div>

                <div class="w-full sm:w-1/2 md:w-1/4 px-4 mb-8 md:mb-0">
                    <h5 class="uppercase mb-6 font-bold font-poppins">Sözleşmeler</h5>
                    <ul class="mb-4 text-sm">
                        <li class="mt-2"><Link href="#" class="text-slate-300 hover:text-white hover:underline">Mesafeli Satış Sözleşmesi</Link></li>
                        <li class="mt-2"><Link href="#" class="text-slate-300 hover:text-white hover:underline">Kullanım Koşulları</Link></li>
                        <li class="mt-2"><Link href="#" class="text-slate-300 hover:text-white hover:underline">Gizlilik ve Çerez Politikası</Link></li>
                        <li class="mt-2"><Link href="#" class="text-slate-300 hover:text-white hover:underline">KVKK Aydınlatma Metni</Link></li>
                    </ul>
                </div>
                
                <div class="w-full sm:w-1/2 md:w-1/4 px-4">
                    <h5 class="uppercase mb-6 font-bold font-poppins">Bizi Takip Edin</h5>
                    <p class="text-sm text-slate-400 mb-4">En yeni ürünler ve kampanyalardan haberdar olun.</p>
                    <div class="flex space-x-4 justify-center md:justify-start">
                        <a href="#" class="text-slate-300 hover:text-white transition-transform duration-300 transform hover:scale-110">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                        </a>
                        <a href="#" class="text-slate-300 hover:text-white transition-transform duration-300 transform hover:scale-110">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.024.06 1.378.06 3.808s-.012 2.784-.06 3.808c-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.024.048-1.378.06-3.808.06s-2.784-.013-3.808-.06c-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.048-1.024-.06-1.378-.06-3.808s.013-2.784.06-3.808c.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 016.08 2.525c.636-.247 1.363-.416 2.427-.465C9.53 2.013 9.884 2 12.315 2zM12 7a5 5 0 100 10 5 5 0 000-10zm0 8a3 3 0 110-6 3 3 0 010 6zm6.406-11.845a1.25 1.25 0 100 2.5 1.25 1.25 0 000-2.5z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            
            <hr class="my-8 border-gray-700">

            <div class="flex flex-col md:flex-row items-center justify-between">
                <p class="text-sm text-slate-400 mb-4 md:mb-0">
                    © 2025 Markanız Mobilya. Tüm Hakları Saklıdır.
                </p>
            </div>

        </div>
    </footer>
</template>