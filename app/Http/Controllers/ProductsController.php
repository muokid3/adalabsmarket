<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function category_products($category_id){

        $category = Category::find($category_id);
        $products = Product::where('category_id',$category_id)->paginate(12);
        $categories = Category::all();

        $categoryName = is_null($category) ? "None" : $category->category_name;

//        $productsCount = Product::where('category_id',$category_id)->count();

        return view('category_products')->with([
            'products' => $products,
            'productsCount' => $products->count(),
            'categories' => $categories,
            'categoryName' => $categoryName
        ]);
    }


    public function all_products(){

        $products = Product::orderBy('id','desc')->paginate(12);
        $featuredProducts = Product::where('is_featured',true)->get();
        $categories = Category::all();


//        $productsCount = Product::where('category_id',$category_id)->count();

        return view('all_products')->with([
            'products' => $products,
            'productsCount' => $products->count(),
            'categories' => $categories,
            'featuredProducts' => $featuredProducts,
        ]);
    }
}
