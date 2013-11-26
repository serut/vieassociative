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

					<div class="js-files b-upload__files modal">
				    	<div class="js-file-tpl b-thumb" data-id="<%=uid%>" title="<%-name%>, <%-sizeText%>">
							<table class="preview span4 table table-striped">
								<tr>
									<td>
								         <div class="b-thumb__preview fancybox " rel="gallery1" >
								            <div class="b-thumb__preview__pic"></div>
								         </div>
							         </td>
									<td>
								         <div class="b-thumb__progress progress progress-small"><div class="bar"></div></div>
								         <div class="b-text-center"></div>
							         </td>
								</tr>
							</table>
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
	.hoverimage { 
		position: absolute; 
		top: 0; 
		left: 0; 
		display: none;
		text-align: center;
		width: 100%;
		height: 98%;
	}
	.b-upload__files{
        bottom: 45px;
	    max-height: 150px;
	    left: 70%;
	    position: absolute;
	    top: auto;
	    width: 375px;
	    overflow: auto;
    }
	.hoverimage img.icn1 {
		top: 27%;
		left: 10px;
		position: absolute;
		z-index: 300;
		opacity: 0.7;
	}

	.hoverimage img.icn2 {
		top: 27%;
		left: 100px;
		position: absolute;
		z-index: 300;	
		opacity: 0.7;
	}

	.overlay-img {
		background-color: gray;
		opacity: 0.75;
		height: 100% !important;
		width: 100%;
	}

	.hoverimage img.icn1, .hoverimage img.icn2 {
		-webkit-transition-duration: 0.6s;
	    -moz-transition-duration: 0.6s;
		-o-transition-duration: 0.6s;
		transition-duration: 0.6s;
		-webkit-transition-property: opacity;
		-moz-transition-property: opacity;
		-o-transition-property: opacity;
		transition-property: opacity;
	}

	.hoverimage img.icn1:hover, .hoverimage img.icn2:hover {
		opacity: 1;
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
		<div class="element ${categories} span-size${size} item-hover" >
			<a class="fancybox" href="${url_img}" rel="gallery1" title="A title">
				<img src="${url_img}" class="size${size}"alt=" " />
			</a>
			<div class="hoverimage">
				<div class="overlay-img"></div>
				<a class="prettyPhoto" href="http://teothemes.com/wp/scrn/files/2012/12/FreeGreatPicture.com-30230-buick-regal-wallpaper.jpg">
					<img alt="" src="http://teothemes.com/wp/scrn/wp-content/themes/SCRN/images/overlay-icn1.png" class="icn1">
				</a>
				<a href="http://teothemes.com/wp/scrn/portfolio/project-title-5/" rel="nofollow" class="portf-load">
					<img alt="" src="http://teothemes.com/wp/scrn/wp-content/themes/SCRN/images/overlay-icn2.png" class="icn2">
				</a>
			</div>
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
		            width: 80,
		            height: 80
		         },
		         upload: {show: '.progress'},
		         complete: { hide: '.preview'},
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
			data = [{
				'url_img':'http://img.vieassociative.fr/'+xhr.result.files[0],
				'head':'WordPress Custom Theme',
				'link':'Read More',
				'categories':'illustration',
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
			}
			);
		})
		/*Gallery PART START*/
		var data = [{
			'url_img':'http://dummyimage.com/800x1600/4d494d/686a82.gif&text=placeholder+image',
			'head':'WordPress Custom Theme',
			'link':'Read More',
			'categories':'illustration design',
			'size' : '1',
		}]
		loadGallery($('#gallery'),data,$('#photo-pattern'));
	/*Gallery PART END*/
	</script>
@stop

