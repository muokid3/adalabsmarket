<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function category_products($category_id){

        //$category = Category::find($category_id);
        $products = Product::where('category_id',$category_id)->get();
        $categories = Category::all();

//        $productsCount = Product::where('category_id',$category_id)->count();

        return view('category_products')->with([
            'products' => $products,
            'productsCount' => $products->count(),
            'categories' => $categories
        ]);
    }
}
