<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart(){

        $cart = Cart::where('user_id',auth()->user()->id)->first();


        return view('cart')->with([
            'cart' => $cart,
        ]);
    }
}
