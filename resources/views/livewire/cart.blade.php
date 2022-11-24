<a href="{{route('cart')}}" class="cart-menu-btn" title="Cart">
    <span class="icon me-lg-1"><i class="icon_cart_alt"></i></span>
    <span class="text d-none d-lg-block">
        Cart
        @if($data != 0)
            ( {{$data}} )
        @endif
    </span>
</a>