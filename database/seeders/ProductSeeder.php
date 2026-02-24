<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Sakuya Plushie',
            'description' => 'A soft fumo of Sakuya Izayoi from Touhou Project.',
            'category' => 'Plushies',
            'price' => 25.00,
            'stock_quantity' => 50
        ]);
    }
}
