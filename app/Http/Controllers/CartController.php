<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart(){

        $cart = Cart::where('user_id',auth()->user()->id)->first();


        return view('cart')->with([
            'cart' => $cart,
        ]);
    }

    public function add_to_cart($product_id){

        $product = Product::findOrFail($product_id);


        $cart = Cart::firstOrCreate(
            ['user_id' =>  auth()->user()->id]
        );

        $cartItem = new CartItem();
        $cartItem->cart_id = $cart->id;
        $cartItem->product_id = $product_id;
        $cartItem->quantity = 1;
        $cartItem->total_amount = $product->price * 1;
        $cartItem->save();


        return view('cart')->with([
            'cart' => $cart,
        ]);
    }
}
