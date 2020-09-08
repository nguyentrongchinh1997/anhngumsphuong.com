@extends('layouts.index')

@section('title', 'Review nhà hàng ' . $restaurant->name . ' | Nhà hàng ' . $restaurant->name . ' | Thực đơn nhà hàng ' . $restaurant->name)

@section('description', 'Review nhà hàng ' . $restaurant->name . '. Địa chỉ: ' . $restaurant->address)

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
						<li class="breadcrumb-item"><a href="{{route('restaurant-list', ['name' => $restaurant->dish->slug, 'id' => $restaurant->dish->id])}}">{{$restaurant->dish->name}}</a></li>
						<li class="breadcrumb-item active" aria-current="page">
							<a href="{{url()->current()}}">
								{{$restaurant->name}}
							</a>
						</li>
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
				<div class="resto-meal-dt" style="padding-top: 0px">
					<div class="resto-detail">
						<div class="resto-picy">
							<a href="{{url()->current()}}">
								@if ($restaurant->image_type == 1)
									<img width="60px" src='{{asset("upload/thumbs/$restaurant->thumb")}}' alt="{{$restaurant->name}}">
								@else
									<img width="60px" src='{{$restaurant->thumb}}' alt="{{$restaurant->name}}">
								@endif
							</a>
						</div>
						<div class="name-location">
							<a href="{{url()->current()}}"><h1 title="Review nhà hàng {{$restaurant->name}}">Review nhà hàng {{$restaurant->name}}</h1></a>
							<p><span><i class="fas fa-map-marker-alt"></i></span>{{$restaurant->address}}</p>
						</div>
					</div>
					<div class="right-side-btns">
						<div class="resto-review-stars">
							@for($i = 1; $i <= $restaurant->rate; $i++)
							<i class="fas fa-star"></i>
							@endfor							
							<span>{{$restaurant->rate}}/5</span>									
						</div>
					</div>
				</div>
				<div class="published-like-comments">
					<div class="published-time">
						<span>{{$restaurant->type}}</span>
					</div>
					<div class="like-comments">
						<ul>
							<li>
								<span class="views" data-toggle="tooltip" data-placement="top" title="Likes">
									<i class="fas fa-heart"></i>
									<ins>{{$restaurant->like}}</ins>
								</span>
							</li>
							<li>
								<span class="views" data-toggle="tooltip" data-placement="top" title="Comments">
									<i class="fas fa-comment-alt"></i>
									<ins>{{count($restaurant->comment)}}</ins>
								</span>
							</li>
							<li>
								<span class="views" data-toggle="tooltip" data-placement="top" title="Views">
									<i class="fas fa-eye"></i>
									<ins>{{$restaurant->view}}</ins>
								</span>
							</li>
							</ul>
						</div>
					</div>
					<div class="all-tabs">
						<ul class="nav nav-tabs" role="tablist">
							<li class ="nav-item" role="presentation">
								<a href="#comments" class="nav-link active" aria-controls="comments" role="tab" data-toggle="tab">05 Reviews</a>
							</li>
							<li class ="nav-item" role="presentation">
								<a href="#menu" class="nav-link" aria-controls="menu" role="tab" data-toggle="tab">Thực đơn</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" role="tabpanel" id="comments">
								<div class="comment-post">
									<div class="post-items">										
										<div class="img-dp" style="padding-top: 0px">
											@if(auth()->check() && auth()->user()->image != '')
												<img src="{{auth()->user()->image}}" alt="" style="max-width: 100%; border-radius: 100%">
											@else
												<img src="{{asset('images/avatar.png')}}" alt="" style="max-width: 100%; border-radius: 100%">
											@endif
											
										</div>
											<input type="text" class="post-input" name="post" placeholder="Nhập review tại đây...">
											<input class="send-review submit-btn btn-link" type="submit" value="Gửi Review">
									</div>
								</div>
								<div class="comment-list">
									@if(count($comments) > 0)
										@foreach($comments as $commentItem)
											<div class="main-comments">
												<div class="comment-1">
													<div class="user-detail-heading">
														<a href="#">
															@if($commentItem->user->image != '')
																<img src="{{$commentItem->user->image}}" alt="" style="max-width: 100%; border-radius: 100%">
															@else
																<img src="{{asset('images/avatar.png')}}" alt="" style="max-width: 100%; border-radius: 100%">
															@endif
														</a>
														<h4> {{$commentItem->user->name}}</h4>
													</div>
													<div class="reply-time">
														<p><i class="far fa-clock"></i>{{date('H:i d/m/Y', strtotime($commentItem->created_at))}}</p>
													</div>
													<div class="comment-description">
														<p>{{$commentItem->content}}</p>
													</div>
												</div>									
											</div>
										@endforeach
									@endif
								</div>
							</div>
							<div class="tab-pane" role="tabpanel" id="menu">
								<div class="new-resto">
									<div class="large-12 columns">
										<div class="owl-carousel menu-owl owl-theme">
											@foreach($restaurant->menu as $menuItem)
												<div class="item">
													{{-- <a href="#"> --}}
														<img src='{{asset("upload/menus/$menuItem->name")}}' alt="">
													{{-- </a> --}}
												</div>		
											@endforeach																			
										</div>         
									</div>
								</div>
							</div>
						</div>					
					</div>
				<div style="clear: both;"></div>
				<h3 style="margin-top: 50px">Nhà hàng uy tín</h3>
				<br>
				<div class="row">
					@foreach($restaurantsBestView as $restaurantItem)
						<div class="col-lg-6">
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
									w			<p><span><i class="fas fa-map-marker-alt"></i></span>{{$restaurantItem->address}}</p>
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
				<div class="row">
				    <div class="col-lg-12">
				        Nhà hàng {{$restaurant->name}}, nhà hàng {{$restaurant->name}} có ngon không, review nhà hàng {{$restaurant->name}}, có nên ăn ở {{$restaurant->name}}
				    </div>
				</div>
			</div>
			<div class="col-lg-4 col-md-4">
				<div class="right-side" style="position: sticky; top: 10px">
					<div class="about-meal" style="margin-bottom: 0px">
						<h4> Thông tin chung</h4>
						<p>
							Giá: {{$restaurant->price}}
						</p>
						<p>
							Đóng - mở: {{$restaurant->time}}
						</p>
						<p>
							Loại hình: {{$restaurant->type}}
						</p>
					</div>
					{{--<a href="{{$restaurant->link}}" target="_blank" rel="notfollow">
					    <button class="submit-btn btn-link" style="background: #d02028; margin-left: 0px; width: 100%; border: 0px">Đặt chỗ ngay</button>
					</a>--}}
				</div>
			</div>
		</div>			
	</div>
</section>			
	<!--meal-deail end-->
	<!--footer start-->
@endsection

@section('js')
	<script type="text/javascript">
		$.ajaxSetup({
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }

	    });
		$(function(){
			$('.send-review').click(function(){
				@if(!auth()->check())
					Swal.fire({
					  icon: 'warning',
					  text: 'Bạn cần đăng nhập để tiếp tục review',
					  showCancelButton: true,
					  confirmButtonColor: '#3085d6',
					  cancelButtonColor: '#d33',
					  confirmButtonText: 'Đăng nhập',
					  cancelButtonText: 'Hủy',
					}).then((result) => {
					  if (result.value) {
					    location.href = "{{route('login-form')}}";
					  }
					})
				@else
					review = $('.post-input').val();
					restaurantId = "{{$restaurant->id}}";
					userId = "{{auth()->user()->id}}";

					if (review == '') {
						Swal.fire({
						  icon: 'warning',
						  text: 'Bạn chưa điền Review',
						})
					} else {
						$.ajax({
				           	type:'POST',
				           	url:"{{route('review')}}",
				           	data:{content:review, restaurantId:restaurantId, userId:userId},
				           	success:function(data){
				              	Swal.fire({
								  icon: 'success',
								  text: 'Gửi Review thành công',
								  timer: 1000
								})

								$('.comment-list').before(data);
				            }
				        });
					}
				@endif
			});
		})
	</script>
	<script type="text/javascript"></script>
@endsection