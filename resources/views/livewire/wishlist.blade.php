<a href="{{route('wishlist')}}" class="wishlist_bt_top" title="Your wishlist">
    <span class="icon me-lg-1"><i class="icon_heart_alt"></i></span>
    <span class="text d-none d-lg-block">
        Wishlist
        @if($data != 0)
            ( {{$data}} )
        @endif
    </span> 
</a>