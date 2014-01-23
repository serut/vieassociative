@extends('template.theme')


@set_true $large_centred 
@section('large-content')
	<section class="profile">
		<img src="{{$association->getCover()}}" class="cover">
		<img src="{{$association->getLogo()}}" class="logo img-circle">
		<div>
			<div>
				<div class="span17 head">
					<h2 class="name">{{$association->name}}</h2>
					<span class="pull-right" style="margin-top:13px;">
						<a class="button button-blue" href="/{{$association->id}}/edit">Editer</a>
					</span>
				</div>
			</div>
		</div>
	</section>
	<section>
		<div>




			@if(App::environment() != "prod")
			<div class="menu row-fluid" style="display:none;">
				<div id="photo" class="span4 img-polaroid" data-toggle="div-hidden-news">
					<p>Fil d'actualité</p>
				</div>
				<div id="photo" class="span4 img-polaroid" data-toggle="div-hidden-photo">
					<p>Photos</p>
				</div>
				<div id="evenement" class="span4 img-polaroid" data-toggle="div-hidden-evenement">
					<p>Evenements</p>
				</div>
				<div id="social" class="span4 img-polaroid" data-toggle="div-hidden-social">
					<p>Social</p>
				</div>
			</div>
			<div id="info-box">
				<div class="text-center" style="font-weight: bold;margin-bottom: 10px;margin-top: 20px;">
				Afficher le menu
				</div>
				<div style="background-color: #8F8F92; height: 2px">
				</div>
				<div class="text-center">
					<img src="/img/to%20sprite/header-arrow.png" class="header-arrow" alt="">
				</div>
			</div>
			@endif



			<div>
				<div id="div-hidden-photo" style="display:none;">
					<div class="filter-portfolio">
						 <ul class="filterable">
							<li><a class="option-set" data-categories="*">All</a></li>
							<li><a class="option-set" data-categories="design">Design</a></li>
							<li><a class="option-set" data-categories="illustration">Illustration</a></li>
						</ul>	
					</div>
								
					<div id="gallery" class="portfolio-items isotope span23">
						<!-- Pictures will go here ... -->
					</div>
				</div>
				
				<div id="div-hidden-evenement" style="display:none;">
					<div id="timeline-evenement" class="timeline"></div>
				</div>

				<div id="div-hidden-social" style="display:none;">
					<div id="social-fetch">
						<div class="row">
							<aside class="span8 social-partner">
								<div class="row facebook">
									<div class="span2 fb">
										<i href="#" class="logo"></i>
									</div>
									<div class="span5">
										<p>Actualités <b>Facebook</b></p>
										<i class="fa fa-chevron-right"></i>
										<img src="/img/items/like.png">
									</div>
								</div>

								<div class="row twitter">
									<div class="span2 tw">
										<i href="#" class="logo"></i>
									</div>
									<div class="span5">
										<p>Actualités <b>Twitter</b></p>
										<img src="/img/items/follow.png">
									</div>
								</div>

								<div class="row google-plus">
									<div class="span2 ggl">
										<i href="#" class="logo"></i>
									</div>
									<div class="span5">
										<p>Actualités <b>Google +</b></p>
										<img src="/img/items/plus-one.png">
									</div>
								</div>
							</aside>
							<div class="span13 content">
								@for($i=0; $i<5;$i++)
								<div class="item itemtwitter">
									<div class="thumb">
										<img src="http://a0.twimg.com/profile_images/2627364267/nlliljk98fr9hqgvmoho_normal.jpeg" class="avatar">
									</div>
									<div class="text">
										<span>Güzel güzel söz verdik iyimi, gelde şimdi yap...</span>
										<div class="tweetbtn">
										<img width="13" height="13" alt="Favorite" src="/img/to sprite/retweet_mini.png">
										<a href="http://twitter.com/intent/retweet?tweet_id=319926146185711616">Retweet</a>
										<img width="12" height="12" alt="Favorite" src="/img/to sprite/reply_mini.png">
										<a href="http://twitter.com/intent/tweet?in_reply_to=319926146185711616">Reply</a>
										<img width="12" height="12" alt="Favorite" src="/img/to sprite/favorite_mini.png">
										<a href="http://twitter.com/intent/favorite?tweet_id=319926146185711616">Favorite</a>
										<i>3 months ago</i>
										</div>
									</div>
								</div>
								@endfor
								<h1>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</h1>
								
								<p><strong>Pellentesque habitant morbi tristique</strong> senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. <em>Aenean ultricies mi vitae est.</em> Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, <code>commodo vitae</code>, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. <a href="#">Donec non enim</a> in turpis pulvinar facilisis. Ut felis.</p>
								
								<h2>Header Level 2</h2>
								
								<ol>
									<li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
									<li>Aliquam tincidunt mauris eu risus.</li>
								</ol>
								
								<blockquote><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est.</p></blockquote>
								
								<h3>Header Level 3</h3>
								
								<ul>
									<li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
									<li>Aliquam tincidunt mauris eu risus.</li>
								</ul>
								
								<pre><code>
								#header h1 a { 
									display: block; 
									width: 300px; 
									height: 80px; 
								}
								</code></pre>
							</div>
						</div>
					</div>
					<p>
						Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
					</p>
				</div>

			</div>

			<div id="social-timeline" class="row">
				<div class="span23">
					<div class="span21">
						<div class="row-fluid">
							@foreach($newsFeed as $news)
								@include('association.wall.generic-head')
								@foreach($news as $n)
									@include('association.wall.'.$n->partial_type, array('p'=>$n))
								@endforeach
								@include('association.wall.generic-foot', array('p'=>$n))
							@endforeach
							@if(empty($newsFeed))
							<p>Vous n'avez pas encore envoyé de contenu</p>
							@endif
						</div>
				 	</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Posts will go here ... -->
	</ul>
@stop

@section('footer-js')
<script type="text/javascript">

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
	<div class="element ${categories} span-size${size}" >
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
		<div class="date span2">
			<i></i>
			<h6>${start_date}</h6>
		</div>
		<div class="content span20">
			<span class="pointer">&nbsp;</span>
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
				<span class="location">${event_location}</span>
				<span class="time">${event_time}</span>
				<span class="more"><a href="${event_link}">en savoir plus</a></span>
			</div>
		</div>
	</div>
</script>

@stop
