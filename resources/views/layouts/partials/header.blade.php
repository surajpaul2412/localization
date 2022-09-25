<div id="page">		
    <header class="header">
        <div id="preloader"><div data-loader="circle-side"></div></div>
        <!-- /Page Preload --> 
        <div class="top-menu">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <div id="logo" class="">
                        <a href="./">
                        <img src="{{asset('images/logo.png')}}" alt="" class="logo_normal" />
                        <img src="{{asset('images/logo.png')}}" alt="" class="logo_sticky" /> 
                        </a>
                    </div>
                    <ul class="top-right-area m-0 d-flex justify-content-between align-items-center">  
                        <li>
                            <a href="wishlist.php" class="wishlist_bt_top" title="Your wishlist">
                                <span class="icon me-lg-1"><i class="icon_heart_alt"></i></span>
                                <span class="text d-none d-lg-block">Wishlist</span> 
                            </a>
                        </li>
                        <li>
                            <a href="cart.php" class="cart-menu-btn" title="Cart">
                                <span class="icon me-lg-1"><i class="icon_cart_alt"></i></span>
                                <span class="text d-none d-lg-block">Cart</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('login')}}" class="login" title="Sign In">
                                <span class="icon me-lg-1"><i class="icon_lock_alt"></i></span>
                                <span class="text d-none d-lg-block">Sign In</span>  
                            </a>
                        </li> 
                        <li class="d-none d-lg-block"><a href="{{route('register')}}" class="btn_1 btn-sm">Sign Up</a></li>
                        <li class="d-none d-lg-block">
                            <select class="form-currency form-control">
                                <option value="inr" selected>₹ INR</option>
                                <option value="usd">$ USD</option>
                                <option value="euro">€ EURO</option>
                                <option value="RUB">₽ RUB</option>
                            </select>
                        </li> 
                    </ul>
                </div>
            </div>
        </div>
        <!-- /top_menu -->        
        <!-- <a href="#menu" class="btn_mobile"></a> -->
        <nav id="menu" class="main-menu"></nav>
    </header>
    <!-- /header -->