<div class="media social-box">
	
	<a href="#" class="pull-left social-users-avatars">
		<img src="{{$association->getLogo()}}" style="width: 48px;">
	</a>
	
	
	<div class="media-body social-body">
		<h4>John Doe</h4>
		<p>An amazing trip</p>
		
		<div class="social-share-video">
			<div class="social-share-video-wrapper">
			<img alt="The city" src="http://cesarlab.com/templates/social/assets/img/gallery/thecity.jpg">
			<div class="social-share-video-text">
				<h4>The city</h4>
				<p>YouTube.com</p>
			</div>
			</div>
		</div>
		
		<p class="social-time-publication">
			3 hours ago <i class="fa fa-globe"></i>
		</p>
		
		@include('association.wall.post-footer', array('p'=>$p))
		
	
	</div>
</div>