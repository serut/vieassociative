@extends('template.theme')


@set_true $large_centred 
@section('large-content')

	<section id="services" class="section">
		<div id="carousel-example-generic" class="carousel slide animated fadeIn" data-ride="carousel" >
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				<li data-target="#carousel-example-generic" data-slide-to="1"></li>
				<li data-target="#carousel-example-generic" data-slide-to="2"></li>
				<li data-target="#carousel-example-generic" data-slide-to="3"></li>
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner">
				<div class="item active">
					<img src="/img/slide1.png">
					<div class="carousel-caption">
						CACA
					</div>
				</div>
				<div class="item">
					<img src="/img/slide2.png">
					<div class="carousel-caption">
						<form><input type="password"></form>
					</div>
				</div>
				<div class="item">
					<img src="/img/slide3.png">
					<div class="carousel-caption">
						PIPI
					</div>
				</div>
				<div class="item">
					<img src="/img/slide4.png">
					<div class="carousel-caption">
						PIPI
					</div>
				</div>
			</div>

			<!-- Controls -->
			<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
				<span class="fa fa-chevron-left icon-prev"></span>
			</a>
			<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
				<span class="fa fa-chevron-right icon-next"></span>
			</a>
		</div>
      		
		<div class="row">
			<div class="caption col-sm-10 col-sm-push-1" style="margin-top:40px;">
		        <h2>Le réseau social des associations !</h2>
		        <h4>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</h4>
		    </div>
	    </div>
		<div class="row">
		    <div class="text-center">
		    	
	          <!--Seciton 1-->
	          <div class="col-sm-4 col-lg-6">
	              <i class="fa fa-video-camera fa-4x light-gray"></i>
	              <h3>Qu'est ce que Vie Associative ?</h3>
				<div class="flex-video widescreen"><iframe src="https://www.youtube-nocookie.com/embed/4TlJ4qKO2Xg?rel=0" frameborder="0" allowfullscreen=""></iframe></div>
	          </div>
	          
	          <!--Seciton 2-->
	          <div class="col-sm-4 col-lg-3">
	              <i class="fa fa-thumbs-up fa-4x light-gray"></i>
	              <h3>Facebook</h3>
			      <div class="fb-like-box" data-href="http://www.facebook.com/vieassociativeofficiel" data-width="270" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="false"></div>

	          </div>
	          
	          <!--Seciton 3-->
	          <div class=" col-lg-3 col-sm-4">
	              <i class="fa fa-flag fa-4x light-gray"></i>
	              <h3>Rejoignez nous !</h3>
	              <p>Notre but est de référencer les associations et de mettre à leur disposition des outils puissants et simples d'utilisation pour les aider aussi bien au niveau de la communication que de la gestion !
	              <br>
	              Ajoutez votre association et complétez son profil afin de découvrir toutes les possibilités qui s'offrent à vous !</p>

	          </div>
		    </div>
        </div>
    </section>

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
