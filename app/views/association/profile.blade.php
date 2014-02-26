@extends('template.theme')

@section('title') 
{{$association->name}} -
@stop


@set_true $large_centred 
@section('large-content')
<section class="profile">
	<img src="{{$association->getCover()}}" class="cover" alt="Couverture de {{$association->name}}">
	<img src="{{$association->getLogo()}}" class="logo img-circle" alt="Logo de {{$association->name}}">
	<div>
		<div class="row">
			<div class="col-xs-10 col-sm-10 col-md-10 col-xs-push-2 head">
				<h2 class="name">{{$association->name}}</h2>
			</div>
		</div>
	</div>
</section>
<section>
			<div class="navbar-header visible-xs">
				<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-js-navbar-scrollspy">
					<span class="sr-only">Toggle navigation</span>
					<i class="fa fa-bars fa-lg"></i>
				</button>
				<a class="navbar-brand" href="#">Menu</a>
			</div>
			<div class="collapse navbar-collapse bs-js-navbar-scrollspy" role="navigation">
				<ul class="nav navbar-nav navbar-left">
					<li class="active"><a href="#social-timeline">Fil d'actualité</a></li>
					@if(App::environment() != "production")
					<li><a href="#photo-timeline">Photos</a></li>
					@endif
				</ul>
				@if(Auth::check() && ($association->nb_administrator == 0 || User::isAdministrator($association->id)))
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-pencil"></i></a>
						<ul class="dropdown-menu">
							<li><a href="/{{$association->id}}/edit">Panel d'administrateur</a></li>
							<li class="divider"></li>
							<li><a href="/{{$association->id}}/edit/file/{{$association->id_folder}}"><span class="pull-right badge">{{$association->nb_photos}}</span>Mes images</a></li>
							<li><a href="/{{$association->id}}/edit/file/{{$association->id_folder}}/1130x400-cover">Changer la couverture</a></li>
							<li><a href="/{{$association->id}}/edit/file/{{$association->id_folder}}/200x200-logo">Changer le logo</a></li>
							<li class="divider"></li>
							<li><a href="/{{$association->id}}/edit/news"><span class="pull-right badge">{{$association->nb_publications}}</span>Mes news</a></li>
							<li class="divider"></li>
							<li><a href="/{{$association->id}}/edit/general-informations">Edition des informations</a></li>
						</ul>
					</li>
				</ul>
				@endif
			</div>
</section>
<section  class="col-lg-10 col-lg-push-1">
	<div>
		<div id="social-timeline" class="row">
			<div>
				<?php $first = true; ?>
				@foreach($newsFeed as $news)
					@if($first)
						@include('association.wall.generic-head-first')
						<?php $first = false; ?>
					@else
						@include('association.wall.generic-head')
					@endif
					@foreach($news['data'] as $n)
						@include('association.wall.'.$n['type'], array('p'=>$n))
					@endforeach
					@include('association.wall.generic-foot')
				@endforeach
				@if(empty($newsFeed))
					<p>Vous n'avez pas encore envoyé de contenu</p>
				@endif
			</div>
		</div>
	</div>
</section>
@stop

@section('footer-js')
<script type="text/javascript">

	@if(App::environment() != "production")

	/*toggle divs PART START*/
	var el = $('.img-polaroid');
	var hiddenDivs = [];
	el.each(function(){
		hiddenDivs.push($(this).attr('data-toggle'));
	});
	el.each(function(){
		$(this).click(function(){
			toggleAssociationProfile($(this).attr('data-toggle'));
		});
	});
	function toggleAssociationProfile(toggleDiv){
		for (var i = hiddenDivs.length - 1; i >= 0; i--) {
			if(hiddenDivs[i] == toggleDiv){
				$('#'+hiddenDivs[i]).show();
			}else{
				$('#'+hiddenDivs[i]).hide();
			}
		};
	}
	/*toggle divs PART END*/


	/*Gallery PART START*/
	$('#photo').one('click',function() {
		var data = [
			{
				'url_img':'http://lorempixel.com/800/600/sports/',
				'head':'WordPress Custom Theme',
				'link':'Read More',
				'categories':'illustration',
				'size' : '2',
			},
			{
				'url_img':'http://lorempixel.com/800/600/animals/',
				'head':'WordPress Custom Theme',
				'link':'Read More',
				'categories':'illustration design',
				'size' : '1',
			},
			{
				'url_img':'http://lorempixel.com/1000/600/animals/',
				'head':'WordPress Custom Theme',
				'link':'Read More',
				'categories':'illustration',
				'size' : '2',
			},
			{
				'url_img':'http://dummyimage.com/800x1600/4d494d/686a82.gif&text=placeholder+image',
				'head':'WordPress Custom Theme',
				'link':'Read More',
				'categories':'illustration design',
				'size' : '1',
			},
			{
				'url_img':'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-prn1/c26.26.328.328/s160x160/378926_10150600500671124_496920089_n.jpg',
				'head':'WordPress Custom Theme',
				'link':'Read More',
				'categories':'design',
				'size' : '1',
			},{
				'url_img':'http://lorempixel.com/600/1300/animals/',
				'head':'WordPress Custom Theme',
				'link':'Read More',
				'categories':'illustration',
				'size' : '2',
			},
			{
				'url_img':'http://dummyimage.com/800x600/4d494d/686a82.gif&text=placeholder+image',
				'head':'WordPress Custom Theme',
				'link':'Read More',
				'categories':'illustration design',
				'size' : '1',
			},
			{
				'url_img':'http://dummyimage.com/1000x768/4d494d/686a82.gif&text=placeholder+image',
				'head':'WordPress Custom Theme',
				'link':'Read More',
				'categories':'illustration',
				'size' : '2',
			},
			{
				'url_img':'http://dummyimage.com/800x1600/4d494d/686a82.gif&text=placeholder+image',
				'head':'WordPress Custom Theme',
				'link':'Read More',
				'categories':'illustration design',
				'size' : '1',
			},
			{
				'url_img':'http://dummyimage.com/800x600/4d494d/686a82.gif&text=placeholder+image',
				'head':'WordPress Custom Theme',
				'link':'Read More',
				'categories':'design',
				'size' : '1',
			},{
				'url_img':'http://dummyimage.com/800x600/4d494d/686a82.gif&text=placeholder+image',
				'head':'WordPress Custom Theme',
				'link':'Read More',
				'categories':'illustration',
				'size' : '2',
			},
			{
				'url_img':'http://dummyimage.com/800x600/4d494d/686a82.gif&text=placeholder+image',
				'head':'WordPress Custom Theme',
				'link':'Read More',
				'categories':'illustration design',
				'size' : '1',
			},
			{
				'url_img':'http://dummyimage.com/1000x768/4d494d/686a82.gif&text=placeholder+image',
				'head':'WordPress Custom Theme',
				'link':'Read More',
				'categories':'illustration',
				'size' : '2',
			},
			{
				'url_img':'http://dummyimage.com/800x1600/4d494d/686a82.gif&text=placeholder+image',
				'head':'WordPress Custom Theme',
				'link':'Read More',
				'categories':'illustration design',
				'size' : '1',
			},
			{
				'url_img':'http://dummyimage.com/800x600/4d494d/686a82.gif&text=placeholder+image',
				'head':'WordPress Custom Theme',
				'link':'Read More',
				'categories':'design',
				'size' : '1',
			},
		]
		loadGallery($('#gallery'),data,$('#photo-pattern'));
	});
	/*Gallery PART END*/

	/*Evenements PART START*/
	$('#evenement').one('click',function() {
		var data = [
			{
				'event_location' : 'malegoude',
				'event_time' : '16h30',
				'event_location' : 'malegoude',
				'event_title' : 'THE TITLE',
				'event_link' : 'THE URL',
				'event_text' : 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus [...]',
				'start_date' : '12 JUIN 2012',
				'img' : 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-prn1/c26.26.328.328/s160x160/378926_10150600500671124_496920089_n.jpg',
			},
		]
		$('#evenement-pattern').tmpl(data).appendTo('#timeline-evenement');
	});
	/*Evenements PART END*/


	/*Social PART START*/
	$('#social').one('click',function() {
		$("#social-fetch .content").mCustomScrollbar({
			theme:"dark",
			scrollButtons:{
				enable:true
			}
		});
	});
	/*Social PART END*/

	/* Menu PART START*/
	$('#info-box').click(function(){
		$(".menu").slideToggle(400);
	});
	/*

	jQuery(window).load(function(){
		info_box_resize();
		jQuery(window).on("resize.infobox", function(){
			info_box_resize();
		});
	});
	/* Menu PART END*/
	</script>
<script id="photo-pattern" type="text/x-jquery-tmpl">
	<div class="element ${categories} col-lg--size${size}" >
		<a class="fancybox" href="${url_img}" rel="gallery1" title="A title">
			<img src="${url_img}" class="size${size}"alt=" " />
		</a>
	</div>
	{{--<div class="thumb-text">
		<b>${head}</b><br>
		<div class="divider"></div>
		<a href="#" title="Image Dummy Title" >${link}</a>
	</div>--}}
</script>

<script id="evenement-pattern" type="text/x-jquery-tmpl">
	<div class="row">
		<div class="date col-lg-1">
			<i></i>
			<h6>${start_date}</h6>
		</div>
		<div class="content col-lg-5">
			<col-lg- class="pointer">&nbsp;</col-lg->
			<div class="thumb">
				<img alt="" src="${img}">
			</div>
			<div class="text">
				<h5><a href="${event_link}">${event_title}</a></h5>
				<p>
					${event_text}
				</p>
			</div>
			<div class="panel">
				<col-lg- class="location">${event_location}</col-lg->
				<col-lg- class="time">${event_time}</col-lg->
				<col-lg- class="more"><a href="${event_link}">en savoir plus</a></col-lg->
			</div>
		</div>
	</div>
		@endif
		('.cat').hover(
			function () {
				$(this).show();
			}, 
			function () {
				$(this).hide();
			}
		);
</script>
@stop
