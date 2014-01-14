<div class="media social-box">
	<a href="#" class="pull-left social-users-avatars" style="width: 48px;">
		<img src="{{$association->getLogo()}}" class="img-circle">
	</a>
	<div class="media-body social-body">
		<h4>{{$p->post->title}}</h4>
		<p>
			{{$p->post->text}}
		</p>
		@include('association.wall.post-footer', array('p'=>$p))
	</div>
</div>