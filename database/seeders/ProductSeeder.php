<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $masalarCategory = ProductCategory::where('slug', 'masalar')->first();
        $sandalyelerCategory = ProductCategory::where('slug', 'sandalyeler')->first();
        $bahceMobilyasiCategory = ProductCategory::where('slug', 'bahce-mobilyasi')->first();

        if ($masalarCategory) {
            $masaProducts = [
                [
                    'name' => 'Modern Ahşap Masa',
                    'slug' => 'modern-ahsap-masa',
                    'description' => 'Doğal ahşap malzemeden üretilen, modern tasarımıyla dikkat çeken yemek masası. 6 kişilik kullanım için ideal boyutlarda tasarlanmış.',
                    'price' => 1850.00,
                    'product_category_id' => $masalarCategory->id,
                    'image_url' => 'https://images.unsplash.com/photo-1533090481720-856c6e7c6c54?w=400',
                    'colors' => [
                        ['name' => 'Doğal Ahşap', 'value' => '#DEB887', 'hex' => '#DEB887'],
                        ['name' => 'Koyu Ahşap', 'value' => '#8B4513', 'hex' => '#8B4513']
                    ],
                    'attributes' => [
                        'Malzeme' => 'Doğal Ahşap',
                        'Boyut' => '180x90x75 cm',
                        'Kişi Kapasitesi' => '6 Kişi',
                        'Garanti' => '2 Yıl'
                    ],
                    'is_active' => true
                ],
                [
                    'name' => 'Cam Yemek Masası',
                    'slug' => 'cam-yemek-masasi',
                    'description' => 'Şık cam tablası ve metal ayaklı modern yemek masası. Kolay temizlenir ve dayanıklıdır.',
                    'price' => 2200.00,
                    'product_category_id' => $masalarCategory->id,
                    'image_url' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=400',
                    'colors' => [
                        ['name' => 'Şeffaf', 'value' => '#FFFFFF', 'hex' => '#FFFFFF'],
                        ['name' => 'Füme', 'value' => '#808080', 'hex' => '#808080']
                    ],
                    'attributes' => [
                        'Malzeme' => 'Temperli Cam + Metal',
                        'Boyut' => '160x80x75 cm',
                        'Kişi Kapasitesi' => '4 Kişi',
                        'Garanti' => '2 Yıl'
                    ],
                    'is_active' => true
                ],
                [
                    'name' => 'Rustik Çiftlik Masası',
                    'slug' => 'rustik-ciftlik-masasi',
                    'description' => 'Vintage tarzı rustik çiftlik masası. Geniş aileler ve toplantılar için mükemmel.',
                    'price' => 2750.00,
                    'product_category_id' => $masalarCategory->id,
                    'image_url' => 'https://images.unsplash.com/photo-1506439773649-6e0eb8cfb237?w=400',
                    'colors' => [
                        ['name' => 'Rustik Kahverengi', 'value' => '#8B4513', 'hex' => '#8B4513'],
                        ['name' => 'Antik Beyaz', 'value' => '#FEF3C7', 'hex' => '#FEF3C7']
                    ],
                    'attributes' => [
                        'Malzeme' => 'Eskitilmiş Ahşap',
                        'Boyut' => '220x100x78 cm',
                        'Kişi Kapasitesi' => '8 Kişi',
                        'Garanti' => '3 Yıl'
                    ],
                    'is_active' => true
                ]
            ];

            foreach ($masaProducts as $product) {
                Product::create($product);
            }
        }

        if ($sandalyelerCategory) {
            $sandalyeProducts = [
                [
                    'name' => 'İskandinav Sandalye',
                    'slug' => 'iskandinav-sandalye',
                    'description' => 'Minimalist İskandinav tarzı sandalye. Ergonomik tasarım ve yüksek kalite malzeme.',
                    'price' => 750.00,
                    'product_category_id' => $sandalyelerCategory->id,
                    'image_url' => 'https://images.unsplash.com/photo-1592078615290-033ee584e267?w=400',
                    'colors' => [
                        ['name' => 'Açık Gri', 'value' => '#D3D3D3', 'hex' => '#D3D3D3'],
                        ['name' => 'Koyu Gri', 'value' => '#696969', 'hex' => '#696969'],
                        ['name' => 'Bej', 'value' => '#D2B48C', 'hex' => '#D2B48C']
                    ],
                    'attributes' => [
                        'Malzeme' => 'Kayın Ahşabı + Kumaş',
                        'Boyut' => '45x52x82 cm',
                        'Ağırlık' => '4.5 kg',
                        'Garanti' => '2 Yıl'
                    ],
                    'is_active' => true
                ],
                [
                    'name' => 'Deri Berjer Koltuk',
                    'slug' => 'deri-berjer-koltuk',
                    'description' => 'Gerçek deri kaplama lüks berjer koltuk. Oturma odasının göz bebeği.',
                    'price' => 3200.00,
                    'product_category_id' => $sandalyelerCategory->id,
                    'image_url' => 'https://images.unsplash.com/photo-1506439773649-6e0eb8cfb237?w=400',
                    'colors' => [
                        ['name' => 'Koyu Kahverengi', 'value' => '#654321', 'hex' => '#654321'],
                        ['name' => 'Siyah', 'value' => '#000000', 'hex' => '#000000']
                    ],
                    'attributes' => [
                        'Malzeme' => 'Gerçek Deri + Ahşap',
                        'Boyut' => '85x90x95 cm',
                        'Ağırlık' => '25 kg',
                        'Garanti' => '5 Yıl'
                    ],
                    'is_active' => true
                ],
                [
                    'name' => 'Modern Bar Taburesi',
                    'slug' => 'modern-bar-taburesi',
                    'description' => 'Ayarlanabilir yükseklik özellikli modern bar taburesi. Mutfak tezgahları için ideal.',
                    'price' => 450.00,
                    'product_category_id' => $sandalyelerCategory->id,
                    'image_url' => 'https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=400',
                    'colors' => [
                        ['name' => 'Siyah', 'value' => '#000000', 'hex' => '#000000'],
                        ['name' => 'Beyaz', 'value' => '#FFFFFF', 'hex' => '#FFFFFF'],
                        ['name' => 'Kırmızı', 'value' => '#DC2626', 'hex' => '#DC2626']
                    ],
                    'attributes' => [
                        'Malzeme' => 'Metal + Suni Deri',
                        'Boyut' => '40x40x60-80 cm',
                        'Özellik' => 'Yükseklik Ayarlanabilir',
                        'Garanti' => '1 Yıl'
                    ],
                    'is_active' => true
                ]
            ];

            foreach ($sandalyeProducts as $product) {
                Product::create($product);
            }
        }

        if ($bahceMobilyasiCategory) {
            $bahceProducts = [
                [
                    'name' => 'Bahçe Oturma Grubu',
                    'slug' => 'bahce-oturma-grubu',
                    'description' => 'Hava koşullarına dayanıklı rattan bahçe oturma grubu. 4 kişilik set.',
                    'price' => 4500.00,
                    'product_category_id' => $bahceMobilyasiCategory->id,
                    'image_url' => 'https://images.unsplash.com/photo-1617103996533-516009a4c252?w=400',
                    'attributes' => [
                        'Malzeme' => 'Sentetik Rattan',
                        'Renk' => 'Kahverengi',
                        'Set İçeriği' => '1 Kanepe + 2 Koltuk + 1 Sehpa',
                        'Kişi Kapasitesi' => '4 Kişi',
                        'Özellik' => 'Su Geçirmez Minderler',
                        'Garanti' => '2 Yıl'
                    ],
                    'is_active' => true
                ],
                [
                    'name' => 'Ahşap Bahçe Masası',
                    'slug' => 'ahsap-bahce-masasi',
                    'description' => 'Teak ahşabından üretilmiş bahçe masası. Doğal hava koşullarına dayanıklı.',
                    'price' => 2850.00,
                    'product_category_id' => $bahceMobilyasiCategory->id,
                    'image_url' => 'https://images.unsplash.com/photo-1506439773649-6e0eb8cfb237?w=400',
                    'attributes' => [
                        'Malzeme' => 'Teak Ahşabı',
                        'Renk' => 'Doğal Teak',
                        'Boyut' => '200x100x75 cm',
                        'Kişi Kapasitesi' => '6-8 Kişi',
                        'Özellik' => 'Hava Koşullarına Dayanıklı',
                        'Garanti' => '3 Yıl'
                    ],
                    'is_active' => true
                ],
                [
                    'name' => 'Katlanır Bahçe Sandalyesi',
                    'slug' => 'katlanir-bahce-sandalyesi',
                    'description' => 'Pratik katlanır bahçe sandalyesi. Kış aylarında kolayca saklanabilir.',
                    'price' => 350.00,
                    'product_category_id' => $bahceMobilyasiCategory->id,
                    'image_url' => 'https://images.unsplash.com/photo-1617103996533-516009a4c252?w=400',
                    'attributes' => [
                        'Malzeme' => 'Alüminyum + Textilene',
                        'Renk' => 'Antrasit',
                        'Boyut' => '56x61x89 cm',
                        'Ağırlık' => '3.2 kg',
                        'Özellik' => 'Katlanabilir',
                        'Garanti' => '1 Yıl'
                    ],
                    'is_active' => true
                ]
            ];

            foreach ($bahceProducts as $product) {
                Product::create($product);
            }
        }

        $this->command->info('Örnek ürünler başarıyla eklendi!');
    }
}