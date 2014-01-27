@extends('template.theme')




@set_true $large_centred 
@section('large-content')
<section>
		<div>
			<ul class="breadcrumb">
				<li><a href="/{{$association->id}}-{{$association->slug}}">{{$association->name}}</a> <col-lg- class="divider">/</col-lg-></li>
				<li><a href="/{{$association->id}}/edit">Edition</a> <col-lg- class="divider">/</col-lg-></li>
				<li><a href="/{{$association->id}}/edit/news">Mes publications</a> <col-lg- class="divider">/</col-lg-></li>
				<li class="active">Editer une publication</li>
			</ul>
			<h3 class="head">{{Lang::get('association/edit/news.modify_news')}}</h3>
			{{ Form::open(array('class'=> 'form-horizontal','data-validate'=>'our-parsey', 'data-loading'=>'true')) }}
			<div class="row">
				<div class="col-lg-1">
					<img src="{{$association->getLogo()}}" class="img-circle">
				</div>
				<div class="col-lg-5">
					<div id="title">
						@if(Partial::has($post,'PartialTitle'))
							@input = array(
								'id'=>"title",
								'value'=>Partial::search($post,'PartialTitle')['title'],
								'form' => array(
									'placeholder'=>Lang::get('association/edit/news.placeholder_title'),
									'class' => 'input-xxlarge',
									'tabindex'=>'1',
		                            'data-maxlength'=>"150",
		                            'data-minlength'=>"3",
								)
							)@
						@else
							@input = array(
								'id'=>"title",
								'form' => array(
									'placeholder'=>Lang::get('association/edit/news.placeholder_title'),
									'class' => 'input-xxlarge',
									'tabindex'=>'1',
		                            'data-maxlength'=>"150",
		                            'data-minlength'=>"3",
								)
							)@
						@endif
						{{SiteHelpers::simple_input($input)}}
					</div>


					<div id="textarea">
						@if(Partial::has($post,'PartialText'))
							{{SiteHelpers::add_textarea('text',Partial::search($post,'PartialText')['text'], true, true)}}
						@else
							{{SiteHelpers::add_textarea('text',"", true, true)}}
						@endif
					</div>



					<div id="soundcloud" 
					@if(!Partial::has($post,'PartialSoundCloud'))
						style="display:none;"
					@endif
					>
						@if(Partial::has($post,'PartialSoundCloud'))
							<script src="http://connect.soundcloud.com/sdk.js"></script>
							<script>
							SC.initialize({
							  client_id: 'YOUR_CLIENT_ID'
							});

							var track_url = 'http://soundcloud.com/forss/flickermood';
							SC.oEmbed(track_url, { auto_play: true }, function(oEmbed) {
							  console.log('oEmbed response: ' + oEmbed);
							});
							</script>
						@endif
						<hr>
						@if(Partial::has($post,'PartialSoundCloud'))
							@input = array(
								'id'=>"soundcloud",
								'value'=>Partial::search($post,'PartialSoundCloud')['soundcloud_url'],
								'form' => array(
									'placeholder'=>Lang::get('association/edit/news.placeholder_title'),
									'class' => 'input-large',
									'tabindex'=>'1',
		                            'data-maxlength'=>"150",
		                            'data-minlength'=>"3",
								)
							)@
						@else
							@input = array(
								'id'=>"soundcloud",
								'form' => array(
									'placeholder'=>Lang::get('association/edit/news.placeholder_title'),
									'class' => 'input-large',
									'tabindex'=>'1',
		                            'data-maxlength'=>"150",
		                            'data-minlength'=>"3",
								)
							)@
						@endif
						{{SiteHelpers::simple_input($input)}}
						<hr>
					</div>
					
					<div id="youtube" 
					@if(!Partial::has($post,'PartialYoutube'))
						style="display:none;"
					@endif
					>
						<hr>
						@if(Partial::has($post,'PartialYoutube'))
			    			<div class="flex-video widescreen">
			    				<iframe src="https://www.youtube-nocookie.com/embed/{{Partial::search($post,'PartialYoutube')['youtube_slug']}}?rel=0" frameborder="0" allowfullscreen=""></iframe>
		    				</div>
						@endif

						@if(Partial::has($post,'PartialYoutube'))
							@input = array(
								'id'=>"youtube",
								'value'=>Partial::search($post,'PartialYoutube')['youtube_slug'],
								'form' => array(
									'placeholder'=>"L'identifiant de la vidéo",
									'class' => 'input-large',
									'tabindex'=>'1',
		                            'data-maxlength'=>"150",
		                            'data-minlength'=>"3",
								)
							)@
						@else
							@input = array(
								'id'=>"youtube",
								'form' => array(
									'placeholder'=>"L'identifiant de la vidéo",
									'class' => 'input-large',
									'tabindex'=>'1',
		                            'data-maxlength'=>"150",
		                            'data-minlength'=>"3",
								)
							)@
						@endif
						{{SiteHelpers::simple_input($input)}}
						<hr>
					</div>
					<div id="toolnews" class="blockquote text-center">
						<br>
						<a href="#" data-component="title" class="btn">
							<col-lg-><i class="fa 
							@if(Partial::has($post,'title'))
								fa-times
							@else
								fa-plus
							@endif
							"></i> Titre</col-lg->
						</a>
						<a href="#" data-component="textarea" class="btn">
							<col-lg-><i class="fa 
							@if(Partial::has($post,'text'))
								fa-times
							@else
								fa-plus
							@endif
							"></i> Texte</col-lg->
						</a>
						<a href="#" data-component="image" class="btn">
							<col-lg-><i class="fa fa-plus"></i> Image</col-lg->
						</a>
						<a href="#" data-component="soundcloud" class="btn">
							<col-lg-><i class="fa fa-plus"></i> Soundcloud</col-lg->
						</a>
						<a href="#" data-component="youtube" class="btn">
							<col-lg-><i class="fa fa-plus"></i> Youtube</col-lg->
						</a>
					</div>
				</div>
			</div>


			<br>
			<div class="text-right">
				<button class="button button-green" type="submit">Valider</button>
			</div>
			{{ Form::close() }}
		</div>
</section>

@stop

{{-- Footer script --}}
@section('footer-js')
	<script type="text/javascript">
	$(function() {
		$("#toolnews a").click(function(){
			$('#'+$(this).attr('data-component')).toggle();
			$(this).find('i').toggleClass("fa-times").toggleClass("fa-plus");
			return false;
		})
	});
	</script>
@stop