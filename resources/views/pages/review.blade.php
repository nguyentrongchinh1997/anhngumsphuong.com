<div class="main-comments">
	<div class="comment-1">
		<div class="user-detail-heading">
			<a href="#">
				@if($comment->user->image != '')
					<img src="{{$comment->user->image}}" alt="" style="max-width: 100%; border-radius: 100%">
				@else
					<img src="{{asset('images/avatar.png')}}" alt="" style="max-width: 100%; border-radius: 100%">
				@endif
			</a>
			<h4> {{$user->name}}</h4>
		</div>
		<div class="reply-time">
			<p><i class="far fa-clock"></i>{{date('H:i d/m/Y', strtotime($comment->created_at))}}</p>
		</div>
		<div class="comment-description">
			<p>{{$comment->content}}</p>
		</div>
	</div>									
</div>