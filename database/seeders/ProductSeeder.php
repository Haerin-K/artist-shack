<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // ----- PLUSHIES -----
            ['name' => 'Sakuya Plushie', 'description' => 'A soft fumo of Sakuya Izayoi from Touhou Project. Perfect for collectors.', 'category' => 'Plushies', 'price' => 25.00, 'stock' => 50, 'sku' => 'PLU-SAK-001', 'images' => ['placeholder/plushie-1.jpg']],
            ['name' => 'Reimu Plushie', 'description' => 'Adorable plushie of Reimu Hakurei with her signature red bow and hair accessory.', 'category' => 'Plushies', 'price' => 25.00, 'stock' => 45, 'sku' => 'PLU-REI-001', 'images' => ['placeholder/plushie-2.jpg']],
            ['name' => 'Marisa Plushie', 'description' => 'Cute plushie of Marisa Kirisame with her iconic witch hat and hair.', 'category' => 'Plushies', 'price' => 25.00, 'stock' => 40, 'sku' => 'PLU-MAR-001', 'images' => ['placeholder/plushie-3.jpg']],
            ['name' => 'Patchouli Plushie', 'description' => 'Soft plushie of the librarian Patchouli Knowledge with her signature dress.', 'category' => 'Plushies', 'price' => 28.00, 'stock' => 30, 'sku' => 'PLU-PAT-001', 'images' => ['placeholder/plushie-4.jpg']],
            ['name' => 'Flandre Plushie', 'description' => 'Fluffy plushie of Flandre Scarlet the vampire with lots of adorable details.', 'category' => 'Plushies', 'price' => 30.00, 'stock' => 25, 'sku' => 'PLU-FLA-001', 'images' => ['placeholder/plushie-5.jpg']],
            ['name' => 'Youmu Plushie', 'description' => 'Soft plushie of Youmu Konpaku with her sword and elegant design.', 'category' => 'Plushies', 'price' => 27.00, 'stock' => 35, 'sku' => 'PLU-YOU-001', 'images' => ['placeholder/plushie-6.jpg']],
            ['name' => 'Ran Plushie', 'description' => 'Adorable nine-tailed fox Ran plushie from Touhou Project.', 'category' => 'Plushies', 'price' => 32.00, 'stock' => 20, 'sku' => 'PLU-RAN-001', 'images' => ['placeholder/plushie-7.jpg']],

            // ----- STICKERS -----
            ['name' => 'Genshin Impact Sticker Pack', 'description' => 'Set of 20 high-quality glossy stickers featuring various Genshin Impact characters.', 'category' => 'Stickers', 'price' => 8.99, 'stock' => 100, 'sku' => 'STI-GEN-001', 'images' => ['placeholder/sticker-1.jpg']],
            ['name' => 'Anime Aesthetic Stickers', 'description' => '15 Beautiful pastel-colored aesthetic stickers perfect for decoration.', 'category' => 'Stickers', 'price' => 7.99, 'stock' => 120, 'sku' => 'STI-AES-001', 'images' => ['placeholder/sticker-2.jpg']],
            ['name' => 'Retro Gaming Stickers', 'description' => '25 Classic retro video game character stickers from 80s and 90s games.', 'category' => 'Stickers', 'price' => 9.99, 'stock' => 80, 'sku' => 'STI-RET-001', 'images' => ['placeholder/sticker-3.jpg']],
            ['name' => 'Meme Sticker Bundle', 'description' => '30 Hilarious meme stickers perfect for your laptop or water bottle.', 'category' => 'Stickers', 'price' => 10.99, 'stock' => 150, 'sku' => 'STI-MEM-001', 'images' => ['placeholder/sticker-4.jpg']],
            ['name' => 'Nature Stickers', 'description' => '20 Beautiful nature-themed eco-friendly stickers with plants and animals.', 'category' => 'Stickers', 'price' => 8.49, 'stock' => 90, 'sku' => 'STI-NAT-001', 'images' => ['placeholder/sticker-5.jpg']],
            ['name' => 'Kawaii Sticker Pack', 'description' => '25 Cute and colorful kawaii-style stickers with smiling faces and cute creatures.', 'category' => 'Stickers', 'price' => 9.49, 'stock' => 110, 'sku' => 'STI-KAW-001', 'images' => ['placeholder/sticker-6.jpg']],
            ['name' => 'Holographic Stickers', 'description' => '15 Eye-catching holographic stickers that shimmer and shine.', 'category' => 'Stickers', 'price' => 11.99, 'stock' => 70, 'sku' => 'STI-HOL-001', 'images' => ['placeholder/sticker-7.jpg']],

            // ----- KEYCHAINS -----
            ['name' => 'Acrylic Keychain - Cat', 'description' => 'Cute cat-shaped acrylic keychain with UV printing and premium finish.', 'category' => 'Keychains', 'price' => 5.99, 'stock' => 200, 'sku' => 'KEY-CAT-001', 'images' => ['placeholder/keychain-1.jpg']],
            ['name' => 'Acrylic Keychain - Moon', 'description' => 'Crescent moon-shaped glittery acrylic keychain perfect for night owls.', 'category' => 'Keychains', 'price' => 6.49, 'stock' => 180, 'sku' => 'KEY-MOO-001', 'images' => ['placeholder/keychain-2.jpg']],
            ['name' => 'Metal Keychain - Music Note', 'description' => 'Durable metal keychain shaped like a musical note for music lovers.', 'category' => 'Keychains', 'price' => 7.99, 'stock' => 160, 'sku' => 'KEY-MUS-001', 'images' => ['placeholder/keychain-3.jpg']],
            ['name' => 'Enamel Pin Keychain Set', 'description' => 'Set of 3 colorful enamel pin keychains with different designs.', 'category' => 'Keychains', 'price' => 12.99, 'stock' => 140, 'sku' => 'KEY-ENA-001', 'images' => ['placeholder/keychain-4.jpg']],
            ['name' => 'Resin Keychain - Galaxy', 'description' => 'Beautiful resin keychain with a mesmerizing galaxy design inside.', 'category' => 'Keychains', 'price' => 8.99, 'stock' => 120, 'sku' => 'KEY-GAL-001', 'images' => ['placeholder/keychain-5.jpg']],
            ['name' => 'Leather Keychain - Minimalist', 'description' => 'Premium leather keychain with minimalist design and gold accents.', 'category' => 'Keychains', 'price' => 14.99, 'stock' => 75, 'sku' => 'KEY-LET-001', 'images' => ['placeholder/keychain-6.jpg']],
            ['name' => 'Wooden Keychain - Forest', 'description' => 'Eco-friendly wooden keychain with forest engraving and natural finish.', 'category' => 'Keychains', 'price' => 9.99, 'stock' => 90, 'sku' => 'KEY-FOR-001', 'images' => ['placeholder/keychain-7.jpg']],
            ['name' => 'Charm Keychain Collection', 'description' => 'Set of 4 cute charm keychains in different colors and designs.', 'category' => 'Keychains', 'price' => 13.49, 'stock' => 85, 'sku' => 'KEY-CHA-001', 'images' => ['placeholder/keychain-8.jpg']],
        ];

        foreach ($products as $productData) {
            $categoryName = $productData['category'];
            $category = Category::where('name', $categoryName)->first();

            if ($category) {
                Product::updateOrCreate(
                    ['name' => $productData['name']],
                    [
                        'category_id' => $category->id,
                        'slug' => Str::slug($productData['name']),
                        'description' => $productData['description'],
                        'price' => $productData['price'],
                        'stock' => $productData['stock'],
                        'sku' => $productData['sku'],
                        'display_image' => $productData['images'][0] ?? null,
                        'is_active' => true,
                        'images' => $productData['images'] ?? [],
                    ]
                );
            }
        }
    }
}
