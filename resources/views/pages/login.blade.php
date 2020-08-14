@extends('layouts.index')

@section('title', 'Đăng nhập tài khoản')

@section('content')
<section class="title-bar">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="left-title-text">  
					<ul>
						<li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i> Trang chủ</a></li>
						<li class="breadcrumb-item active" aria-current="page">Đăng nhập</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="login_register">					
	<div class="container">					
		<div class="row justify-content-center">
			<div class="col-lg-6 col-md-6 col-12">
				<h1>Đăng nhập</h1>
				<div class="login-container">
					<div class="row">			
						<div class="col-lg-12 col-md-12 col-12">								
							<form method="post" action="{{route('login')}}">
								@csrf
								<div class="login-form">	
									<div class="login-logo">									
										<a href="index-2.html"><img src="library/images/login-register/logo.svg" alt=""></a>
									</div>
									<div class="social-btns">
										<button class="facebook-btn"><i class="fab fa-facebook-f"></i>Đăng nhập với Facebook</button>
										<button class="google-btn"><i class="fab fa-google"></i><a href="auth/google">Đăng nhập với Google</a></button>
									</div>
									<div class="or">
										<p> Or </p>
									</div>
									<div class="form-group">
										@if(count($errors->all()) > 0)
											<p style="color: red">
												@foreach($errors->all() as $error)
													{{$error}}<br>
												@endforeach
											</p>
										@endif
									</div>																
									<div class="form-group">
										<input type="email" name="email" value="{{old('email')}}" class="video-form" id="emailphonenumber" placeholder="Địa chỉ E-mail...">							
									</div>
									<div class="form-group">
										<input type="password" name="password" value="{{old('password')}}" class="video-form" id="yourPassword" placeholder="Mật khẩu...">							
									</div>
									<button type="submit" class="login-btn btn-link">Đăng Nhập</button>
									<div class="forgot-password">
										<a href="#">Quên mật khẩu?</a>
										<p>Bạn chưa có tài khoản? <a href="{{route('signup-form')}}"><span style="color:#ffa803;">- Đăng ký</span></a></p>
									</div>										
								</div>	
							</form>
						</div>
					</div>						
				</div>						
			</div>				
		</div>			
	</div>
</section>
@endsection