<div class="media social-box">
	<a href="#" class="pull-left social-users-avatars">
		<img alt="Maria" src="http://cesarlab.com/templates/social/assets/img/people-face/user1_55.jpg" class="media-object">
	</a>
	<div class="media-body social-body">
		<h4>{{$p->post->title}}</h4>
		<p>
			{{$p->post->text}}
		</p>
		@include('association.wall.post-footer', array('p'=>$p))
	</div>
</div>