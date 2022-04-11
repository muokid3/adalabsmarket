<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $featuredProducts = Product::where('is_featured', true)->get();
        $latestProducts = Product::orderBy('id', 'desc')->limit(3)->get();
        return view('home')->with([
           'featuredProducts' => $featuredProducts,
           'latestProducts' => $latestProducts
        ]);
    }
}
