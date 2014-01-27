@extends('template.theme')




@set_true $large_centred 
@section('large-content')
<section>
		<div>
			<ul class="breadcrumb">
				<li><a href="/{{$association->id}}-{{$association->slug}}">{{$association->name}}</a> <span class="divider">/</span></li>
				<li><a href="/{{$association->id}}/edit">Edition</a> <span class="divider">/</span></li>
				<li><a href="/{{$association->id}}/edit/news">Mes publications</a> <span class="divider">/</span></li>
				<li class="active">Editer une publication</li>
			</ul>
			<h3 class="head">{{Lang::get('association/edit/news.modify_news')}}</h3>
			{{ Form::open(array('class'=> 'form-horizontal','data-validate'=>'our-parsey', 'data-loading'=>'true')) }}
			<div class="row">
				<div class="span2">
					<img src="{{$association->getLogo()}}" class="img-circle">
				</div>
				<div class="span20">
					
					<div id="title"
					@if(Partial::has($post,'title'))
						style="display:none;"
					@endif
					>
						@input = array(
							'id'=>"title",
							@if(Partial::has($post,'title'))
							'value'=>Partial::search($post,'title')['title'],
							@endif
							'form' => array(
								'placeholder'=>Lang::get('association/edit/news.placeholder_title'),
								'class' => 'input-xxlarge',
								'tabindex'=>'1',
	                            'data-maxlength'=>"150",
	                            'data-minlength'=>"3",
							)
						)@
						{{SiteHelpers::simple_input($input)}}
					</div>
					@endif



					<div id="textarea">
						{{SiteHelpers::add_textarea('text',$post->var1, true, true)}}
					</div>

					<div id="soundcloud" style="display:none;">
						@if(Partial::has($post,'soundcloud'))
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
						@input = array(
							'id'=>"soundcloud",
							//'value'=>$post->var1,
							'form' => array(
								'placeholder'=>Lang::get('association/edit/news.placeholder_title'),
								'class' => 'input-large',
								'tabindex'=>'1',
	                            'data-maxlength'=>"150",
	                            'data-minlength'=>"3",
							)
						)@
						{{SiteHelpers::simple_input($input)}}
						<hr>
					</div>
					
					<div id="youtube" style="display:none;">
						<hr>
						@if(Partial::has($post,'youtube'))
			    			<div class="flex-video widescreen">
			    				<iframe src="https://www.youtube-nocookie.com/embed/4TlJ4qKO2Xg?rel=0" frameborder="0" allowfullscreen=""></iframe>
		    				</div>
						@endif

						@input = array(
							'id'=>"youtube",
						@if(Partial::has($post,'youtube'))
							'value'=>$post->var1,
						@endif
							'form' => array(
								'placeholder'=>"L'identifiant de la vidéo",
								'class' => 'input-large',
								'tabindex'=>'1',
	                            'data-maxlength'=>"150",
	                            'data-minlength'=>"3",
							)
						)@
						{{SiteHelpers::simple_input($input)}}
						<hr>
					</div>
					<div id="toolnews" class="blockquote text-center">
						<br>
						<a href="#" data-component="title" class="btn">
							<span><i class="fa 
							@if(Partial::has($post,'title'))
								fa-times
							@else
								fa-plus
							@endif
							"></i> Titre</span>
						</a>
						<a href="#" data-component="textarea" class="btn">
							<span><i class="fa 
							@if(Partial::has($post,'text'))
								fa-times
							@else
								fa-plus
							@endif
							"></i> Texte</span>
						</a>
						<a href="#" data-component="image" class="btn">
							<span><i class="fa fa-plus"></i> Image</span>
						</a>
						<a href="#" data-component="soundcloud" class="btn">
							<span><i class="fa fa-plus"></i> Soundcloud</span>
						</a>
						<a href="#" data-component="youtube" class="btn">
							<span><i class="fa fa-plus"></i> Youtube</span>
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