<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<base href="{{asset('')}}">
	
	<!-- Favicon -->
	<link href="{{asset('library/images/fav.png')}}" rel="shortcut icon" type="image/x-icon"/>

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

<!-- <body oncontextmenu="return false;"> chặn chuột phải --> 
	<body>
		<!--header start-->
		<header id="header" class="default">
			<div class="topbar">
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							<div class="topbar-left text-center text-md-left">
								<ul class="list-inline">
									<li> <a href="contact.html"> E-mail: contact@gmail.com</a></li>	
								</ul>
							</div>
						</div>
						<div class="col-md-8">
							<div class="topbar-right text-center text-md-right">
								<ul class="list-inline">
									@if(auth()->check())
	{{-- 									<li class="nav-item dropdown">
											<a  class="dropdown-toggle-no-caret" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i>John Doe  <i class="fas fa-caret-down"></i></a>
											<div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropdown">
												<a class="dropdown-item" href="#"> Đăng xuất</a>
											</div>
										</li> --}}
										<li>
											{{auth()->user()->name}}
										</li>
										<li>
											<a href="{{route('logout')}}"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
										</li>
									@else
										<li><a href="{{route('login-form')}}"><i class="fas fa-sign-out-alt"></i>Đăng nhập</a></li>
										<li><a href="{{route('signup-form')}}"><i class="fas fa-user-plus"></i>Đăng ký</a></li>
									@endif																
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="menu">
				<div class="container">
					<div class="row">
						<div class="col-md-2 col-sm-12 col-xs-12">
							<div class="menu-left text-center text-md-left">
								<div class="logo-box">
									<a href="{{route('home')}}">
										{{-- <img src="{{asset('library/images/logo.svg')}}" alt=""> --}}
										{{-- Anh Ngữ MS PHƯƠNG --}}
									</a>
								</div>
							</div>
						</div>
						<div class="col-md-10 col-sm-12 col-xs-12">	
							<div class="menu-items">
								<nav class="navbar navbar-expand-lg navbar-light bg-light menu-right">										
									<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
										<span class="navbar-toggler-icon"></span>
									</button>

									<div class="collapse navbar-collapse" id="navbarSupportedContent">
										<ul class="navbar-nav mr-auto nav-text">
											<li class="nav-item active">
												<a class="nav-link" href="{{route('home')}}"><i class="fas fa-home"></i> Trang chủ </a>
											</li>
											<li class="nav-item dropdown">
												<a class="nav-link dropdown-toggle-no-caret" href="#" id="megaDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Món ăn <i class="fas fa-caret-down"></i></a>																										
												<div class="dropdown-menu mega-menu dropdown-menu-right">	
													<div class="row">
														@foreach($dishShare as $dishItem)
														<div class="col-md-3">
															<a class="dropdown-item" href="{{route('restaurant-list', ['name' => $dishItem->slug, 'id' => $dishItem->id])}}">{{$dishItem->name}}</a>
															
														</div>
														@endforeach
														
													</div>
												</div>	
											</li>
											<li class="nav-item">
												<a class="nav-link" href="#">Giới thiệu</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="#">Liên hệ</a>
											</li>
										</ul>											
									</div>
									
								</nav>
								<div class="icons-set">
									<ul class="list-inline">
										<li class="icon-items nav-item dropdown ">
											<a class="nav-link dropdown-toggle-no-caret" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-search"></i></a>										
											<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown1">	
												<div class="notification-item">													
													<div class="search-details">
														<form class="form-inline" method="get" action="{{route('search')}}">
															<input class="form-control" name="restaurant" type="search" placeholder="Tìm kiếm nhà hàng..." aria-label="Search">
															<button class="s-btn btn-link " type="submit"><i class="fas fa-search"></i></button>
														</form>																																								
													</div>
												</div>												
											</div>		
										</li>
										<li class="partner-btn">
											<a href="{{route('add-restaurant')}}" class="b-btn btn-link"><i class="fas fa-plus"></i> Thêm nhà hàng</a>
										</li>								
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>				
		</header>
	<!--header end-->