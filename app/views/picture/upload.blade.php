@extends('template.theme')


@set_true $large_centred 
@section('large-content')
	<section>
		<div>
			<ul class="breadcrumb">
				<li><a href="#">Association</a> <span class="divider">/</span></li>
				<li><a href="/1-qsdf">Faites de la musique</a> <span class="divider">/</span></li>
				<li><a href="/1/edit">Edition</a> <span class="divider">/</span></li>
				<li class="active">Images</li>
			</ul>
			<div class="container">
				<br>
				<div id="dnd" class="b-upload b-upload_dnd">
					<div class="row">
						<div class="dropzone drag-and-drop span22">
							<div class="text-center">
								<i class="icon-plus"></i><br>
								<span>Glissez déposez vous fichier ici - ou cliquez moi dessus</span>
							</div>
							<input type="file" name="files[]" multiple id="selectFile">
						</div>
						<div class="dropzone no-drag-and-drop span22">
							<div class="text-center">
								<i class="icon-plus"></i><br>
								<span>Cliquez ici pour selectionner les fichiers à envoyer</span>
							</div>
							<input type="file" name="files[]" multiple id="selectFile">
						</div>
					</div>

					<div class="js-files b-upload__files" >
				    	<div class="js-file-tpl b-thumb span4" data-id="<%=uid%>" title="<%-name%>, <%-sizeText%>">
					         <div class="b-thumb__preview fancybox" rel="gallery1" >
					            <div class="b-thumb__preview__pic"></div>
					         </div>
					         <div class="b-thumb__progress progress progress-small"><div class="bar"></div></div>
					         <div class="b-text-center"></div>
					    </div>
						<div class="thumb-text">
							<b><%-name%></b><br>
							<div class="divider"></div>
							<a href="#" title="Image Dummy Title" ><%-name%></a>
						</div>
					</div>
				</div>
				<div id="div-hidden-photo">
					<div id="gallery" class="portfolio-items isotope span23">
						<!-- Pictures will go here ... -->
					</div>
				</div>
			</div>
		</div>
	</section>
<style type="text/css">
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
	.webcam, .userpic {
	    background: url("http://expomap.ru/images/users/no-userpic-big.gif") no-repeat scroll 0 0 / cover rgba(0, 0, 0, 0);
	    border: 2px solid #AAAAAA;
	    display: inline-block;
	    height: 200px;
	    position: relative;
	    width: 200px;
	}
</style>
@stop
@section('footer-js')
	<script>
	    window.FileAPI = {
	          debug: false // debug mode
	        , staticPath: '/js/jquery.fileapi/FileAPI/' // path to *.swf
	    };
	</script>
	<script src="/pluggin/jquery.fileapi/FileAPI/FileAPI.min.js"></script>
	<script src="/pluggin/jquery.fileapi/jquery.fileapi.min.js"></script>
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
	<script>
	    $('#dnd').fileapi({
		   url: "{{URLSubdomain::to('association','/upload')}}",
		   paramName: 'filedata',
		   autoUpload: true,
		   chunkSize: 2 * FileAPI.MB,
			chunkUploadRetry: 3,
		    elements: {
		      list: '.js-files',
		      file: {
		         tpl: '.js-file-tpl',
		         preview: {
		            el: '.b-thumb__preview',
		            width: 150,
		            height: 150
		         },
		         upload: { show: '.progress' },
		         complete: { hide: '.progress'},
		         progress: '.progress .bar'
		      },
		      dnd: {
		         el: '.dropzone.drag-and-drop',
		         hover: 'in',
		         fallback: '.dropzone.no-drag-and-drop'
		      }
		   }
		}).on('filecomplete',function(err/**String*/, xhr/**Object*/, file/**Object/, options/**Object*/){
			if( !err ){
		      // File successfully uploaded
		      var result = xhr.responseText;
		    }
			console.log('File completed');
			console.log(file);
			$('#gallery').masonry( 'addItems',file);
		})
		/*Gallery PART START*/
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
	/*Gallery PART END*/
	</script>
@stop

