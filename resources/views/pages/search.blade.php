@extends('layouts.index')

@section('title', 'Kết quả tìm kiếm: ' . $key)

@section('description', 'Nhà hàng tìm kiếm từ ' . $key . ', review nhà hàng')

@section('content')
<!--header end-->	
<!--title-bar start-->
<section class="title-bar">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="left-title-text">  
					<ul>
						<li class="breadcrumb-item"><a href="{{route('home')}}"><i class="fas fa-home"></i> Trang chủ</a></li>
						<li class="breadcrumb-item"><a href="#">Tìm kiếm</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<!--title-bar end-->	
<!--meal-detail-start-->
<section class="all-partners" style="margin-top: 30px">			
	<div class="container">		
		<div class="row">					
			<div class="col-lg-8 col-md-8">
				<p>
					Kết quả tìm kiếm: {{count($restaurantList)}} nhà hàng
				</p>
				<br>
				@foreach ($restaurantList as $restaurantItem)
					<div class="row" style="margin: 0px">
						<div class="partner-section">
							<div class="partner-bar">
								<div class="partner-topbar" style="border-bottom: 0px">
									<div class="partner-dt">
										<a href="{{route('detail', ['slug' => $restaurantItem->slug, 'id' => $restaurantItem->id])}}">
											@if ($restaurantItem->image_type == 1)
												<img src='{{asset("upload/thumbs/$restaurantItem->thumb")}}' alt="{{$restaurantItem->name}}">
											@else
												<img src='{{$restaurantItem->thumb}}' alt="{{$restaurantItem->name}}">
											@endif
										</a>
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
				<div class="row">
					{{$restaurantList->links()}}
				</div>
			</div>
			<div class="col-lg-4 col-md-4">
				<div class="left-tab-links">
					<div class="nav nav-pills nav-stacked nav-tabs ui vertical menu fluid" id="myTab">
						<a href="#timeline"  data-toggle="tab" class="item user-tab cursor-pointer active">Các món ăn</a>
						@foreach($dishShare as $dishItem)
							<a href="#about" data-toggle="tab" class="item user-tab cursor-pointer">{{$dishItem->name}} 
								<span class="n-badge">{{count($dishItem->restaurant)}}</span>
							</a>
						@endforeach
					</div>						
				</div>
			</div>
		</div>
	</div>
</section>			
<!--meal-deail end-->
<!--footer start-->
@endsection