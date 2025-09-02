<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';

defineProps({
    settings: {
        type: Object,
        default: () => ({}),
    }
});
</script>

<template>

    <Head title="Hakkımızda - Markanız Mobilya" />

    <AppLayout>

        <section class="relative w-full h-96 bg-gray-200">
            <img 
                src="/images/hero/hero-bg.jpg" 
                alt="Markanız Mobilya'nın üretim atölyesinden bir kesit" 
                class="absolute inset-0 w-full h-full object-cover"
            >
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>
            <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-4">
                <h1 class="text-white text-4xl md:text-5xl font-extrabold leading-tight">
                    Anlarınızı Tasarlıyoruz
                </h1>
                <p class="text-white mt-4 max-w-2xl">
                    Masa, sandalye ve bahçe mobilyalarıyla yaşam alanlarınızı unutulmaz buluşma noktalarına dönüştürüyoruz.
                </p>
            </div>
        </section>

        <section class="bg-white py-16 sm:py-20">
            <div class="container mx-auto px-6">
                <div class="max-w-4xl mx-auto text-center" data-aos="fade-up">
                    <h2 class="text-base font-semibold leading-7 text-blue-600">Biz Kimiz?</h2>
                    <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl font-poppins">
                        {{ settings.about_intro_title || 'Mobilyadan Daha Fazlası: Anları Birleştiren Tasarımlar' }}
                    </p>
                    <p class="mt-6 text-lg leading-8 text-gray-600">
                        {{ settings.about_intro_paragraph || 'Markanız Mobilya olarak [2015] yılında çıktığımız bu yolda, temel bir inançla hareket ediyoruz: Mobilya, sadece bir eşya değil, hayatın en değerli anlarına ev sahipliği yapan birer sahnedir. Bir ailenin akşam yemeğindeki kahkahalarından, bir dost meclisindeki derin sohbetlere kadar tüm o anları daha konforlu, daha estetik ve daha anlamlı kılmak için çalışıyoruz. Masa, sandalye ve bahçe mobilyaları konusundaki uzmanlığımızı, kaliteli malzeme tutkumuz ve usta zanaatkarlığımızla birleştirerek, mekanlarınıza ruh katan tasarımlar sunuyoruz.' }}
                    </p>
                </div>
            </div>
        </section>

        <section class="container mx-auto px-6 py-20">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div data-aos="fade-right">
                    <h3 class="font-poppins text-3xl font-bold text-gray-800 mb-4">Her Detayda Konfor ve Estetik</h3>
                    <p class="mb-4 leading-relaxed">Markanız Mobilya olarak yolculuğumuz, insanların bir araya geldiği anların
                        değerini bilerek başladı. Aile yemeklerinden dost sohbetlerine, bir fincan kahve keyfinden
                        bahçedeki kutlamalara kadar her anın merkezinde olan masaları, sandalyeleri ve dış mekan
                        mobilyalarını birer sanat eseri gibi görüyoruz.</p>
                    <p class="leading-relaxed">Tasarım felsefemiz, sadece göze hitap eden değil, aynı zamanda ergonomik,
                        dayanıklı ve fonksiyonel ürünler yaratmaktır. Her bir parçayı, hayatınıza yıllarca eşlik edecek
                        bir dost gibi tasarlıyoruz.</p>
                </div>
                <div data-aos="fade-left">
                    <img src="/images/about/bahce-mobilyasi-detay.png" alt="Şık Yemek Masası Takımı" width="1200" height="800" class="rounded-lg shadow-xl w-full h-auto">
                </div>
            </div>
        </section>

        <section class="bg-slate-50">
            <div class="container mx-auto px-6 py-20">
                <div class="grid md:grid-cols-2 gap-16 items-center">
                    <div data-aos="fade-right" class="order-2 md:order-1">
                        <img src="/images/hakkimizda/malzeme-ve-iscilik.jpg" alt="Malzeme ve İşçilik Detayı" width="1200" height="800" class="rounded-lg shadow-xl w-full h-auto">
                    </div>
                    <div class="order-1 md:order-2" data-aos="fade-left">
                        <h3 class="font-poppins text-3xl font-bold text-gray-800 mb-4">Malzeme Seçimi ve Zanaatkarlık
                        </h3>
                        <p class="mb-4 leading-relaxed">Kalitenin temelinin doğru malzeme ve usta işçilik olduğuna
                            inanıyoruz. Dış mekan ürünlerimizde, zorlu hava koşullarına dayanıklı Iroko ve Teak gibi
                            ağaçları, paslanmaz metallerle birleştiriyoruz. İç mekan tasarımlarımızda ise meşenin
                            sıcaklığını ve cevizin zarafetini ön plana çıkarıyoruz.</p>
                        <p class="leading-relaxed">Her bir mobilya, tecrübeli zanaatkarlarımızın elinde, titiz bir
                            süreçten geçerek son halini alır. Bu sadece bir üretim süreci değil, aynı zamanda ahşaba ve
                            metale ruh katma sanatıdır.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="container mx-auto px-6 py-20">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div data-aos="fade-right">
                    <h3 class="font-poppins text-3xl font-bold text-gray-800 mb-4">Sürdürülebilirlik ve Doğa Dostu
                        Üretim</h3>
                    <p class="mb-4 leading-relaxed">Gelecek nesillere yaşanabilir bir dünya bırakma sorumluluğuyla
                        hareket ediyoruz. Üretimimizde kullandığımız ahşabın, sorumlu bir şekilde yönetilen, FSC
                        sertifikalı ormanlardan gelmesine özen gösteriyoruz.</p>
                    <p class="leading-relaxed">Üretim süreçlerimizde su bazlı, çevreye minimum etki eden vernik ve
                        boyaları tercih ediyor, atıklarımızı en aza indirerek döngüsel ekonomiye katkıda bulunmayı
                        hedefliyoruz.</p>
                </div>
                <div data-aos="fade-left">
                    <img src="/images/hakkimizda/surdurulebilirlik-ahsap.jpg" alt="Sürdürülebilir Ahşap Malzeme" width="1200" height="800" class="rounded-lg shadow-xl w-full h-auto">
                </div>
            </div>
        </section>

        <section class="bg-slate-50">
            <div class="container mx-auto px-6 py-20">
                <div class="grid md:grid-cols-2 gap-10">

                    <div class="bg-white p-8 rounded-lg shadow-lg border border-gray-200" data-aos="fade-up">
                        <div class="flex items-center mb-4">
                            <div
                                class="bg-blue-100 text-blue-600 rounded-full w-12 h-12 flex items-center justify-center flex-shrink-0 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </div>
                            <h3 class="text-3xl font-poppins font-bold text-gray-800">Misyonumuz</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            {{ settings.about_mission_paragraph || 'İnsanların bir araya geldiği en değerli anlara, tutkuyla tasarlanmış mobilyalarla ortak olmak. Sadece birer eşya değil, zanaatkarlık ve kaliteyle yoğrulmuş, yıllara meydan okuyan anı taşıyıcıları üretmek için varız. Müşterilerimizin yaşam alanlarını, fonksiyonel estetikle zenginleştirmeyi ve sosyal bağların kurulduğu sıcak mekanlar yaratmayı hedefleriz.' }}
                        </p>
                    </div>

                    <div class="bg-white p-8 rounded-lg shadow-lg border border-gray-200" data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="flex items-center mb-4">
                            <div
                                class="bg-blue-100 text-blue-600 rounded-full w-12 h-12 flex items-center justify-center flex-shrink-0 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M5.636 18.364a9 9 0 010-12.728m12.728 0a9 9 0 010 12.728m-9.9-2.829a5 5 0 010-7.07m7.072 0a5 5 0 010 7.07M12 6v.01M12 12v.01M12 18v.01" />
                                </svg>
                            </div>
                            <h3 class="text-3xl font-poppins font-bold text-gray-800">Vizyonumuz</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            {{ settings.about_vision_paragraph || `Türkiye'de ve çevre coğrafyalarda, "kaliteli ve samimi buluşma alanları" dendiğinde akla ilk gelen, ilham veren marka olmak. Sadece mobilya satan bir firma olmanın ötesine geçerek, sürdürülebilir üretim anlayışımız, yenilikçi tasarımlarımız ve müşteri odaklı yaklaşımımızla, insanların hayatına değer katan bir topluluk ve yaşam tarzı sembolü haline gelmektir.` }}
                        </p>
                    </div>

                </div>
            </div>
        </section>

        <section class="container mx-auto px-6 py-20 text-center">
            <h3 class="text-3xl font-poppins font-bold text-gray-800 mb-2" data-aos="fade-up">Temel Değerlerimiz</h3>
            <p class="text-gray-600 mb-12 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">Bize her adımda yol
                gösteren prensiplerimiz.</p>
            <div class="grid md:grid-cols-3 gap-12">
                <div data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="bg-blue-600 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-poppins font-bold text-gray-800">Zamansız Tasarım ve Dayanıklılık</h4>
                    <p class="mt-2 text-gray-600">Modası geçmeyen estetiği, yıllara meydan okuyan sağlam malzemelerle
                        birleştirerek, nesiller boyu kullanılacak mobilyalar üretiyoruz.</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="300">
                    <div
                        class="bg-blue-600 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-poppins font-bold text-gray-800">Fonksiyonel Estetik</h4>
                    <p class="mt-2 text-gray-600">Güzelliğin kullanışlılıkla bir bütün olduğuna inanıyoruz. Her
                        tasarımımız, hayatınızı kolaylaştıran akıllı çözümler sunar.</p>
                </div>
                <div data-aos="fade-up" data-aos-delay="400">
                    <div
                        class="bg-blue-600 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-poppins font-bold text-gray-800">Yaşam Alanlarına Tutku</h4>
                    <p class="mt-2 text-gray-600">İşimizi bir tutkuyla yapıyoruz. Mekanları sadece mobilyayla değil,
                        mutluluk ve sıcak anılarla doldurmayı hedefliyoruz.</p>
                </div>
            </div>
        </section>

        <section class="py-20 bg-slate-50">
            <div class="container mx-auto px-6">
                <div class="bg-white rounded-lg shadow-xl overflow-hidden" data-aos="fade-up">
                    <div class="grid md:grid-cols-5 items-center">
                        <div class="md:col-span-3 p-12">
                            <h3 class="text-3xl md:text-4xl font-poppins font-bold text-gray-800">Hayalinizdeki Mekanı
                                Birlikte Kuralım mı?</h3>
                            <p class="text-gray-600 mt-4 leading-relaxed">İster evinizin balkonu, ister işletmenizin
                                bahçesi olsun, size özel çözümlerimizle tanışın. Projeniz hakkında konuşmak için bize
                                bir merhaba deyin.</p>
                            <div class="mt-8">
                                <Link :href="route('contact')"
                                    class="inline-block px-10 py-3 bg-blue-600 text-white font-bold rounded-md shadow-lg hover:bg-blue-700 transition-transform transform hover:scale-105 duration-300 text-lg">
                                İletişime Geçin
                                </Link>
                            </div>
                        </div>
                        <div class="md:col-span-2 h-full hidden md:block">
                            <!-- Suggested dimensions: 800x600px (or aspect ratio 4:3) -->
                            <img src="/images/about/cta-gorsel.jpg" alt="Estetik bir mobilya detayı" width="800" height="600" class="h-full w-full object-cover">
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </AppLayout>
</template>
