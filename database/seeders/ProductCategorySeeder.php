<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('product_categories')->where('name', 'deneme')->delete();
        
        $categories = [
            ['name' => 'Masalar', 'slug' => 'masalar'],
            ['name' => 'Sandalyeler', 'slug' => 'sandalyeler'], 
            ['name' => 'Bahçe Mobilyaları', 'slug' => 'bahce-mobilyalari'],
        ];

        foreach ($categories as $category) {
            DB::table('product_categories')->updateOrInsert(
                ['slug' => $category['slug']],
                [
                    'name' => $category['name'],
                    'slug' => $category['slug'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
