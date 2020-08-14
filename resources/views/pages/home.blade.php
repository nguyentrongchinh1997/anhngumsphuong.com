@extends('layouts.index')

@section('title', 'Tổng hợp nhà hàng uy tín tại Hà Nội | Review nhà hàng tại Hà Nội')

@section('description', 'Tổng hợp nhà hàng ngon, uy tín tại Hà Nội, đánh giá nhà hàng, review nhà hàng tại Hà Nội, đặt bàn nhà hàng trực tuyến')

@section('content')
<!--banner start-->
<section class="block-preview">
	<div class="cover-banner" style="background-image: url(library/images/homepage/banner.jpg)"></div>
	<div class="container">
		<div class="row">	
			<div class="col-lg-8 col-md-6 col-sm-12">
				<div class="left-text-b">
					<h1 class="title">Lựa chọn, đánh giá nhà hàng</h1>
					<a class="bnr-btn btn-link" href="{{route('add-restaurant')}}"><i class="fas fa-plus"></i> Thêm nhà hàng</a>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<form method="get" action="{{route('search')}}">
					<div class="form-box">
						<div class="input-group-prepend">
							<div class="input-group-text"><i class="fas fa-map-marker-alt"></i></div>
						</div>
						<input  class="find-address skills" name="address" type="text" placeholder="Chọn địa chỉ"/>
						<div class="input-group-prepend">
							<div class="input-group-text-1"><i class="fas fa-utensils"></i></div>
						</div>
						<input  class="find-resto skills" name="restaurant" type="text" placeholder="Chọn nhà hàng"/>
						<button class="search-btn btn-link" type="submit">Tìm kiếm</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<!--banner end-->
<!--browse-places start-->
<section class="browse-places">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="browse-heading">
					<h3> Nhà hàng uy tín </h3>
				</div>
			</div>
		</div>
		<div class="row">				
			<div class="col-lg-12 col-md-12">
				<div class="owl-carousel browse-owl owl-theme">
					@foreach($highRateRestaurant as $restaurantItem)
						<div class="item">
							<div class="places">
								<a href="{{route('detail', ['slug' => $restaurantItem->slug, 'id' => $restaurantItem->id])}}">
									<div class="b-icon">
										<img style="max-width: 100%" src='{{asset("upload/thumbs/$restaurantItem->thumb")}}' alt="">
									</div>
									<div class="b-text">
										{{$restaurantItem->name}}
									</div>
								</a>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</section>
<!--discover-new-restaurants-&-book-now end-->	
<!--order-food-online-in-your-area start-->
<section class="order-food-online">		
	<div class="container">
		<div class="row text-left">
			<div class="col-lg-12 col-md-12 col-12 text-left">
				<div class="places-heading">
					<h1 style="padding-top: 0px">Nhà hàng chuyên Lẩu</h1>
				</div>
			</div>	
			@foreach($lau as $restaurantItem)
			<div class="col-lg-6 col-md-12 col-12">
				<div class="partner-section">
					<div class="partner-bar">
						<div class="partner-topbar" style="border-bottom: 0px">
							<div class="partner-dt">
								<a href="{{route('detail', ['slug' => $restaurantItem->slug, 'id' => $restaurantItem->id])}}"><img src='{{asset("upload/thumbs/$restaurantItem->thumb")}}' alt=""></a>
								<div class="partner-name">
									<a href="{{route('detail', ['slug' => $restaurantItem->slug, 'id' => $restaurantItem->id])}}"><h4 title="Review nhà hàng {{$restaurantItem->name}}">Nhà hàng {{$restaurantItem->name}} </h4></a>
									<p class="country">{{$restaurantItem->type}}</p>
									<p><span><i class="fas fa-map-marker-alt"></i></span>{{$restaurantItem->address}}</p>
									<div class="bagde-dt">
										<div class="partner-badge">
											<a style="color: #fff" href="{{route('detail', ['slug' => $restaurantItem->slug, 'id' => $restaurantItem->id])}}">
												Review
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
						{{-- <div class="partner-subbar" style="border-bottom: 0px">
							<div class="detail-text">
								<ul>
									<li>Giờ đón khách : {{$restaurantItem->time}}</li>
									<li>Giá : {{$restaurantItem->price}}</li>
									<li>Đánh giá : 
										<div class="review-stars">
											@for($i = 1; $i <= $restaurantItem->rate; $i++)
												<i class="fas fa-star"></i>
											@endfor							
											<span>{{$restaurantItem->rate}}</span> 									
										</div>
									</li>
								</ul>
							</div>
						</div> --}}
{{-- 					<div class="partner-bottombar">
						<ul class="bottom-partner-links">
							<li><a href="#" data-toggle="tooltip" data-placement="top" title="Call Now"><i class="fas fa-phone"></i>Call Now</a></li>
							<li class="line-lr"><a href="#" data-toggle="tooltip" data-placement="top" title="Order Now"><i class="fas fa-shopping-cart"></i> Order Now</a></li>
							<li><a href="#" data-toggle="tooltip" data-placement="top" title="View Menu"><i class="fas fa-book"></i> View Menu</a></li>
						</ul>
					</div> --}}
				</div>
			</div>

		</div>
		@endforeach
	</div>
	<div class="row text-left">
			<div class="col-lg-12 col-md-12 col-12 text-left">
				<div class="places-heading">
					<h1 style="padding-top: 50px">Nhà hàng chuyên Lẩu & Nướng</h1>
				</div>
			</div>	
			@foreach($nuong as $restaurantItem)
			<div class="col-lg-6 col-md-12 col-12">
				<div class="partner-section">
					<div class="partner-bar">
						<div class="partner-topbar" style="border-bottom: 0px">
							<div class="partner-dt">
								<a href="{{route('detail', ['slug' => $restaurantItem->slug, 'id' => $restaurantItem->id])}}"><img src='{{asset("upload/thumbs/$restaurantItem->thumb")}}' alt=""></a>
								<div class="partner-name">
									<a href="{{route('detail', ['slug' => $restaurantItem->slug, 'id' => $restaurantItem->id])}}">
										<h4 title="Review nhà hàng {{$restaurantItem->name}}">Nhà hàng {{$restaurantItem->name}} </h4>
									</a>
									<p class="country">{{$restaurantItem->type}}</p>
									<p><span><i class="fas fa-map-marker-alt"></i></span>{{$restaurantItem->address}}</p>
									<div class="bagde-dt">
										<div class="partner-badge">
											<a style="color: #fff" href="{{route('detail', ['slug' => $restaurantItem->slug, 'id' => $restaurantItem->id])}}">
												Review
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					{{-- 	<div class="partner-subbar" style="border-bottom: 0px">
							<div class="detail-text">
								<ul>
									<li>Giờ đón khách : {{$restaurantItem->time}}</li>
									<li>Giá : {{$restaurantItem->price}}</li>
									<li>Đánh giá : 
										<div class="review-stars">
											@for($i = 1; $i <= $restaurantItem->rate; $i++)
												<i class="fas fa-star"></i>
											@endfor							
											<span>{{$restaurantItem->rate}}</span> 									
										</div>
									</li>
								</ul>
							</div>
						</div> --}}
					</div>
				</div>
			</div>
		@endforeach
	</div>
</div>
</section>
<!--order-food-online-in-your-area end-->	
<!--offer-banners start-->
<section class="offer-banners">	
	<div class="container">
		<div class="new-heading">
			<h1> Menu hấp dẫn </h1>
		</div>
		<div class="row">
			@foreach($menuRandom as $menuItem)
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					<div class="banner">
						<div class="ads-banner" style='background-image: url({{asset("upload/menus/$menuItem->name")}})'></div>			
						<div class="banner-items">
							<div class="bnnr-text">
								<h2>
									<a href="{{route('detail', ['slug' => $menuItem->restaurant->slug, 'id' => $menuItem->restaurant->id])}}">
										{{$menuItem->restaurant->name}}
									</a>
								</h2>
								<p>
									{{$menuItem->restaurant->address}}
								</p>
							</div>
							<div class="offer-button">
								<a href="{{route('detail', ['slug' => $menuItem->restaurant->slug, 'id' => $menuItem->restaurant->id])}}" class="of-btn btn-link">Review</a>
							</div>
						</div>
					</div>
				</div>
			@endforeach				
		</div>
	</div>
</section>
<!--offer-banners end-->	
<!--featured-restaurants start-->
<br>
@endsection