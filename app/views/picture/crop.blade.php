@extends('template.theme')


@set_true $large_centred 
@section('large-content')
	<section>
		<div>
			<ul class="breadcrumb">
				<li><a href="#">Association</a> </li>
				<li><a href="/{{$association->id}}-{{$association->slug}}">{{$association->name}}</a> </li>
				<li><a href="/{{$association->id}}/edit">Edition</a> </li>
				<li class="active">Images</li>
			</ul>
			<div class="container">
				<div class="row">
					<div class="col-lg-11">
						<br>Etape #2 : Découpez votre image, puis validez :
						<img src="http://img.vieassociative.fr/{{$prefix}}{{$association->id}}/{{$name}}" id="jcrop_img" />
					</div>
				</div>






				<div class="row">
					<div class="col-lg-19">
						Résultat :<br>

						<div id="preview-pane">
							<div class="preview-container">
								<img src="http://img.vieassociative.fr/{{$prefix}}{{$association->id}}/{{$name}}" class="jcrop-preview" alt="Preview" />
							</div>
						</div>
					</div>

					
					<div class="col-lg-3" id="uploader">
						<div class="text-center">
							<form method="post">
								<input type="hidden" id="x" name="x" />
								<input type="hidden" id="y" name="y" />
								<input type="hidden" id="w" name="w" />
								<input type="hidden" id="h" name="h" />
								<div class="button button-green pull-right" id="validate">Valider</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<style type="text/css">
	#preview-pane {
		display: block;
		z-index: 2000;
		top: 10px;
		right: -280px;
		padding: 6px;
	}
	#preview-pane .preview-container {
		@if($x > 890)
		width: 890px;
		height: {{ceil(890*$y/$x)}}px;
		@else
		width: {{$x}}px;
		height: {{$y}}px;
		@endif
		overflow: hidden;
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
		$(function(){
			var jcrop_api,
			boundx,
			boundy,
			// Grab some information about the preview pane
			$preview = $('#preview-pane'),
			$pcnt = $('#preview-pane .preview-container'),
			$pimg = $('#preview-pane .preview-container img'),
			xsize = $pcnt.width(),
			ysize = $pcnt.height();

			var img_original_h,
			img_original_w;

			var newImg = new Image();
			var jcrop_img;
		    newImg.onload = function() {
		    	img_original_h = newImg.height;
		    	img_original_w = newImg.width;
		    	jcrop_img = $('#jcrop_img').Jcrop({
					onChange: updateCoords,
					onSelect: updateCoords,
					aspectRatio: xsize / ysize,
					trueSize: [img_original_w,img_original_h]
				},function(){
					// Use the API to get the real image size
					var bounds = this.getBounds();
					boundx = bounds[0];
					boundy = bounds[1];

					var coord = [
						Math.round(Math.random() * bounds[0]),
						Math.round(Math.random() * bounds[1]),
						Math.round(Math.random() * bounds[0]),
						Math.round(Math.random() * bounds[1])
					];
					this.setSelect(coord);

					// Store the API in the jcrop_api variable
					jcrop_api = this;
				});
		    }
		    newImg.src = $pimg.attr('src'); // this must be done AFTER setting onload



			function updateCoords(c)
			{
				if (parseInt(c.w) > 0){
					var rx = xsize / c.w;
					var ry = ysize / c.h;
					console.log(rx * boundx);
					$pimg.css({
						width: Math.round(rx * boundx) + 'px',
						height: Math.round(ry * boundy) + 'px',
						marginLeft: '-' + Math.round(rx * c.x) + 'px',
						marginTop: '-' + Math.round(ry * c.y) + 'px'
					});
				}

				$('#x').val(c.x);
				$('#y').val(c.y);
				$('#w').val(c.w);
				$('#h').val(c.h);
			};
		});


		function checkCoords()
		{
			if (parseInt($('#w').val())) return true;
			alert('Please select a crop region then press submit.');
			return false;
		};
		$('#validate').click(function(){
			if(checkCoords()){
				$(this).parent().submit();
			}
		})
		
	</script>
@stop

