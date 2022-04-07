<div id="preloder">
    <div class="loader"></div>
</div>

<div class="humberger__menu__overlay"></div>
<div class="humberger__menu__wrapper">



    <nav class="humberger__menu__nav mobile-menu">
        <ul>
            <li class="active"><a href="index-2.html">Home</a></li>
            <li><a href="shop-grid.html">Shop</a></li>
            <li><a href="#">Pages</a>
                <ul class="header__menu__dropdown">
                    <li><a href="shop-details.html">Shop Details</a></li>
                    <li><a href="shoping-cart.html">Shoping Cart</a></li>
                    <li><a href="checkout.html">Check Out</a></li>
                    <li><a href="blog-details.html">Blog Details</a></li>
                </ul>
            </li>
            <li><a href="blog.html">Blog</a></li>
            <li><a href="contact.html">Contact</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>

</div>


<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="header__logo">
                    <a href="index-2.html"><img src="img/logo.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="{{url('/')}}">Home</a></li>
                        <li><a href="{{url('shop')}}">Shop</a></li>
                        <li><a href="{{url('blog')}}">Blog</a></li>
                        <li><a href="{{url('contact')}}">Contact</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__cart">
                    <ul>
{{--                        <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>--}}
                        <li>
                            <a href="{{url('cart')}}"><i class="fa fa-shopping-bag"></i>
                                <span>
                                    @auth()
                                        {{ optional(optional(\App\Models\Cart::where('user_id',auth()->user()->id)->first())->items)->count() }}
                                    @endauth

                                    @guest()
                                        0
                                    @endguest
                                </span>
                            </a>
                        </li>
                    </ul>
                    <div class="header__cart__price">
                        @guest()
                            <a href="{{url('login')}}"><i class="fa fa-user"></i> Login</a>
                            <a href="{{url('register')}}"><i class="fa fa-phone"></i> Register</a>
                        @endguest

                        @auth()
                            {{ auth()->user()->name }}
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        <div class="humberger__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
</header>
