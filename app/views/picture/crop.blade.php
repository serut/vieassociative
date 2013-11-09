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
				<div class="row span21" id="uploader">
					<div class="span10">
						Etape #1 : Sélectionnez une image :<br>
						<div class="js-fileapi-wrapper">
							<div class="js-browse">
								<input type="file" name="filedata">
							</div>
							<div class="js-upload" style="display: none;">
								<div class="progress progress-success"><div class="js-progress bar"></div></div>
								<span class="btn-txt">Envoi en cours</span>
							</div>
						</div>
					</div>
					<div class="pull-right">
						Résultat :<br>
						<div class="preview-pic ">
							<div class="js-preview"></div>
						</div>
					</div>
					<div class="span1">
					</div>
				</div>
				<div id="cropper" class="popup__body span21" style="display: none;">
					<hr>
					<div class="button button-green pull-right" id="validate">Valider</div>
					<br>Etape #2 : Découpez votre image, puis validez :
					<div class="js-img"></div>
				</div>
			</div>
		</div>
	</section>
<style type="text/css">
	.preview-pic {
		background: url("http://expomap.ru/images/users/no-userpic-big.gif") no-repeat scroll 0 0 / cover rgba(0, 0, 0, 0);
		border: 2px solid #AAAAAA;
		display: inline-block;
		height: 200px;
		position: relative;
		width: 200px;
	}
	.js-img{
		margin-top: 40px;
	}
</style>
@stop
@section('footer-js')
	<script>
		window.FileAPI = {
			debug: false, // debug mode
			staticPath: '/js/jquery.fileapi/FileAPI/' // path to *.swf
		};
	</script>
	<script src="/pluggin/jquery.fileapi/FileAPI/FileAPI.min.js"></script>
	<script src="/pluggin/jquery.fileapi/jquery.fileapi.min.js"></script>
	<script src="/pluggin/jquery.fileapi/jcrop/jquery.Jcrop.min.js"></script>
	<link href="/pluggin/jquery.fileapi/jcrop/jquery.Jcrop.min.css" rel="stylesheet" type="text/css"/>
	<script>
		$('#uploader').fileapi({
			url: 'http://rubaxa.org/FileAPI/server/ctrl.php',
			accept: 'image/*',
			imageSize: { minWidth: 200, minHeight: 200 },
			elements: {
				active: { show: '.js-upload', hide: '.js-browse' },
				preview: {
					 el: '.js-preview',
					 width: 200,
					 height: 200
				},
				progress: '.js-progress'
			},
			onSelect: function (evt, ui){
				var file = ui.files[0];
				if( file ){
					$('#cropper').show();
					$('#validate').click(function(){
						$('#uploader').fileapi('upload');
						$(this).hide();
					});
					$('.js-img').cropper({
						file: file,
						bgColor: '#fff',
						maxSize: [$('.js-img').width(), $('.js-img').width()-100],
						minSize: [200, 200],
						selection: '90%',
						aspectRatio: 1,
						onSelect: function (coords){
							$('#uploader').fileapi('crop', file, coords);
						}
					});
				}
			}
		});
		
	</script>
@stop

