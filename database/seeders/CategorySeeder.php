<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryNames = Category::AVAILABLE_CATEGORIES;

        foreach ($categoryNames as $name) {
            $newCategory = new Category;
            $newCategory->name = $name;
            $newCategory->save();
        }
    }
}
