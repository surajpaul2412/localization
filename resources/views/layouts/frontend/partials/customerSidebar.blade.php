<div class="d-block border rounded bg-white">
	<div class="dashboard_author px-2 py-5">
	    <div class="dash_auth_thumb circle p-1 border d-inline-flex mx-auto mb-2">
	        <img src="{{asset('images/avatar.jpg')}}" class="img-fluid circle" width="100" alt="" />
			<!-- <img src="{{asset(Auth::user()->avatar)}}" class="img-fluid circle" width="100" alt="" /> -->
	    </div>
	    <div class="dash_caption">
	        <h4 class="fs-md ft-medium mb-0 lh-1">{{Auth::user()->name}}</h4>
	    </div>
	</div>

	<div class="dashboard_author">
	    <h4 class="px-3 py-2 mb-0 lh-2 gray fs-sm ft-medium text-muted text-uppercase text-left">{{dynamicLang('Navigation')}}</h4>
	    <ul class="dahs_navbar">
	        <li>
	        	<a href="{{route('customer.order')}}" class="{{ Request::is('customer/my-booking*') ? 'active' : '' }}"><i class="fa fa-fw fa-calendar me-2"></i>{{dynamicLang('Bookings')}} </a>
	        </li>
	        <li>
	        	<a href="{{route('wishlist')}}" class="{{ Request::is('wishlist') ? 'active' : '' }}">
	        		<i class="fa fa-fw fa-heart me-2"></i>{{dynamicLang('Wishlist')}}
	        	</a>
	        </li>
	        <li>
	        	<a href="{{route('customer.profile')}}" class="{{ Request::is('customer/profile*') ? 'active' : '' }}"><i class="fa fa-fw fa-user me-2"></i>{{dynamicLang('Profile Info')}}</a>
	        </li>
	        <li>
	        	<a href="{{route('customer.address')}}" class="{{ Request::is('customer/address*') ? 'active' : '' }}"><i class="fa fa-fw fa-map me-2"></i>{{dynamicLang('Address')}}</a>
	        </li> 
	        <li>
	        	<!-- <a href="authentication-email.php"><i class="fa fa-fw fa-sign-out me-2"></i>Log Out</a> -->
	        	<a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    <i class="fa fa-fw fa-sign-out me-2"></i> {{ dynamicLang('Logout') }}
                                </a>
	        </li>
	    </ul>
	</div>
</div>