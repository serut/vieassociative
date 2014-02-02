@extends('template.theme')




@set_true $medium_centred 
@section('medium-content')
<section>
		<div>
			<ul class="breadcrumb">
            	<li><a href="/">Liste des Associations</a> </li>
				<li><a href="/{{$association->id}}-{{$association->slug}}">{{$association->name}}</a> </li>
				<li><a href="/{{$association->id}}/edit">Edition</a> </li>
				<li><a href="/{{$association->id}}/edit/news">Mes publications</a> </li>
				<li class="active">Editer une publication</li>
			</ul>
			<h3 class="head">{{Lang::get('association/edit/news.modify_news')}}</h3>
			{{ Form::open(array('class'=> 'form-horizontal','data-validate'=>'our-parsey', 'data-loading'=>'true')) }}
			<div class="row">
				<div>
					<img src="{{$association->getLogo()}}" class="img-circle col-sm-1">
				</div>
					<div class="col-sm-11" id="news-editor">
				</div>
			</div>
			<br>
			<div id="toolnews" class="blockquote text-center">
				<br>
				<a href="#" data-component="title" class="btn" onclick="addTitle();return false;">
					<col-lg-><i class="fa fa-plus"></i> Titre</col-lg->
				</a>
				<a href="#" data-component="textarea" class="btn" onclick="addTextArea();return false;">
					<col-lg-><i class="fa fa-plus"></i> Texte</col-lg->
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
			<div class="text-right">
				<a class="button button-green" onclick="modePreview()">Preview</a>
				<a class="button button-green" onclick="save();">Publier</a>
			</div>
			{{ Form::close() }}
		</div>
</section>

@stop

{{-- Footer script --}}
@section('footer-js')
	<script id="photo-pattern" type="text/x-jquery-tmpl"></script>
	<script type="text/javascript">
    var IDASSOC = {{$association->id}};
    var IDNEWS = {{$id_news}};
    var ORDER = 0;
	$(function() {
		var data = {};
		@if($id_news ==0)
	   		addTitle({'id_news':{{$id_news}}});
	   		addTextArea({'id_news':{{$id_news}}});
	   		@else
	   		@foreach($news['data'] as $n)
		   		@if($n['type'] == "title")
		   		addTitle($n);
				@endif
			@endforeach
		@endif
	});
	function titlePreview(el){
		var titleID = el.parent().parent().attr('data-id-partial');
		$(el).parent().parent().parent().find("h4").text($(el).parent().parent().parent().find("input").val())
	}
	function textareaPreview(el){
		var textID = el.parent().parent().attr('data-id-partial');
		$(el).parent().parent().parent().find(".textarea-preview").html($(el).parent().parent().parent().find(".wysiwyg-editor").html())
	}
	function addTextArea(data){
   		$('#textarea-pattern').tmpl(data).appendTo('#news-editor');
   		myWysiwyg($("#textarea-"+ORDER));
   		ORDER = ORDER+1;
	}
	function addTitle(data){
   		$('#title-pattern').tmpl(data).appendTo('#news-editor');
   		ORDER = ORDER+1;
	}
	function save(){
        if(IDNEWS == 0){
        	create_news();
        }else{
	        $.each($('.nav-tabs'),function(index){
	        	saveElement($(this).attr('data-type'),$(this),index);
	        });
        }
	}
	function saveElement(type, el,index){
		if(type=="title"){
			saveTitle(el,index);
		}
		else if(type=="textarea"){
			saveTextarea(el,index);
		}
	}
	function create_news(){
		$.ajax({
            type: "POST",
            url: '/'+IDASSOC+'/form/news/add',
            dataType: "json",
            data: {'id':0}
        }).done(function ( data ) {
	        IDNEWS = data['id_news'];
	        $.each($('.nav-tabs'),function(index){
	        	saveElement($(this).attr('data-type'),$(this),index);
	        });
        }).fail(function() {
            alert("error");
        });
	}
	function saveTitle(el,index){
		var id_el = el.attr('data-id-partial');
		$.ajax({
            type: "POST",
            url: '/'+IDASSOC+'/form/news/title',
            dataType: "json",
            data: {
            	'id': id_el,
            	'id_news':IDNEWS,
            	'title':$(el).parent().find("input").val(),
            	'order':index,
        	}
        }).done(function ( data ) {
        	return data;
        }).fail(function() {
            alert("error");
        });

	}
	function saveTextarea(el,index){
		var id_el = el.attr('data-id-partial');
		$.ajax({
            type: "POST",
            url: '/'+IDASSOC+'/form/news/textarea',
            dataType: "json",
            data: {
            	'id': id_el,
            	'id_news':IDNEWS,
            	'textarea':$(el).parent().find(".wysiwyg-editor").html(),
            	'order':index,
        	}
        }).done(function ( data ) {
        	return data;
        }).fail(function() {
            alert("error");
        });
	}

	function modePreview(){
		$('.nav-tabs').toggleClass("hidden-xs");
	}

	</script>
	<script id="title-pattern" type="text/x-jquery-tmpl">
		<div>
			<ul class="nav nav-tabs" data-id-partial="0" data-type="title">
				<li class="active"><a href="#title-${ORDER}" data-toggle="tab">Editer</a></li>
				<li class=""><a onclick="titlePreview($(this));" href="#title-${ORDER}-preview" data-toggle="tab">Tester</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade active in" id="title-${ORDER}">
					@input = array(
						'id'=>"title",
						'form' => array(
							'placeholder'=>Lang::get('association/edit/news.placeholder_title'),
							'class' => 'form-control',
							'tabindex'=>'1',
	                        'data-maxlength'=>"150",
	                        'data-minlength'=>"3",
						)
					)@
					{{SiteHelpers::simple_input($input)}}
				</div>
				<div class="tab-pane fade" id="title-${ORDER}-preview">
					<h4></h4>
				</div>
			</div>
		</div>
	</script>


	<script id="textarea-pattern" type="text/x-jquery-tmpl">
		<div>
			<ul class="nav nav-tabs" data-id-partial="0" data-type="textarea">
				<li class="active"><a href="#textarea-${ORDER}" data-toggle="tab">Editer</a></li>
				<li class=""><a onclick="textareaPreview($(this));" href="#textarea-${ORDER}-preview" data-toggle="tab">Tester</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade active in" id="textarea-${ORDER}">
					{{SiteHelpers::add_textarea('text',"", true, true)}}
				</div>
				<div class="tab-pane fade" id="textarea-${ORDER}-preview">
					<div class="textarea-preview">Texte</div>
				</div>
			</div>
		</div>
	</script>

@stop

