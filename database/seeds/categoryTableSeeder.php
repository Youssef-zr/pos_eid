<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class categoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'ar' => ["name" => "القسم الأول"],
                'en' => ["name" => "category one"]
            ],
            [
                'ar' => ['name' => "القسم الثاني"],
                'en' => ['name' => "category two"]
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category)->save();
        }
    }
}
