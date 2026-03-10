<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Plushies
            ['name' => 'Sakuya Plushie', 'description' => 'A soft fumo of Sakuya Izayoi from Touhou Project.', 'category' => 'Plushies', 'price' => 25.00, 'stock_quantity' => 50],
            ['name' => 'Reimu Plushie', 'description' => 'Adorable plushie of Reimu Hakurei with her signature red bow.', 'category' => 'Plushies', 'price' => 25.00, 'stock_quantity' => 45],
            ['name' => 'Marisa Plushie', 'description' => 'Cute plushie of Marisa Kirisame with her witch hat.', 'category' => 'Plushies', 'price' => 25.00, 'stock_quantity' => 40],
            ['name' => 'Patchouli Plushie', 'description' => 'Soft plushie of the librarian Patchouli Knowledge.', 'category' => 'Plushies', 'price' => 28.00, 'stock_quantity' => 30],
            ['name' => 'Flandre Plushie', 'description' => 'Fluffly plushie of Flandre Scarlet the vampire.', 'category' => 'Plushies', 'price' => 30.00, 'stock_quantity' => 25],
            ['name' => 'Youmu Plushie', 'description' => 'Soft plushie of Youmu Konpaku with her sword.', 'category' => 'Plushies', 'price' => 27.00, 'stock_quantity' => 35], // new sample

            // Stickers
            ['name' => 'Genshin Impact Sticker Pack', 'description' => 'Set of 20 high-quality glossy stickers featuring various characters.', 'category' => 'Stickers', 'price' => 8.99, 'stock_quantity' => 100],
            ['name' => 'Anime Aesthetic Stickers', 'description' => '15 Beautiful pastel-colored aesthetic stickers.', 'category' => 'Stickers', 'price' => 7.99, 'stock_quantity' => 120],
            ['name' => 'Retro Gaming Stickers', 'description' => '25 Classic retro video game character stickers.', 'category' => 'Stickers', 'price' => 9.99, 'stock_quantity' => 80],
            ['name' => 'Meme Sticker Bundle', 'description' => '30 Hilarious meme stickers for your laptop or water bottle.', 'category' => 'Stickers', 'price' => 10.99, 'stock_quantity' => 150],
            ['name' => 'Nature Stickers', 'description' => '20 Beautiful nature-themed eco-friendly stickers.', 'category' => 'Stickers', 'price' => 8.49, 'stock_quantity' => 90],
            ['name' => 'Kawaii Sticker Pack', 'description' => '25 Cute and colorful kawaii-style stickers.', 'category' => 'Stickers', 'price' => 9.49, 'stock_quantity' => 110], // new sample

            // Keychains
            ['name' => 'Acrylic Keychain - Cat', 'description' => 'Cute cat-shaped acrylic keychain with UV printing.', 'category' => 'Keychains', 'price' => 5.99, 'stock_quantity' => 200],
            ['name' => 'Acrylic Keychain - Moon', 'description' => 'Crescent moon-shaped glittery acrylic keychain.', 'category' => 'Keychains', 'price' => 6.49, 'stock_quantity' => 180],
            ['name' => 'Metal Keychain - Music Note', 'description' => 'Durable metal keychain shaped like a music note.', 'category' => 'Keychains', 'price' => 7.99, 'stock_quantity' => 160],
            ['name' => 'Enamel Pin Keychain Set', 'description' => 'Set of 3 colorful enamel pin keychains.', 'category' => 'Keychains', 'price' => 12.99, 'stock_quantity' => 140],
            ['name' => 'Resin Keychain - Galaxy', 'description' => 'Beautiful resin keychain with galaxy design.', 'category' => 'Keychains', 'price' => 8.99, 'stock_quantity' => 120],
            ['name' => 'Leather Keychain - Minimalist', 'description' => 'Premium leather keychain with minimalist design and gold accents.', 'category' => 'Keychains', 'price' => 14.99, 'stock_quantity' => 75],
            ['name' => 'Wooden Keychain - Forest', 'description' => 'Eco-friendly wooden keychain with forest engraving.', 'category' => 'Keychains', 'price' => 9.99, 'stock_quantity' => 90], // new sample
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['name' => $product['name']], // unique identifier
                $product                       // values to update or insert
            );
        }
    }
}