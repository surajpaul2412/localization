<!--[ navigation menu ] start --> 
<nav class="pcoded-navbar menu-light menupos-fixed">
    <div class="navbar-wrapper  ">
        <div class="navbar-content scroll-div"> 
            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label> 
                </li>

                @if(Request::is('admin*'))
                <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}"><a href="{{route('admin.dashboard')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a></li>  

                <li class="nav-item {{ Request::is('admin/users') ? 'active' : '' }}"><a href="{{route('admin.users')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Users</span></a></li> 

                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-navigation"></i></span><span class="pcoded-mtext">Manage Tours</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="{{route('admin.tours')}}">All Tours</a></li>
                        <li><a href="{{route('admin.category')}}">Categories</a></li>
                        <li><a href="{{route('admin.amenities')}}">Amenities</a></li>
                        <li><a href="{{route('admin.activities')}}">Activities</a></li>
                    </ul>
                </li>
                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="feather icon-map-pin"></i></span><span class="pcoded-mtext">Manage Location</span></a>
                    <ul class="pcoded-submenu"> 
                        <li><a href="{{route('admin.country')}}">Country</a></li> 
                        <li><a href="{{route('admin.city')}}">City</a></li>   
                    </ul>
                </li>  

                <li class="nav-item {{ Request::is('admin/bookings') ? 'active' : '' }}">
                    <a href="{{route('admin.bookings')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-package"></i></span><span class="pcoded-mtext">Manage Bookings</span></a> 
                </li>
                
                <li class="nav-item {{ Request::is('admin/pages') ? 'active' : '' }}">
                    <a href="{{route('admin.pages')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-clipboard"></i></span><span class="pcoded-mtext">Static Pages</span></a> 
                </li>  

                <li class="nav-item {{ Request::is('admin/reviews') ? 'active' : '' }}">
                    <a href="{{route('admin.review')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-star"></i></span><span class="pcoded-mtext">Manage Ratings</span></a> 
                </li>    

                <li class="nav-item pcoded-hasmenu">
                    <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-settings"></i></span><span class="pcoded-mtext">System Settings</span></a>
                    <ul class="pcoded-submenu">
                        <li><a href="general-setting.php">General Settings</a></li> 
                        <li><a href="#">Banners</a></li> 
                        <li><a href="{{route('admin.testimonials')}}">Testimonials</a></li> 
                        <li><a href="{{route('admin.currency')}}">Currency</a></li> 
                        <li><a href="{{route('admin.language')}}">Language</a></li>  
                        <li><a href="{{route('admin.razorpay')}}">Payment Methods (Razorpay)</a></li> 
                        <li><a href="#">Social Links</a></li> 
                    </ul>
                </li>
                @endif

                @if(Request::is('customer*'))
                <li class="nav-item {{ Request::is('customer/dashboard') ? 'active' : '' }}"><a href="" class="nav-link "><span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a></li>  

                <li class="nav-item">
                    <a href="bookings.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-package"></i></span><span class="pcoded-mtext">Bookings</span></a> 
                </li>
                
                <li class="nav-item">
                    <a href="{{route('wishlist')}}" class="nav-link"><span class="pcoded-micon"><i class="feather icon-clipboard"></i></span><span class="pcoded-mtext">Wishlist</span></a> 
                </li>

                <li class="nav-item {{ Request::is('customer/address') ? 'active' : '' }}">
                    <a href="{{route('customer.address')}}" class="nav-link "><span class="pcoded-micon"><i class="feather icon-map"></i></span><span class="pcoded-mtext">Address</span></a> 
                </li>

                <li class="nav-item">
                    <a href="ratings.php" class="nav-link "><span class="pcoded-micon"><i class="feather icon-star"></i></span><span class="pcoded-mtext">Ratings & Reviews</span></a> 
                </li>
                @endif
            </ul> 
            
        </div>
    </div>
</nav>
<!-- [ navigation menu ] end