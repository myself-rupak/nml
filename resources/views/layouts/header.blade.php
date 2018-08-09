<div class="navbar-container">
	<nav class="navbar navbar-default">
		<div class="container relative">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ URL('/') }}">
					<img src="{{ URL::asset('assets/images/logo.png') }}" alt="" class="visible-md">
					<img src="{{ URL::asset('assets/images/logo-text.png') }}" alt="">
				</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<a href="index.html" class="logo visible-lg pull-right"><img src="{{ URL::asset('assets/images/logo.png') }}" alt=""></a>
				<ul class="nav navbar-nav navbar-right">
					<li class="active">
						<a href="{{ URL('/') }}"><span>HOME</span></a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="false">
							<span>PRODUCT</span>
						</a>
						<ul class="dropdown-menu dropdown-menu-left dropdownhover-bottom" role="menu">
							@foreach ($product_categories as $product_category)
							<li>
								<a href="{{ URL('/products/'.$product_category->url ) }}">
									<img src="{{ URL('/uploads/product_category/menu_image/'.$product_category->menu_image )}}" alt="" /> {{ $product_category->title }}
								</a>
							</li>
							@endforeach
						</ul>
					</li>
					<li>
						<a href="{{ URL('/touch_point/type/all') }}"><span>TOUCH POINT</span></a>
					</li>
					<li>
						<a href="#"><span>MEDIA CENTER</span></a>
					</li>
					<li>
						<a href="#"><span>VALUE ADD</span></a>
					</li>
					<li>
						<a href="#"><span>ABOUT US</span></a>
					</li>
					<li>
						<a href="#"><span>CONTACT</span></a>
					</li>
				</ul>
				<div class="social-icons absolute">
			    	<a href="https://www.facebook.com/nitolmotors/" target="_blank">
			    		<img src="{{ URL::asset('assets/images/facebook.png') }}" alt="">
			    	</a>
			    	<a href="#">
			    		<img src="{{ URL::asset('assets/images/twitter.png') }}" alt="">
			    	</a>
			    	<a href="#">
			    		<img src="{{ URL::asset('assets/images/linkedin.png') }}" alt="">
			    	</a>
			    	<a href="#">
			    		<img src="{{ URL::asset('assets/images/youtube.png') }}" alt="">
			    	</a>
			    	<a href="#">
			    		<img src="{{ URL::asset('assets/images/google-plus.png') }}" alt="">
			    	</a>
			    	<a href="#">
			    		<img src="{{ URL::asset('assets/images/rss.png') }}" alt="">
			    	</a>
			    </div>
			</div>
		</div>
	</nav>
</div>