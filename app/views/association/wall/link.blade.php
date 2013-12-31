<div class="media social-box">
	
	<a href="#" class="pull-left social-users-avatars">
		<img src="{{$association->getLogo()}}" style="width: 48px;">
	</a>
	
	
	<div class="media-body social-body">
		<p>
			Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
		</p>
		@include('association.wall.post-footer', array('p'=>$p))
	</div>
</div>