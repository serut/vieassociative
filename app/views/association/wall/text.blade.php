<div class="media social-box">
	<a href="#" class="pull-left social-users-avatars" style="width: 48px;">
		<img src="{{$association->getLogo()}}" class="img-circle">
	</a>
	<div class="media-body social-body">
		<h4>{{$p->post->title}}</h4>
		<div>
			{{$p->post->text}}
		</div>
		@include('association.wall.post-footer', array('p'=>$p))
		<hr class="separator">
	</div>
</div>