@if(App::environment() != "production")
<div class="social-footer">
	<div class="social-controls">
		<col-lg-><i class="fa fa-thumbs-up "></i> Like</col-lg->
		<col-lg-><i class="fa fa-comment"></i> Comment</col-lg->
		<col-lg->- <strong>Margo Payne, Tobei Tsumura</strong>and <strong> 3,747 others</strong> like this.</col-lg->
	</div>
	
	
	<div class="social-comments">
	
	<div class="media">
		<a href="#" class="pull-left">
		<img alt="D" src="{{Auth::user()->getAvatar()}}">
		</a>
		<div class="media-body">
		<strong>{{Auth::user()->username}}</strong>
		Where is that?
		<br>
		<small>
			<col-lg- class="muted">Today at 7:36am</col-lg->
		</small>
		<strong style="cursor:pointer">Like</strong>
		</div>
	</div>
	
	
	<div class="media">
		<a href="#" class="pull-left">
		<img alt="F" src="http://cesarlab.com/templates/social/assets/img/avatars/f-30x30.png" class="media-object">
		</a>
		<div class="media-body">
		<strong>Tobei Tsumura</strong>
		Really Nice
		<br>
		<small><col-lg- class="muted">Yesterday at 3:45pm</col-lg-></small>
		
		<strong style="cursor:pointer">Like</strong>
		</div>
	</div>
	
	
	<div class="media">
		<a href="#" class="pull-left">
		<img alt="{{Auth::user()->username}}" src="{{Auth::user()->getAvatar()}}">
		</a>
		<div class="media-body">
		<input type="text" placeholder="Write a comment..." class="input-block-level">
		</div>
	</div>
	
	</div>
</div>
@endif