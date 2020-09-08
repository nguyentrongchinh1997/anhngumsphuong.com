<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<base href="{{asset('')}}">
	<title>@yield('title')</title>
	<meta name="description" content="@yield('description')">
	<!-- Bootstrap core CSS-->
	<link href="{{asset('library/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('library/css/style.css')}}" rel="stylesheet">
	<link href="{{asset('library/css/responsive.css')}}" rel="stylesheet">
	<link href="{{asset('library/css/mega.menu.css')}}" rel="stylesheet">
	<link href="{{asset('library/css/owlslider.css')}}" rel="stylesheet">

	<!-- Owl Carousel for this template-->
	<link href="{{asset('library/vendor/OwlCarousel/assets/owl.carousel.css')}}" rel="stylesheet">
	<link href="{{asset('library/vendor/OwlCarousel/assets/owl.theme.default.min.css')}}" rel="stylesheet">
	
	<!-- Fontawesome styles for this template-->
	<link href="{{asset('library/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
    <div class="row">
		@foreach($highRateRestaurant as $restaurantItem)
			<div class="col-lg-6">
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
					</div>
				</div>
			</div>
		@endforeach
	</div>
</div>
</body>