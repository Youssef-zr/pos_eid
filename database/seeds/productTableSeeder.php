<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class productTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                "category_id" => "1",
                "ar" => [
                    "title" => "المنتج الأول",
                    "description" => "<p>معلومات عامة عن المنتج</p>"
                ],
                "en" => [
                    "title" => "product one",
                    "description" => "<p>general description about product</p>"
                ],
                "purchase_price" => "125",
                "sale_price" => "256",
                "stock" => "25",
            ],
            [
                "category_id" => "1",
                "ar" => [
                    "title" => "المنتج الثاني",
                    "description" => "<p>معلومات عامة عن المنتج</p>"
                ],
                "en" => [
                    "title" => "product two",
                    "description" => "<p>general description about product</p>"
                ],
                "purchase_price" => "99",
                "sale_price" => "127",
                "stock" => "15",
            ],
            [
                "category_id" => "2",
                "ar" => [
                    "title" => "المنتج الثالث",
                    "description" => "<p>معلومات عامة عن المنتج</p>"
                ],
                "en" => [
                    "title" => "product there",
                    "description" => "<p>general description about product</p>"
                ],
                "purchase_price" => "80",
                "sale_price" => "216",
                "stock" => "520",
            ],
        ];

        foreach ($products as $product) {
            Product::create($product)->save();
        }
    }
}
