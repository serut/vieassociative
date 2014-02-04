@extends('template.theme')


@set_true $large_centred 
@section('large-content')

	<section id="services" class="section">
		<div id="carousel-example-generic" class="carousel slide animated fadeIn" data-ride="carousel" style="padding: 0 0 0 0;">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				@if(App::environment() != "production")
				<li data-target="#carousel-example-generic" data-slide-to="1"></li>
				<li data-target="#carousel-example-generic" data-slide-to="2"></li>
				<li data-target="#carousel-example-generic" data-slide-to="3"></li>
				@endif
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner">
				<div class="item active">
					<img src="/img/slide1.png">
					<div class="carousel-caption">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. 
					</div>
				</div>
				@if(App::environment() != "production")
				<div class="item">
					<img src="/img/slide2.png">
					<div class="carousel-caption">
						<form><input type="password"></form>
					</div>
				</div>
				<div class="item">
					<img src="/img/slide3.png">
					<div class="carousel-caption">
						Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. 
					</div>
				</div>
				<div class="item">
					<img src="/img/slide4.png">
					<div class="carousel-caption">
						Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.	
					</div>
				</div>
				@endif
			</div>

			<!-- Controls -->
			<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
				<i class="fa fa-chevron-left icon-prev"></i>
			</a>
			<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
				<i class="fa fa-chevron-right icon-next"></i>
			</a>
		</div>
      		
		<div class="row text-center">
			<div class="caption col-sm-10 col-sm-push-1" style="margin-top:40px;">
		        <h2>Le réseau social des associations !</h2>
				<p>
					Notre but est de référencer les associations et de mettre à leur disposition des outils puissants et simples d'utilisation pour les aider aussi bien au niveau de la communication que de la gestion !
					<br>
					Ajoutez votre association et complétez son profil afin de découvrir toutes les possibilités qui s'offrent à vous !
				</p>
				<div>
					<a href="http://association.vieassoc.lo/">
						<button type="button" href="" class="btn btn-info">Rejoignez nous !</button>
					</a>
					<a href="http://association.vieassoc.lo/">
						<button type="button" class="btn btn-primary" style="margin-left:20px;">Rechercher une association</button>
					</a>
				</div>
		    </div>
	    </div>
	    <hr>
		<div class="row">
		    <div class="text-center col-sm-10 col-sm-push-1">
		    	
	          <!--Seciton 1-->
	          <div class="col-sm-6">
	              <i class="fa fa-video-camera fa-4x light-gray"></i>
	              <h3 style="margin-bottom: 30px;">Qu'est ce que Vie Associative ?</h3>
				<div class="flex-video widescreen"><iframe src="https://www.youtube-nocookie.com/embed/4TlJ4qKO2Xg?rel=0" frameborder="0" allowfullscreen=""></iframe></div>
	          </div>
	          <br class="visible-xs">
	          <hr class="visible-xs">
	          <!--Seciton 2-->
	          <div class="col-sm-4 col-sm-push-2 col-xs-8 col-xs-push-2">
	              <i class="fa fa-thumbs-up fa-4x light-gray"></i>
	              <h3 style="margin-bottom: 30px;">Facebook</h3>
			      <div class="fb-like-box" data-href="http://www.facebook.com/vieassociativeofficiel" data-width="320" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="false"></div>
	          </div>
	          
		    </div>
        </div>
    </section>
<style type="text/css">
.carousel-indicators li {
  background-color: #999;
  background-color: rgba(70,70,70,.25);
}

.carousel-indicators .active {
  background-color: #444;
}
.carousel-control.left,.carousel-control.right{
	background-image:none; 
}
.carousel-caption{
	color:#333;
}
</style>
@stop

@section('footer-js')
<script>(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1&appId=377363965666139";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
@stop
