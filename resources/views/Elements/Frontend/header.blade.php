<header class="header menu_fixed">
	<div id="preloader"><div data-loader="circle-side"></div></div><!-- /Page Preload -->
	<div id="logo">
		<a href="#">
			<img src="{!! asset('public/img/Frontend/img/logo.png') !!}" data-retina="true" alt="" class="logo_normal">
			<img src="{!! asset('public/img/Frontend/img/logo_sticky.png') !!}" width="150" height="36" data-retina="true" alt="" class="logo_sticky">
		</a>
	</div>
	<ul id="top_menu">
		<li><a href="javascript:;" data-toggle="modal" data-target="#inquirymodal" class="btn_1">Quick Inquiry</a></li> 
	</ul>
	<!-- /top_menu -->
	<a href="#menu" class="btn_mobile">
		<div class="hamburger hamburger--spin" id="hamburger">
			<div class="hamburger-box">
				<div class="hamburger-inner"></div>
			</div>
		</div>
	</a>
	<nav id="menu" class="main-menu">
		<ul>
			<li><span><a href="#0">Home</a></span></li>

			<li>
				<span><a href="#0">India Tour</a></span>
				<ul>
					<li><a href="#">Kerala</a></li>
					<li><a href="#">Himachal</a></li>
					<li><a href="#">Uttarakhand</a></li>
					<li><a href="#">Goa</a></li>
					<li><a href="#">Kashmir</a></li>
					<li><a href="#">Andaman</a></li>
					<li><a href="#">Rajasthan</a></li>
					<li><a href="#">North East India</a></li>
					<li><a href="#">Karnataka</a></li>
				</ul>
			</li>

			<li>
				<span><a href="#0">International Tour</a></span>
				<ul>
					<li><a href="#">Thailand</a></li>
					<li><a href="#">Singapore</a></li>
					<li><a href="#">Sri Lanka</a></li>
					<li><a href="#">Europe</a></li>
					<li><a href="#">Mauritius</a></li>
					<li><a href="#">Maldives</a></li>
					<li><a href="#">Dubai</a></li>
					<li><a href="#">Seychelles</a></li>
					<li><a href="#">Bali</a></li>
					<li><a href="#">New Zealand</a></li>
					<li><a href="#">Switzerland</a></li>
					<li><a href="#">Hong Kong</a></li>
					<li><a href="#">Bali</a></li>
				</ul>
			</li>

			<li>
				<span><a href="#0">Tour by Theme</a></span>
				<ul>

					<li><a href="#">Honeymoon</a></li>
					<li><a href="#">Adventure</a></li>
					<li><a href="#">Family</a></li>
					<li><a href="#">Nature</a></li>
					<li><a href="#">Wildlife</a></li>
					<li><a href="#">Friends</a></li>

				</ul>
			</li>

			<li>
				<span><a href="#0">More Services</a></span>
				<ul>
					<li><a href="#">Hotel Booking</a></li>
					<li><a href="#">Flight Booking</a></li>
					<li><a href="#">Railway Booking</a></li>
					<li><a href="#">Bus Booking</a></li>
					<li><a href="#">Cab Booking</a></li>
					<li><a href="#">Travel Insurance</a></li>

				</ul>
			</li> 

			<li><span><a href="#">Contact Us</a></span></li>
		</ul>
	</nav>
</header>
<!-- /header -->

{{--
<!--<div class="row">
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		<div class="header-container">
			<div class="header">
				<div class="col-lg-8 col-sm-8 col-md-8 col-xs-8 no-padding">
					<div class="contact-info">
						<span class="header-title">Need Help?</span>
						
						<span class="header-title">
							<i class="fa fa-phone"></i> 
							{{ @$siteData->phone == "" ? config('constants.empty') : str_limit(@$siteData->phone, '12', '...') }} ({{ @$siteData->ofc_timing == "" ? config('constants.empty') : str_limit(@$siteData->ofc_timing, '20', '...') }})
						</span>
						
						<span class="header-title">
							<i class="fa fa-envelope-o"></i>
							{{ @$siteData->email == "" ? config('constants.empty') : str_limit(@$siteData->email, '20', '...') }}
						</span>
					</div>
				</div>
				<div class="col-lg-4 col-sm-4 col-md-4 col-xs-4 text-right no-padding">
					<div class="contact-info">
						<ul class="list-inline">
						@if(!@Auth::check())	
							<li class="list-inline-item">
								
								<a href="{{URL::to('/login')}}" class="header-title"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Login</a>
							</li>
							<li class="list-inline-item">
								<span class="header-title">|</span> 
								<a href="{{URL::to('/login')}}" class="header-title">Register</a>
							</li>
						@else
							<li class="list-inline-item">
								<a href="{{URL::to('/dashboard')}}">
									
									<span class="header-title">
									<i class="fa fa-user-circle-o" aria-hidden="true"></i>
										{{ @Auth::user()->first_name == "" ? config('constants.empty') : str_limit(@Auth::user()->first_name, '20', '...') }} {{ @Auth::user()->last_name == "" ? config('constants.empty') : str_limit(@Auth::user()->last_name, '20', '...') }}
									</span>
								</a>
							</li>	
							<li class="list-inline-item">	
								<a href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
									
									<span class="header-title">
										<i class="fa fa-sign-out" aria-hidden="true"></i> Logout
									</span>	
								</a>
								{{ Form::open(array('url' => 'logout', 'name'=>'logout', 'id' => 'logout-form')) }}
								{{ Form::close() }}
							</li>	
							<li class="list-inline-item">
								<a href="{{URL::to('/cart')}}">	
									
									<span class="header-title"><i class="fa fa-shopping-cart" aria-hidden="true"></i> (0)</span>
								</a>
							</li>	
						@endif	
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
		<div class="menu-container">
			<nav class="navbar">
				<div class="">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="header-img" href="{{URL::to('/')}}">
							<img class="img-responsive" src="{!! asset('public/img/logo.png') !!}">
						</a>
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav navbar-right">
							<li class="menu-active">
								<a href="{{URL::to('/')}}">Home</a>
							</li>
							<li>
								<a href="{{Route::currentRouteName() == 'home' ? 'javascript:void(0);' : URL::to('/about-us')}}" class="about_us" data-rel="{{Route::currentRouteName() == 'home' ? 'home_page' : 'other_page'}}">About Us</a>
							</li>
							<li>
								<a href="{{URL::to('/professors')}}">Our Faculties </a>
							</li>
							<li>
								<a href="{{URL::to('/test-series')}}">Test Series</a>
							</li>
							<li>
								<a href="{{URL::to('/coming_soon')}}">Gallery</a>
							</li>
							<li>
								<a href="{{URL::to('/coming_soon')}}">Contact Us</a>
							</li>	
							<li id="searh-container">
								<form action="/coming_soon" class="form-inline search-form">
									<div class="form-group">
										<input class="form-control search-website" type="text" placeholder="Type here to search" />
										<button class="btn btn-search">Search</button>
									</div>
								</form>
								<a href="javascript:void(0)" id="search-button">
									<i class="fa fa-search"></i> 
								</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
	</div>
</div>--> --}}