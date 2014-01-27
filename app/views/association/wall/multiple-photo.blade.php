<div class="media social-box">
	
	<a href="#" class="pull-left social-users-avatars">
		<img src="{{$association->getLogo()}}" style="width: 48px;">
	</a>
	
	
	<div class="media-body social-body">
		<h4 class="media-heading">Multiples photos</h4>
		<p>
			Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
		</p>
		<ul class="gallery">
			<li class="col-lg-4">
				<img alt="alt name" src="http://cesarlab.com/templates/social/assets/img/pages/social-timeline/event-image1.jpg">
			</li>
			<li class="col-lg-4">
				<img alt="alt name" src="http://cesarlab.com/templates/social/assets/img/pages/social-timeline/event-image2.jpg">
			</li>
			<li class="col-lg-4">
				<img alt="alt name" src="http://cesarlab.com/templates/social/assets/img/pages/social-timeline/event-image3.jpg">
			</li>
		</ul>
		<ul class="gallery">
			<li class="col-lg-4">
				<img alt="alt name" src="http://cesarlab.com/templates/social/assets/img/pages/social-timeline/event-image1.jpg">
			</li>
			<li class="col-lg-4">
				<img alt="alt name" src="http://cesarlab.com/templates/social/assets/img/pages/social-timeline/event-image3.jpg">
			</li>
			<li class="col-lg-4">
				<img alt="alt name" src="http://cesarlab.com/templates/social/assets/img/pages/social-timeline/event-image2.jpg">
			</li>
		</ul>
		@include('association.wall.post-footer', array('p'=>$p))
	</div>
</div>