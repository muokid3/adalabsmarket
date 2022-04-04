<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('products')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $product = new Product();
        $product->category_id = 1;
        $product->product_name = "Brocolli";
        $product->price = 50;
        $product->image_url = "https://domf5oio6qrcr.cloudfront.net/medialibrary/5390/h1218g16207258089583.jpg";
        $product->is_featured = false;
        $product->save();

        $product = new Product();
        $product->category_id = 2;
        $product->product_name = "Chips";
        $product->price = 150;
        $product->image_url = "https://www.funplace.co.ke/wp-content/uploads/2020/07/chips-in-gmcfunplace.jpg";
        $product->is_featured = true;
        $product->save();

        $product = new Product();
        $product->category_id = 3;
        $product->product_name = "Mangoes";
        $product->price = 70;
        $product->image_url = "https://cdn-prod.medicalnewstoday.com/content/images/articles/322/322096/mangoes-chopped-and-fresh.jpg";
        $product->is_featured = true;
        $product->save();

        $product = new Product();
        $product->category_id = 4;
        $product->product_name = "Goat Meat";
        $product->price = 600;
        $product->image_url = "https://static.toiimg.com/thumb/msid-63712829,width-1070,height-580,resizemode-75/63712829,pt-32,y_pad-40/63712829.jpg";
        $product->is_featured = true;
        $product->save();

    }
}
