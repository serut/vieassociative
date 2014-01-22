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
			{{ Form::open(array('class'=> 'form-horizontal','data-validate'=>'our-parsey')) }}
			<div class="row">
				<div class="span2">
					<img src="{{$association->getLogo()}}" class="img-circle">
				</div>
				<div class="span20">
					<div id="title">
						@input = array(
							'id'=>"title",
							'value'=>$post->title,
							'form' => array(
								'placeholder'=>Lang::get('association/edit/news.placeholder_title'),
								'class' => 'input-xxlarge',
								'tabindex'=>'1',
							)
						)@
						{{SiteHelpers::simple_input($input)}}
					</div>
					<div id="textarea">
						{{SiteHelpers::add_textarea('text',$post->text, true, true)}}
					</div>
					<div id="panel">
						<a href="#" data-component="title"><span><i class="fa fa-plus"></i> Titre</span></a>
						<a href="#" data-component="textarea"><span><i class="fa fa-plus"></i> Texte</span></a>
						<a href="#" data-component=""><span><i class="fa fa-plus"></i> Image</span></a>
						<a href="#" data-component=""><span><i class="fa fa-plus"></i> Soundcloud</span></a>
						<a href="#" data-component=""><span><i class="fa fa-plus"></i> Youtube</span></a>
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
		$("#panel a").click(function(){
			$('#'+$(this).attr('data-component')).toggle();
		})
	});
	</script>
@stop