<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    private array $categories = [
        ['id' => 1, 'name' => 'Linux'],
        ['id' => 2, 'name' => 'Bash'],
        ['id' => 3, 'name' => 'Docker'],
        ['id' => 4, 'name' => 'SQL'],
        ['id' => 5, 'name' => 'CMS'],
        ['id' => 6, 'name' => 'Code'],
        ['id' => 7, 'name' => 'DevOPS'],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->categories as $category) {
            $category['created_at'] = date('Y-m-d H:i:s');
            DB::table('categories')->insert($category);
        }
    }
}
