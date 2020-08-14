@extends('layouts.index')

@section('title', 'Thêm nhà hàng')

@section('description', 'Thêm nhà hàng Online, thêm nhà hàng vào trang web')

@section('content')
<!--title-bar start-->
<section class="title-bar">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="left-title-text">  
					<ul>
						<li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i> Trang chủ</a></li>
						<li class="breadcrumb-item active" aria-current="page">Thêm nhà hàng</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<!--title-bar end-->	
<!--add-restaurant start-->
<section class="add-restaurant">			
	<form method="post" action="{{route('add_restaurant')}}" enctype="multipart/form-data">
		@csrf
		<div class="container">					
			<div class="row justify-content-between">
				<div class="col-lg-12">
					<div class="resto-heading">
						<img src="library/images/partner-with-us/icon-1.svg" alt="">
						<h1>Thêm nhà hàng</h1>
					</div>
				</div>
				<div class="col-lg-12">
					@if(count($errors->all()) > 0)
						<p style="color: red">
							@foreach($errors->all() as $error)
								{{$error}}<br>
							@endforeach
						</p>
					@endif
					@if(session('error'))
						<p style="color: red">
							{{session('error')}}
						</p>
					@endif
				</div>
				<div class="col-lg-6 col-md-8 col-12">
					<div class="basic-info">
						<div class="form-group">
							<label for="nameRestaurant">Tên nhà hàng*</label>
							<input type="text" value="{{old('name')}}" name="name" class="video-form" id="nameRestaurant" placeholder="VD: Food House">
						</div>
						<div class="form-group">
							<label for="searchCity">Địa chỉ*</label>
							<input type="text" value="{{old('address')}}" name="address" class="video-form" id="searchCity" placeholder="VD: Số 204 Nguyễn Trãi, Q. Thanh Xuân">							
						</div>
						<div class="form-group">
							<label for="searchCity">Loại hình*</label>
							<input type="text" value="{{old('type')}}" name="type" class="video-form" id="searchCity" placeholder="VD: Buffet Lẩu, Gọi món Việt - Thái">							
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-8 col-12">
					<div class="basic-info">
						<div class="form-group">
							<label for="nameRestaurant">Ảnh đại diện nhà hàng*</label>
							<input type="file" name="thumb" class="video-form" id="nameRestaurant" placeholder="VD: Food House">
						</div>
						<div class="form-group">
							<label for="searchCity">Giá trung bình*</label>
							<input type="text" value="{{old('price')}}" name="price" class="video-form" id="searchCity" placeholder="VD: 200.000 - 300.000 đ/người">							
						</div>
						<div class="form-group">
							<label for="searchCity">Đóng - mở cửa*</label>
							<input type="text" value="{{old('time')}}" name="time" class="video-form" id="searchCity" placeholder="VD: 11h00 - 13h00 và 17h30 - 20h30">							
						</div>
					</div>
				</div>
				<div class="col-lg-12 col-md-12 col-12 menu-list">
					<div class="basic-info">
						<div class="form-group">
							<label style="width: 100%" for="nameRestaurant">Thực đơn* <span class="add-menu" style="float: right;">Thêm</span></label>
							<input type="file" name="menu[]" class="video-form" id="num-menu">
						</div>
					</div>
				</div>
				<div class="col-lg-12">
					<center>
						<button type="submit" class="add-resto-btn1 btn-link">Thêm nhà hàng</button>
					</center>
				</div>
			</div>							
		</div>
	</form>
</section>
<!--add-restaurant end-->
@endsection
@section('js')
<script type="text/javascript">
	$('.add-menu').click(function(){
		$('.menu-list').append('<div class="basic-info row"><div class="col-lg-11 form-group"><input name="menu[]" type="file" class="video-form" id="num-menu"></div><div class="col-lg-1 remove-menu"><button class="btn"><i style="color: red" class="fas fa-window-close"></i></button></div></div>');
	})
	$('.menu-list').on("click",".remove-menu", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove();
	})
	@if(session('success'))
		Swal.fire({
		  icon: 'success',
		  text: 'Gửi yêu cầu thành công',
		  timer: 1200,
		})
	@endif
</script>
@endsection