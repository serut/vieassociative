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
					<span><i class="fa fa-plus"></i> Titre</span>
				</a>
				<a href="#" data-component="textarea" class="btn" onclick="addTextArea();return false;">
					<span><i class="fa fa-plus"></i> Texte</span>
				</a>
				@if(App::environment() != "production")
				<a href="#" data-component="image" class="btn" onclick="addImage();return false;">
					<span><i class="fa fa-plus"></i> Image</span>
				</a>
				<a href="#" data-component="soundcloud" class="btn" onclick="addSoundcloud();return false;">
					<span><i class="fa fa-plus"></i> Soundcloud</span>
				</a>
				<a href="#" data-component="youtube" class="btn" onclick="addYoutube();return false;">
					<span><i class="fa fa-plus"></i> Youtube</span>
				</a>
				@endif
			</div>
			<div class="text-right">
				@if(App::environment() != "production")
				<a class="button button-green" onclick="modePreview()">Preview</a>
				@endif
				<a class="button button-green" onclick="save();">Publier</a>
			</div>
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
    var URL_RETURN = '/{{$association->id}}-{{$association->slug}}';
    var error_spotted = false;
	$(function() {
		var data = {};
		@if($id_news ==0)
	   		addTitle();
	   		addTextArea();
   		@else
	   		@foreach($news['data'] as $n)
		   		@if($n['type'] == "PartialTitle")
			   		data = {
			   			'title': '{{$n['title']}}',
			   			'partial_id' : {{$n['partial_id']}}
			   		}
			   		addTitle(data);
			   	@else
				   	@if($n['type'] == "PartialText")
				   		data = {
				   			'text': '{{$n['text']}}',
				   			'partial_id' : {{$n['partial_id']}}
				   		}
				   		addTitle(data);
					@endif
				@endif
			@endforeach
		@endif
	});



	function addTextArea(data){
		if(!data){
			data = {
	   			'text': '',
	   			'partial_id' : "0"
	   		};
		}
   		$('#textarea-pattern').tmpl(data).appendTo('#news-editor');
   		myWysiwyg($("#textarea-"+ORDER));
   		ORDER = ORDER+1;
	}
	function textareaPreview(el){
		var textID = el.parent().parent().attr('data-id-partial');
		$(el).parent().parent().parent().find(".textarea-preview").html($(el).parent().parent().parent().find(".wysiwyg-editor").html())
	}
	function saveTextarea(el,index){
		var id_el = el.attr('data-id-partial');
		$.ajax({
            type: "POST",
            url: '/'+IDASSOC+'/form/news/textarea',
            async: false,
            dataType: "json",
            data: {
            	'id': id_el,
            	'id_news':IDNEWS,
            	'textarea':$(el).parent().find(".wysiwyg-editor").html(),
            	'order':index,
        	}
        }).done(function ( data ) {
        	if(el.attr('data-id-partial') == "0")
        		el.attr('data-id-partial',data['id_textarea']);
        },el).fail(function() {
        	error_spotted++;
        });
	}



	function addTitle(data){
		if(!data){
			data = {
	   			'text': '',
	   			'partial_id' : "0"
	   		};
		}
   		$('#title-pattern').tmpl(data).appendTo('#news-editor');
   		ORDER = ORDER+1;
	}
	function titlePreview(el){
		var titleID = el.parent().parent().attr('data-id-partial');
		$(el).parent().parent().parent().find("h4").text($(el).parent().parent().parent().find("input").val())
	}
	function saveTitle(el,index){
		var id_el = el.attr('data-id-partial');
		$.ajax({
            type: "POST",
            url: '/'+IDASSOC+'/form/news/title',
            async: false,
            dataType: "json",
            data: {
            	'id': id_el,
            	'id_news':IDNEWS,
            	'title':$(el).parent().find("input").val(),
            	'order':index,
        	}
        },el).done(function ( data ) {
        	if(el.attr('data-id-partial') == "0")
        		el.attr('data-id-partial',data['id_title']);
        }).fail(function() {
        	error_spotted++;
        });

	}



	function addImage(el){

	}
	function imagePreview(el){

	}
	function saveImage(el,index){

	}



	function addSoundcloud(el){

	}
	function soundCloudPreview(el){

	}
	function saveSoundCloud(el,index){

	}





	function addYoutube(el){

	}
	function previewYoutube(el){

	}
	function saveYoutube(el,index){

	}


	function save(){
        if(IDNEWS == 0){
        	create_news();
        }else{
        	save_2();
        }
	}
	function save_2(){
		var statuts = true;
        $.each($('.nav-tabs'),function(index){
        	saveElement($(this).attr('data-type'),$(this),index);
        });
        if(error_spotted == 0){
        	window.location = URL_RETURN;
        }else{
        	alert("Impossible de valider le formulaire tel quel");
        	error_spotted = 0;
        }
	}
	function saveElement(type, el,index){
		if(type=="title"){
			return saveTitle(el,index);
		}
		else{
			if(type=="textarea"){
				return saveTextarea(el,index);
			}
		}
	}
	function create_news(){
		$.ajax({
            type: "POST",
            url: '/'+IDASSOC+'/form/news/add',
            dataType: "json",
            async: false,
            data: {'id':0}
        }).done(function ( data ) {
	        IDNEWS = data['id_news'];
        	save_2();
        }).fail(function() {
        	error_spotted++;
        });
	}

	function modePreview(){
		$('.nav-tabs').toggleClass("hidden-xs");
	}

	</script>
	<script id="title-pattern" type="text/x-jquery-tmpl">
		<div>
			<ul class="nav nav-tabs" data-id-partial="${partial_id}" data-type="title">
				<li class="active"><a href="#title-${ORDER}" data-toggle="tab">Editer</a></li>
				<li class=""><a onclick="titlePreview($(this));" href="#title-${ORDER}-preview" data-toggle="tab">Tester</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade active in" id="title-${ORDER}">
					<input placeholder="Le titre de votre publication" class="form-control" tabindex="1" data-maxlength="150" data-minlength="3" id="title" name="title" type="text" value="${title}">
					{{-- @input = array(
										'id'=>"title",
										'form' => array(
											'placeholder'=>Lang::get('association/edit/news.placeholder_title'),
											'class' => 'form-control',
											'tabindex'=>'1',
					                        'data-maxlength'=>"150",
					                        'data-minlength'=>"3",
										)
									)@
									{{SiteHelpers::simple_input($input)}} --}}
				</div>
				<div class="tab-pane fade" id="title-${ORDER}-preview">
					<h4></h4>
				</div>
			</div>
		</div>
	</script>


	<script id="textarea-pattern" type="text/x-jquery-tmpl">
		<div>
			<ul class="nav nav-tabs" data-id-partial="${partial_id}" data-type="textarea">
				<li class="active"><a href="#textarea-${ORDER}" data-toggle="tab">Editer</a></li>
				<li class=""><a onclick="textareaPreview($(this));" href="#textarea-${ORDER}-preview" data-toggle="tab">Tester</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade active in" id="textarea-${ORDER}">
				<div>              <div class="btn-toolbar" data-role="editor-toolbar" data-target="#editor"><div class="btn-group">                  <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>                    <ul class="dropdown-menu">                    </ul>                </div>                <div class="btn-group">                  <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>                    <ul class="dropdown-menu">                    <li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>                    <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>                    <li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>                    </ul>                </div><div class="btn-group">                  <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>                  <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>                  <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>                  <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>                </div>                <div class="btn-group">                  <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>                  <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>                  <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-outdent"></i></a>                  <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>                </div>                <div class="btn-group">                  <a class="btn btn-info" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>                  <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>                  <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>                  <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>                </div>                <div class="btn-group">                  <input type="text" data-edit="inserttext" id="voiceBtn" x-webkit-speech="">                </div></div>              <div class="wysiwyg-editor" tab-index="2" data-name="text">${text}</div>          </div>
					{{--{{SiteHelpers::add_textarea('text',"", true, true)}}--}}
				</div>
				<div class="tab-pane fade" id="textarea-${ORDER}-preview">
					<div class="textarea-preview">Texte</div>
				</div>
			</div>
		</div>
	</script>

@stop

