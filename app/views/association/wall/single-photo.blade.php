<div class="media social-box">
	<a href="#" class="pull-left social-users-avatars">
		<img src="{{$association->getLogo()}}" style="width: 48px;">
	</a>
	<div class="media-body social-body">
		<div class="social-share-image">
			<img alt="Sun Set" src="http://cesarlab.com/templates/social/assets/img/gallery/sunset.jpg">
			<div class="social-share-image-text">
			<h4>John Doe</h4>
			<p>
				<strong>Nice Sunset!</strong>
				<small>3 hours ago <i class="fa fa-globe"></i></small>
			</p>
			</div>
		</div>
		
		@include('association.wall.post-footer', array('p'=>$p))
	</div>
</div>