@extends('template.theme')


@set_true $large_centred 
@section('large-content')
	<section>
		<div>
            <ul class="breadcrumb">
              <li><a href="/">Liste des Associations</a> </li>
              <li><a href="/{{$association->id}}-{{$association->slug}}">{{$association->name}}</a> </li>
              <li><a href="/{{$association->id}}/edit">Edition</a> </li>
			  <li class="active">Images</li>
            </ul>
			<div>
				<div id="dnd" class="b-upload b-upload_dnd">
					<div class="row">
						<div class="dropzone drag-and-drop col-sm-10 col-sm-push-1">
							<div class="text-center">
								<i class="fa fa-plus"></i><br>
								<col-lg->Glissez déposez vous images ici - ou cliquez moi dessus</col-lg->
							</div>
							<input type="file" name="files[]" multiple id="selectFile" accept="image/*">
						</div>
						<div class="dropzone no-drag-and-drop col-sm-10 col-sm-push-1" style="display:none;">
							<div class="text-center">
								<i class="fa fa-plus"></i><br>
								<col-lg->Cliquez ici pour selectionner les images à envoyer</col-lg->
							</div>
							<input type="file" name="files[]" multiple id="selectFile">
						</div>
					</div>
					<div class="row col-lg-12" style="margin-bottom: 20px; display:none;">
						<div class="ctrl-upload button button-green pull-right">Upload</div>
					</div>
					<div class="row js-files" style="display:none;">
				         <div class="js-file-tpl col-sm-2 img-polaroid" data-id="<%=uid%>" title="<%-name%>, <%-sizeText%>">
				            <div class="row">
				            <div class="b-thumb__preview pull-left">
				               <div class="b-thumb__preview__pic"></div>
				            </div>

				            <div data-fileapi="remove" class="pull-right"><i class="fa fa-trash-o" title="Supprimer le fichier"></i></div>
							@if(App::environment() != "production")
				            <% if( /^image/.test(type) ){ %>
				               <br><div data-fileapi="rotate.cw" class="pull-right"><i class="fa fa-repeat" title="Faire pivoter l'image"></i></div>
				            <% } %>
				            @endif
				            </div>
				            <div class="b-thumb__name"><%-name%></div>
				            <div class="progress">
							  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
							  </div>
							</div>
				            <div class="transfert-ok" style="display: none;">Transfert effectué</div>

				         </div>
				      </div>
				</div>
			</div>
		</div>
	</section>
			<section>
				<br>
				<div id="gallery" class="portfolio-items isotope">
					<!-- Pictures will go here ... -->
				</div>
			</section>
<style type="text/css">
	#gallery{
		margin: 30px 0 0 3%;
	}
	#dnd{
		margin-top: 40px;
	}
	.dropzone {
		background: none repeat scroll 0 0 rgba(0, 0, 0, 0.03);
		border: 3px dashed rgba(0, 0, 0, 0.03);
		border-radius: 3px;
		min-height: 115px;
		padding: 5px;
	    margin-bottom: 20px;
	}
	.dropzone.in{
		background: none repeat scroll 0 0 rgba(0, 0, 0, 0.04);
		border-color: rgba(0, 0, 0, 0.15);
	}
	.dropzone div {
		margin-top: 40px;
	}
	.dropzone input{
		float: left;
		height: 115px;
		opacity: 0;
		width: 100%;
		margin-top: -80px;
	}
	.table-option{
		margin-bottom: 0;
	}
	.table-option .item-option{
		text-align: center;
	}
	.b-thumb__preview{
		margin-left: 10px;
	}
	.b-thumb__name{
	    overflow: hidden;
	    text-overflow: ellipsis;
	    width: 110px;
	    white-space: nowrap;
	}
</style>
@stop
@section('footer-js')
	<script>
	    window.FileAPI = {
	          debug: false // debug mode
			, media: true
	        , staticPath: '/js/jquery.fileapi/FileAPI/' // path to *.swf
	    };
	</script>
	<script src="/pluggin/jquery.fileapi/FileAPI/FileAPI.min.js"></script>
	<script src="/pluggin/jquery.fileapi/jquery.fileapi.min.js"></script>
	<script id="photo-pattern" type="text/x-jquery-tmpl">
		<div class="element col-sm-${size} img-polaroid" >
			<img src="${thumbnail}" class="size${size}" />
			<div class="options row">
			<table class="table table-option text-center col-sm-10 col-sm-push-1">
                <tr>
                	<td class="item-option">
		                <a class="remove" href="#" onclick="imgDelete(this);return false;">
							<i class="fa fa-trash-o"></i>
						</a>
					</td>
	                <td class="item-option">
						<a class="fancybox" href="${url_img}" rel="/">
							<i class="fa fa-search-plus"></i>
						</a>
					</td>
					@if($hasNextStep)
					<td class="item-option">
						<a class="select" href="${url_crop}">
							<i class="fa fa-share"></i>
						</a>
					</td>
					@endif
                </tr>
            </table>
				
				
				
			</div>
		</div>
		{{--<div class="thumb-text">
			<b>${head}</b><br>
			<div class="divider"></div>
			<a href="#" title="Image Dummy Title" >${link}</a>
		</div>--}}
	</script>
	<script>
		$(".row.js-files").show();
	    $('#dnd').fileapi({
			url: "{{URLSubdomain::to('association','/upload')}}",
			data: { 'session-id': 123 }, // data with GET
			paramName: 'filedata',
            accept: 'image/*',
			multiple: true,
			chunkSize: 2 * FileAPI.MB,
			chunkUploadRetry: 3,
			elements: {
		      ctrl: { upload: '.ctrl-upload',abort: '.ctrl-abort' },
		      emptyQueue: { show: '.ctrl-upload',hide: '.ctrl-upload' },
		      list: '.js-files',
		      file: {
		         tpl: '.js-file-tpl',
		         preview: {
		            el: '.b-thumb__preview',
		            width: 148,
		            height: 148
		         },
		         upload: { show: '.progress-bar', hide: '.fa fa-repeat' },
		         complete: { show: '.transfert-ok',hide: '.progress-bar' },
		         progress: '.progress .progress-bar'
		      },
		      dnd: {
		         el: '.dropzone.drag-and-drop',
		         hover: 'in',
		         fallback: '.dropzone.no-drag-and-drop'
		      }
		   }
		}).on('filecomplete',function(err/**String*/, xhr/**Object*/, file/**Object/, options/**Object*/){
			if(xhr && xhr.result.error != "true"){
				// File successfully uploaded
				data = [{
					'url_crop':'/{{$association->id}}/edit/file/crop{{$typeCrop}}{{$action}}/'+xhr.result.img_name[0],
					'url_img':'http://img.vieassociative.fr/'+xhr.result.file[0],
					'thumbnail':'http://img.vieassociative.fr/'+xhr.result.thumbnail[0],
					'size' : '2',
				}];
				var newpic = $('#photo-pattern').tmpl(data);
				var imgLoad = imagesLoaded(newpic.find('img'));
			    imgLoad.on( 'done', function( instance ) {
					$('#gallery').prepend(newpic).masonry('prepended',newpic);
			    });
				$('#gallery .item-hover').each(function(){
					$(this).hover(function(){
						//in
						$(this).find('.hoverimage').show();
					},function(){
						//out
						$(this).find('.hoverimage').hide();
					});
				});
		    }else{
				console.log(xhr.result.status);
		    }
		});
		/*Gallery PART START*/
		var data = [
		@foreach($gallery['element'] as $e)
		{
			'url_crop':'/{{$association->id}}/edit/file/crop{{$typeCrop}}{{$action}}/{{$e->name_img}}',
			'url_img':'http://img.vieassociative.fr/{{$prefix}}{{$association->id}}/{{$e->name_img}}',
			'thumbnail':'http://img.vieassociative.fr/{{$prefix}}{{$association->id}}/{{$e->name_img}}_thumbnail.jpg',
			'size' : '2',
		},

		@endforeach]
		loadGallery($('#gallery'),data,$('#photo-pattern'));
		function open(){

		}
		function imgDelete(){
			data = {
				'head' : 'Vérification',
				'content' : 'Voulez vous vraiment supprimer cette image ?<br> ( Pour être honnete, cette fonctionnalité ne fonctionne pas encore )'
			};
			modalAgree(data);
		}
	/*Gallery PART END*/
	</script>
@stop

