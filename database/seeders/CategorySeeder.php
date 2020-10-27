<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category();
        $category->name = "Aventura";
        $category->save();

        $category = new Category();
        $category->name = "Fantasía";
        $category->save();

        $category = new Category();
        $category->name = "Romance";
        $category->save();

        $category = new Category();
        $category->name = "Terror";
        $category->save();
    }
}
