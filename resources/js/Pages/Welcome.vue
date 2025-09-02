<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import { StarIcon } from '@heroicons/vue/24/solid';

defineOptions({
    layout: AppLayout
});

const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    featuredProducts: Array,
    categories: Array
});

const formatPrice = (price) => {
    return new Intl.NumberFormat('tr-TR', { 
        style: 'currency', 
        currency: 'TRY',
        minimumFractionDigits: 0
    }).format(price);
};

const testimonials = ref([
    {
        quote: "Markanız Mobilya Mobilya ile çalışmaya başladığımızdan beri müşterilerimizin memnuniyeti gözle görülür şekilde arttı. Kaliteli ürünler ve zamanında teslimat ile iş ortaklığımız mükemmel ilerliyor.",
        author: "Ahmet Özkan",
        company: "Özkan Mobilya Mağazası",
        location: "İstanbul",
        rating: 5
    },
    {
        quote: "Otel projelerimizde Markanız Mobilya Mobilya'nın ürünlerini tercih ediyoruz. Profesyonel ekipleri, özel tasarım desteği ve toplu sipariş avantajları sayesinde projelerimizi zamanında teslim edebiliyoruz.",
        author: "Elif Kara",
        company: "Kara İnşaat & Otel Projeleri",
        location: "Antalya",
        rating: 5
    },
    {
        quote: "Restoran zinciri olarak Markanız Mobilya Mobilya'dan aldığımız bahçe mobilyaları 3 yıldır sorunsuz hizmet veriyor. Kalite-fiyat dengesi ve satış sonrası destek mükemmel. Tüm şubelerimizde Markanız Mobilya tercihimiz.",
        author: "Murat Yıldız",
        company: "Yıldız Restoran Zinciri",
        location: "Ankara",
        rating: 5
    }
]);

</script>

<template>
    <Head title="Ana Sayfa - Markanız Mobilya Mobilya" />

    <section class="relative h-[60vh] md:h-[80vh] flex items-center justify-center text-white text-center"
             style="background-image: url('https://images.unsplash.com/photo-1555041469-a586c61ea9bc?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="absolute inset-0 bg-black opacity-40 z-10"></div>
        <div class="relative z-20 px-6" data-aos="fade-up">
            <h1 class="text-4xl md:text-6xl font-serif font-bold tracking-tight">Profesyonel İş Ortaklığı, Güvenilir Çözümler</h1>
            <p class="mt-4 text-lg md:text-xl max-w-2xl mx-auto text-gray-200">B2B mobilya ihtiyaçlarınız için kaliteli ürünler, toplu satış avantajları ve profesyonel destek.</p>
            <Link :href="route('products.index')"
                  class="mt-8 inline-block bg-blue-600 text-white font-bold py-3 px-10 rounded-full hover:bg-blue-700 transition-colors duration-300 text-lg transform hover:scale-105">
                Ürün Kataloğunu İncele
            </Link>
        </div>
    </section>

    <section class="bg-slate-50 py-16 sm:py-24">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4">Kategorileri Keşfedin</h2>
            <p class="text-gray-600 mb-12 max-w-xl mx-auto">Her zevke ve mekana uygun, özenle seçilmiş kategorilerimizle tanışın.</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <Link :href="route('products.category', { category: 'masalar' })" 
                      class="group relative rounded-lg overflow-hidden h-80 shadow-lg" 
                      data-aos="fade-up">
                    <img src="https://images.unsplash.com/photo-1611269154421-4e27233ac5c7?w=600" 
                         alt="Masa Kategorisi" 
                         class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center transition-all duration-300 group-hover:bg-opacity-40">
                        <h3 class="text-3xl font-bold text-white">Masalar</h3>
                    </div>
                </Link>
                
                <Link :href="route('products.category', { category: 'sandalyeler' })" 
                      class="group relative rounded-lg overflow-hidden h-80 shadow-lg" 
                      data-aos="fade-up" data-aos-delay="100">
                    <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=600" 
                         alt="Sandalye Kategorisi" 
                         class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center transition-all duration-300 group-hover:bg-opacity-40">
                        <h3 class="text-3xl font-bold text-white">Sandalyeler</h3>
                    </div>
                </Link>
                
                <Link :href="route('products.category', { category: 'bahce-mobilyasi' })" 
                      class="group relative rounded-lg overflow-hidden h-80 shadow-lg" 
                      data-aos="fade-up" data-aos-delay="200">
                    <img src="https://images.unsplash.com/photo-1506439773649-6e0eb8cfb237?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                         alt="Bahçe Mobilyası Kategorisi" 
                         class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center transition-all duration-300 group-hover:bg-opacity-40">
                        <h3 class="text-3xl font-bold text-white">Bahçe Mobilyaları</h3>
                    </div>
                </Link>
            </div>
        </div>
    </section>

    <section class="bg-white py-16 sm:py-24">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Öne Çıkan Ürünler</h2>
            <p class="text-gray-600 mb-12 max-w-xl mx-auto">En çok tercih edilen, şık ve fonksiyonel ürünlerimiz.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <Link v-for="(product, index) in featuredProducts" :key="product.id" :href="route('product.show', { product: product.slug })"
                      class="bg-white border border-gray-200 rounded-lg overflow-hidden group transition-all duration-300 ease-in-out hover:shadow-xl hover:-translate-y-1 relative block"
                      data-aos="fade-up" :data-aos-delay="index * 100">
                    <div class="block overflow-hidden aspect-square">
                        <img :src="product.image_url" :alt="product.name" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="p-4 text-left">
                        <h3 class="text-lg font-semibold text-gray-800 truncate">{{ product.name }}</h3>
                        <p v-if="$page.props.auth.user" class="text-md text-gray-600 mt-1">{{ formatPrice(product.price) }}</p>
                        <p v-else class="text-md text-blue-600 mt-1">Fiyat için giriş yapın</p>
                    </div>
                </Link>
            </div>
        </div>
    </section>

    <section class="bg-slate-50 py-16 sm:py-24">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">İş Ortaklarımızın Deneyimleri</h2>
                <p class="text-gray-600 mb-12">Türkiye'nin dört bir yanından iş ortaklarımızın Markanız Mobilya Mobilya deneyimleri</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div v-for="(testimonial, index) in testimonials" :key="index"
                     class="bg-white p-8 rounded-lg shadow-lg border-l-4 border-blue-600"
                     data-aos="fade-up" :data-aos-delay="index * 100">
                    <div class="flex items-center justify-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-blue-700 rounded-full flex items-center justify-center">
                            <span class="text-white font-bold text-lg">{{ testimonial.company.charAt(0) }}</span>
                        </div>
                    </div>
                    
                    <div class="flex justify-center mb-4">
                        <div v-for="i in 5" :key="i" class="flex">
                            <StarIcon class="h-5 w-5" :class="i <= testimonial.rating ? 'text-yellow-400' : 'text-gray-300'" />
                        </div>
                    </div>
                    
                    <blockquote class="text-gray-600 italic text-center mb-6 leading-relaxed">
                        "{{ testimonial.quote }}"
                    </blockquote>
                    
                    <div class="text-center border-t pt-4">
                        <p class="font-semibold text-gray-800 mb-1">{{ testimonial.author }}</p>
                        <p class="text-blue-600 font-medium mb-1">{{ testimonial.company }}</p>
                        <p class="text-gray-500 text-sm">📍 {{ testimonial.location }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-16 sm:py-24">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4" data-aos="fade-up">Neden Markanız Mobilya Mobilya İş Ortaklığı?</h2>
                <p class="text-lg text-gray-600 leading-relaxed" data-aos="fade-up" data-aos-delay="100">
                    8+ yıllık sektör deneyimimizle, Türkiye'nin her yerinden 500+ iş ortağımızla çalışıyoruz. Kaliteli ürünlerimiz, rekabetçi B2B fiyatlandırmamız, hızlı teslimat ağımız ve profesyonel satış desteğimizle iş ortaklarımızın başarısına ortak oluyoruz. Toplu siparişlerde özel indirimler, esnek ödeme koşulları ve satış sonrası destek ile uzun vadeli iş birliktelikleri kuruyoruz.
                </p>
            </div>
        </div>
    </section>

    <section class="bg-gray-900 py-16 sm:py-24">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4" data-aos="fade-up">Markanız Mobilya Mobilya'yı Keşfedin</h2>
                <p class="text-lg text-gray-300 mb-12" data-aos="fade-up" data-aos-delay="100">
                    Atölyemizde nasıl çalıştığımızı ve kaliteli mobilyalarımızı nasıl ürettiğimizi izleyin.
                </p>
                <div class="relative w-full max-w-4xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative pb-[56.25%] h-0 overflow-hidden rounded-lg shadow-2xl">
                        <iframe 
                            class="absolute top-0 left-0 w-full h-full"
                            src="https://www.youtube.com/embed/b4qbYJr82fc"
                            title="Markanız Mobilya Mobilya Tanıtım Videosu"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-slate-50 py-16 sm:py-24">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4" data-aos="fade-up">B2B Avantajlarımız</h2>
                <p class="text-lg text-gray-600" data-aos="fade-up" data-aos-delay="100">İş ortaklarımızın başarısı için sunduğumuz özel avantajlar</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6" data-aos="fade-up">
                    <div class="bg-blue-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Kalite Garantisi</h3>
                    <p class="text-gray-600">Tüm ürünlerimizde 2 yıl garanti. Kaliteli malzeme ve işçilik güvencesi.</p>
                </div>
                <div class="text-center p-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="bg-blue-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Hızlı Teslimat</h3>
                    <p class="text-gray-600">Türkiye genelinde 2-5 iş günü teslimat. Stoklu ürünlerde aynı gün kargo imkanı.</p>
                </div>
                <div class="text-center p-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-blue-600 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-2-2v-6a2 2 0 012-2h8V4l4 4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Özel Satış Desteği</h3>
                    <p class="text-gray-600">Uzman satış temsilciniz, ürün katalogu ve pazarlama materyalleri ile tam destek.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white py-16 sm:py-24">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4" data-aos="fade-up">Rakamlarla Markanız Mobilya B2B</h2>
                    <p class="text-lg text-gray-600" data-aos="fade-up" data-aos-delay="100">Güçlü iş ortaklık ağımız ve başarılı performansımız</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                    <div data-aos="fade-up">
                        <div class="text-3xl md:text-4xl font-bold text-blue-600 mb-2">8+</div>
                        <div class="text-gray-600">Yıllık B2B Deneyim</div>
                    </div>
                    <div data-aos="fade-up" data-aos-delay="100">
                        <div class="text-3xl md:text-4xl font-bold text-blue-600 mb-2">500+</div>
                        <div class="text-gray-600">Aktif İş Ortağı</div>
                    </div>
                    <div data-aos="fade-up" data-aos-delay="200">
                        <div class="text-3xl md:text-4xl font-bold text-blue-600 mb-2">50K+</div>
                        <div class="text-gray-600">B2B Ürün Teslimatı</div>
                    </div>
                    <div data-aos="fade-up" data-aos-delay="300">
                        <div class="text-3xl md:text-4xl font-bold text-blue-600 mb-2">%96</div>
                        <div class="text-gray-600">İş Ortağı Memnuniyeti</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="relative py-20 overflow-hidden"
             style="background: linear-gradient(135deg, #1f2937 0%, #374151 100%);">
        <div class="absolute inset-0 opacity-10">
            <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" 
                 alt="Modern mobilya" 
                 class="w-full h-full object-cover">
        </div>
        <div class="relative container mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Yaşam Alanlarınızı Güzelleştirmeye Hazır Mısınız?</h2>
            <p class="text-gray-300 mb-8 max-w-2xl mx-auto text-lg">Geniş ürün yelpazemize göz atın ve hayalinizdeki evi yaratmaya bugün başlayın.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <Link :href="route('products.index')"
                      class="inline-block bg-white text-gray-800 font-bold py-4 px-10 rounded-full hover:bg-gray-100 transition-all duration-300 text-lg transform hover:scale-105 shadow-lg">
                    Tüm Ürünleri Gör
                </Link>
                <Link :href="route('contact')"
                      class="inline-block border-2 border-white text-white font-bold py-4 px-10 rounded-full hover:bg-white hover:text-gray-800 transition-all duration-300 text-lg transform hover:scale-105">
                    Bize Ulaşın
                </Link>
            </div>
        </div>
    </section>

</template>