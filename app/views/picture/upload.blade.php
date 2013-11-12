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
				   <div class="js-files b-upload__files span21">
				      <div class="js-file-tpl b-thumb span4" data-id="<%=uid%>" title="<%-name%>, <%-sizeText%>">
				         <div class="b-thumb__preview">
				            <div class="b-thumb__preview__pic"></div>
				         </div>
				         <div class="b-thumb__progress progress progress-small"><div class="bar"></div></div>
				         <div class="b-text-center"><%-name%></div>
				      </div>
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
	<script src="/pluggin/jquery.fileapi/jcrop/jquery.Jcrop.min.js"></script>jquery.modal
	<link href="/pluggin/jquery.fileapi/jcrop/jquery.Jcrop.min.css" rel="stylesheet" type="text/css"/>
	<script src="/pluggin/jquery.fileapi/statics/jquery.modal.js"></script>
	<script>
	    $('#dnd').fileapi({
		   url: 'http://rubaxa.org/FileAPI/server/ctrl.php',
		   paramName: 'filedata',
		   autoUpload: true,
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
		         complete: { hide: '.progress' },
		         progress: '.progress .bar'
		      },
		      dnd: {
		         el: '.dropzone.drag-and-drop',
		         hover: 'in',
		         fallback: '.dropzone.no-drag-and-drop'
		      }
		   }
		});
	</script>
@stop

