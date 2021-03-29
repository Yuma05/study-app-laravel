<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Auth::loginUsingId(2);

        $categories = [
            [
                'name' => 'Category A',
                'image_src' => 'https://picsum.photos/id/1015/300/300',
            ],
            [
                'name' => 'Category B',
                'image_src' => 'https://picsum.photos/id/1036/300/300',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
