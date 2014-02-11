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
				<a href="#" data-component="image" class="btn" onclick="addOnePicture();return false;">
					<span><i class="fa fa-plus"></i> Image</span>
				</a>
				@if(App::environment() != "production")
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
			   		data = 
			   		{{json_encode(array(
			   			'title'=>$n['title'],
			   			'partial_id'=>$n['partial_id']
			   		))}}

			   		addTitle(data);
			   	@else
				   	@if($n['type'] == "PartialText")
				   		data = 
				   		{{json_encode(array(
				   			'text'=>$n['text'],
				   			'partial_id'=>$n['partial_id']
				   		))}}

				   		addTextArea(data);
				   	@else
					   	@if($n['type'] == "PartialOnePicture")
					   		data = 
					   		{{json_encode(array(
					   			'url_img'=>$n['url_img'],
					   			'partial_id'=>$n['partial_id']
					   		))}}

					   		addOnePicture(data);
						@else
						   	@if($n['type'] == "PartialYoutube")
						   		data = 
						   		{{json_encode(array(
						   			'url_youtube'=>$n['url_youtube'],
						   			'partial_id'=>$n['partial_id']
						   		))}}

						   		addYoutube(data);
							@endif
						@endif
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
   		myWysiwyg($("#textarea-"+ORDER+" .wysiwyg-editor"));

   		ORDER = ORDER+1;
	}
	function textareaPreview(el){
		//var textID = el.parent().parent().attr('data-id-partial');
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
		//var titleID = el.parent().parent().attr('data-id-partial');
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



	function addOnePicture(data){
		if(!data){
			data = {
	   			'url_img': '',
	   			'partial_id' : "0"
	   		};
		}
   		$('#onepicture-pattern').tmpl(data).appendTo('#news-editor');
   		ORDER = ORDER+1;
	}
	function onePicturePreview(el){
		//var imgID = el.parent().parent().attr('data-id-partial');
		$(el).parent().parent().parent().find(".onepicture-preview").attr('src',($(el).parent().parent().parent().find("input").val()))
	}
	function saveImage(el,index){
		var id_el = el.attr('data-id-partial');
		$.ajax({
            type: "POST",
            url: '/'+IDASSOC+'/form/news/onepicture',
            async: false,
            dataType: "json",
            data: {
            	'id': id_el,
            	'id_news':IDNEWS,
            	'onepicture':$(el).parent().find("input").val(),
            	'order':index,
        	}
        },el).done(function ( data ) {
        	if(el.attr('data-id-partial') == "0")
        		el.attr('data-id-partial',data['id_onepicture']);
        }).fail(function() {
        	error_spotted++;
        });
	}



	function addSoundcloud(data){
		if(!data){
			data = {
	   			'url_soundcloud': '',
	   			'partial_id' : "0"
	   		};
		}
		$('#soundcloud-pattern').tmpl(data).appendTo('#news-editor');
   		ORDER = ORDER+1;
	}
	function soundCloudPreview(el){
		//http://developers.soundcloud.com/docs/api/guide#uploading
		//http://soundcloud.com/you/apps
		$(el).parent().parent().parent().find(".soundcloud-preview").attr('src',"https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/"+($(el).parent().parent().parent().find("input").val())+"%3Fsecret_token%3Ds-eBsGL&amp;auto_play=false&amp;hide_related=false&amp;visual=true")
	}
	function saveSoundCloud(el,index){
		var id_el = el.attr('data-id-partial');
		$.ajax({
            type: "POST",
            url: '/'+IDASSOC+'/form/news/soundcloud',
            async: false,
            dataType: "json",
            data: {
            	'id': id_el,
            	'id_news':IDNEWS,
            	'soundcloud':$(el).parent().find("input").val(),
            	'order':index,
        	}
        },el).done(function ( data ) {
        	if(el.attr('data-id-partial') == "0")
        		el.attr('data-id-partial',data['id_soundcloud']);
        }).fail(function() {
        	error_spotted++;
        });
	}





	function addYoutube(data){
		if(!data){
			data = {
	   			'url_youtube': '',
	   			'partial_id' : "0"
	   		};
		}
		$('#youtube-pattern').tmpl(data).appendTo('#news-editor');
   		ORDER = ORDER+1;
	}
	function youtubePreview(el){
		//var youtubeID = el.parent().parent().attr('data-id-partial');
		$(el).parent().parent().parent().find(".youtube-preview").attr('src',"https://www.youtube-nocookie.com/embed/"+($(el).parent().parent().parent().find("input").val()))
	}
	function saveYoutube(el,index){
		var id_el = el.attr('data-id-partial');
		$.ajax({
            type: "POST",
            url: '/'+IDASSOC+'/form/news/youtube',
            async: false,
            dataType: "json",
            data: {
            	'id': id_el,
            	'id_news':IDNEWS,
            	'youtube':$(el).parent().find("input").val(),
            	'order':index,
        	}
        },el).done(function ( data ) {
        	if(el.attr('data-id-partial') == "0")
        		el.attr('data-id-partial',data['id_youtube']);
        }).fail(function() {
        	error_spotted++;
        });
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
		}else{
			if(type=="textarea"){
				return saveTextarea(el,index);
			}else{
				if(type=="onepicture"){
					return saveImage(el,index);
				}else{
					if(type=="youtube"){
						return saveYoutube(el,index);
					}else{
						if(type=="soundcloud"){
							return saveSoundCloud(el,index);
						}
					}
				}
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
			<ul class="nav nav-tabs nav-right" data-id-partial="${partial_id}" data-type="title">
				<li class="active"><a href="#title-${ORDER}" data-toggle="tab"><i class="fa fa-wrench"></i> Editer</a></li>
				<li class=""><a onclick="titlePreview($(this));" href="#title-${ORDER}-preview" data-toggle="tab"><i class="fa fa-rocket"></i> Tester</a></li>
				<li class=""><a><i class="fa fa-times"></i></a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade active in" id="title-${ORDER}">
					<input placeholder="Le titre de votre publication" class="form-control" tabindex="1" data-maxlength="150" data-minlength="3" id="title" name="title" type="text" value="${title}">
					{{-- @input = array(
						'id'=>"title",
						'form' => array(
							'placeholder'=>Lang::get('association/edit/news.placeholder_title'),
							'class' => 'form-control',
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
				<div>              <div class="btn-toolbar" data-role="editor-toolbar" data-target="#editor"><div class="btn-group">                  <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>                    <ul class="dropdown-menu">                    </ul>                </div>                <div class="btn-group">                  <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>                    <ul class="dropdown-menu">                    <li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>                    <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>                    <li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>                    </ul>                </div><div class="btn-group">                  <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>                  <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>                  <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>                  <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>                </div>                <div class="btn-group">                  <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>                  <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>                  <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-outdent"></i></a>                  <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>                </div>                <div class="btn-group">                  <a class="btn btn-info" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>                  <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>                  <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>                  <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>                </div>                <div class="btn-group">                  <input type="text" data-edit="inserttext" id="voiceBtn" x-webkit-speech="">                </div></div>              <div class="wysiwyg-editor" tab-index="2" data-name="text">
				@{{html text}}
				</div></div>
					{{--{{SiteHelpers::add_textarea('text',"", true, true)}}--}}
				</div>
				<div class="tab-pane fade" id="textarea-${ORDER}-preview">
					<div class="textarea-preview">Texte</div>
				</div>
			</div>
		</div>
	</script>

	<script id="onepicture-pattern" type="text/x-jquery-tmpl">
		<div>
			<ul class="nav nav-tabs" data-id-partial="${partial_id}" data-type="onepicture">
				<li class="active"><a href="#onepicture-${ORDER}" data-toggle="tab">Editer</a></li>
				<li class=""><a onclick="onePicturePreview($(this));" href="#onepicture-${ORDER}-preview" data-toggle="tab">Tester</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade active in" id="onepicture-${ORDER}">
					<input placeholder="URL de l&#039;image" class="form-control" id="onepicture" name="onepicture" type="text" value="${url_img}">
					<span class="text-danger">	</span>				
					{{--
					@input = array(
						'id'=>"onepicture",
						'form' => array(
							'placeholder'=>"URL de l'image",
							'class' => 'form-control',
						)
					)@
					{{SiteHelpers::simple_input($input)}}  --}}
				</div>
				<div class="tab-pane fade" id="onepicture-${ORDER}-preview">
					<img src="#" class="onepicture-preview">
				</div>
			</div>
		</div>
	</script>


	<script id="soundcloud-pattern" type="text/x-jquery-tmpl">
		<div>
			<ul class="nav nav-tabs" data-id-partial="${partial_id}" data-type="soundcloud">
				<li class="active"><a href="#soundcloud-${ORDER}" data-toggle="tab">Editer</a></li>
				<li class=""><a onclick="soundcloudPreview($(this));" href="#soundcloud-${ORDER}-preview" data-toggle="tab">Tester</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade active in" id="soundcloud-${ORDER}">

					{{--  --}}
					@input = array(
						'id'=>"soundcloud",
						'form' => array(
							'placeholder'=>"L'url du son SoundCloud",
							'class' => 'form-control',
						)
					)@
					{{SiteHelpers::simple_input($input)}}
				</div>
				<div class="tab-pane fade" id="soundcloud-${ORDER}-preview">
					<iframe class="soundcloud-preview" src="#" height="450" width="100%" frameborder="no" scrolling="no"></iframe>
				</div>
			</div>
		</div>
	</script>


	<script id="youtube-pattern" type="text/x-jquery-tmpl">
		<div>
			<ul class="nav nav-tabs" data-id-partial="${partial_id}" data-type="youtube">
				<li class="active"><a href="#youtube-${ORDER}" data-toggle="tab">Editer</a></li>
				<li class=""><a onclick="youtubePreview($(this));" href="#youtube-${ORDER}-preview" data-toggle="tab">Tester</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade active in" id="youtube-${ORDER}">
					<input type="text" value="${url_youtube}" name="youtube" id="youtube" class="form-control" placeholder="L'identifiant de la vidéo Youtube">
					{{--  
					@input = array(
						'id'=>"youtube",
						'form' => array(
							'placeholder'=>"L'identifiant de la vidéo Youtube",
							'class' => 'form-control',
						)
					)@
					{{SiteHelpers::simple_input($input)}}--}}
				</div>
				<div class="tab-pane fade" id="youtube-${ORDER}-preview">
					<iframe class="youtube-preview" src="#" frameborder="0" allowfullscreen=""></iframe>
				</div>
			</div>
		</div>
	</script>

@stop

