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
        for ($i = 1; $i <= 40; $i++) {
            $products[] = [
                'title' => json_encode([
                    'am' => 'Ապրանք ' . $i,
                    'en' => 'Product ' . $i,
                    'ru' => 'Продукт ' . $i,
                ]),
                'description' => json_encode([
                    'am' => 'Նկարագրություն ապրանքի համար ' . $i,
                    'en' => 'Description for product ' . $i,
                    'ru' => 'Описание для продукта ' . $i,
                ]),
                'price' => rand(100, 1000),
                'count' => rand(1, 50),
                'images' => json_encode([
                    "products/image.jpg"
                ]),
                'is_published' => rand(0, 1),
                'is_private' => rand(0, 1),
                'category_id' => rand(1, 2),
            ];
        }
        return $products;
    }
}
