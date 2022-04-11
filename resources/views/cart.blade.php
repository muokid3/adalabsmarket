@extends('layouts.app')

@section('content')


    <section class="breadcrumb-section set-bg" data-setbg="{{url('img/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="{{url('/')}}">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @if(!is_null($cart))
                                @foreach($cart->items as $cartItem)
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img src="{{$cartItem->product->image_url}}" width="100" alt="">
                                            <h5>{{$cartItem->product->product_name}}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            Ksh. {{number_format($cartItem->product->price)}}
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="text" value="{{$cartItem->quantity}}">
                                                </div>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            Ksh. {{number_format($cartItem->product->price * $cartItem->quantity)}}
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <span class="icon_close"></span>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="{{url('/shop')}}" class="primary-btn cart-btn">CONTINUE SHOPPING</a>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            @if(!is_null($cart))
{{--                                <li>Subtotal <span>Ksh. {{}}</span></li>--}}
                                <li>Total <span>Ksh. {{number_format($cart->items->sum('total_amount'))}}</span></li>
                            @endif
                        </ul>
                        <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
