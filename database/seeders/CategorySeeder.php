<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $category = new Category();
        $category->category_name = "Vegetables"; //id 1
        $category->save();

        $category = new Category();
        $category->category_name = "Fast Food"; //id 2
        $category->save();

        $category = new Category();
        $category->category_name = "Fruits"; //id 3
        $category->save();

        $category = new Category();
        $category->category_name = "Meat"; //id 4
        $category->save();

    }
}
