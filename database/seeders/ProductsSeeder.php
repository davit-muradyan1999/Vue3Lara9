<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert($this->generateProducts());
    }

    private function generateProducts(): array
    {
        $products = [];
        for ($i = 1; $i <= 20; $i++) {
            $products[] = [
                'title' => 'Product ' . $i,
                'description' => 'Description for product ' . $i,
                'price' => rand(100, 1000),
                'count' => rand(1, 50),
                'images' => json_encode([
                    'https://via.placeholder.com/150',
                    'https://via.placeholder.com/200'
                ]),
                'is_published' => rand(0, 1),
                'is_private' => rand(0, 1),
                'category_id' => rand(1, 5),
            ];
        }
        return $products;
    }
}
