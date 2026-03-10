<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Plushies', 'description' => 'Soft and cuddly plush toys for all ages'],
            ['name' => 'Keychains', 'description' => 'Cute decorative keychains and accessories'],
            ['name' => 'Stickers', 'description' => 'Collectible sticker packs and sheets'],
            ['name' => 'Art Illustrations', 'description' => 'Original digital and physical art pieces'],
            ['name' => 'Collectibles', 'description' => 'Limited edition collectible items'],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
            ]);
        }
    }
}