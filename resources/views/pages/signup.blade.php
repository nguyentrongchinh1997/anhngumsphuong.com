@extends('layouts.index')

@section('title', 'Đăng ký tài khoản')

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
				<div class="login-container">
					<div class="row">			
						<div class="col-lg-12 col-md-12 col-12">
							<form method="post" action="{{route('signup')}}">
								@csrf
								<div class="login-form">	
									<div class="login-logo">									
										<a href="index-2.html"><img src="library/images/login-register/logo.svg" alt=""></a>
									</div>
									<div class="create-text"><h4>ĐĂNG KÝ</h4></div>	
									<div class="form-group">
										@if(count($errors->all()) > 0)
											<p style="color: red">
												@foreach($errors->all() as $error)
													{{$error}}<br>
												@endforeach
											</p>
										@endif
										@if(session('success'))
											<p>
												Đăng ký thành công, bắt đầu đăng nhập <a href="{{route('login-form')}}">tại đây</a>
											</p>
										@endif
									</div>									
									<div class="form-group">
										<input type="text" value="{{old('full_name')}}" class="video-form" name="full_name" id="fullName" placeholder="Họ tên...">							
									</div>
									<div class="form-group">
										<input type="email" value="{{old('email')}}" class="video-form" name="email" id="emailAddress" placeholder="E-mail">							
									</div>
									<div class="form-group">
										<input type="password" value="{{old('password')}}" class="video-form" name="password" id="password1" placeholder="Mật khẩu...">							
									</div>
									<button type="submit" class="login-btn btn-link">Đăng Ký</button>
									<div class="or">
										<p> Or </p>
									</div>
									<div class="social-btns">
										<button class="facebook-btn"><i class="fab fa-facebook-f"></i>Đăng nhập với Facebook</button>
										<button class="google-btn"><i class="fab fa-google"></i>Đăng nhập với Google</button>
									</div>
									<div class="forgot-password">	
										<p>Bạn đã có tài khoản?<a href="{{route('login-form')}}"><span style="color:#ffa803;"> - Đăng Nhập</span></a></p>
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