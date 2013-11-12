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
	<!-- The file upload form used as target for the file upload widget -->
	<form id="fileupload" action="{{URLSubdomain::to('www','/upload')}}" method="POST" enctype="multipart/form-data">
		<div class="dropzone span21">
			<div class="text-center">
				<i class="icon-plus"></i><br>
				<span>Glissez déposez vous fichier ici - ou cliquez moi dessus</span>
			</div>
			<input type="file" name="files[]" multiple id="selectFile">
		</div>
		
		<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
		<span class="fileupload-process"></span>
		<div class="row fileupload-buttonbar">
			<!-- The global progress state -->
			<div class="col-lg-5 fileupload-progress fade">
				<!-- The global progress bar -->
				<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
					<div class="progress-bar progress-bar-success" style="width:0%;"></div>
				</div>
				<!-- The extended global progress state -->
				<div class="progress-extended">&nbsp;</div>
			</div>
		</div>

		<!-- The table listing the files available for upload/download -->
		<div role="presentation" class="span22 row">
			<div class="files"></div>
		</div>
	</form>
	<br>
</div>
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

</style>
	</section>
@stop
@section('footer-js')
	<script id="template-upload" type="text/x-tmpl">
		{% for (var i=0, file; file=o.files[i]; i++) { %}
			<div class="template-upload fade span22">
				<div class="span4">
					<span class="preview"></span>
				</div>
				<div class="span7">
					<p class="name">{%=file.name%}</p>
					<strong class="error text-danger"></strong>
				</div>
				<div class="span5">
					<p class="size">Processing...</p>
					<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
				</div>
				<div class="span4">
					{% if (!i && !o.options.autoUpload) { %}
						<button class="btn btn-primary start" disabled>
							<i class="glyphicon glyphicon-upload"></i>
							<span>Start</span>
						</button>
					{% } %}
					{% if (!i) { %}
						<a class="cancel"><i class="glyphicon glyphicon-ban-circle"></i><span>Cancel</span></a>
						<button class="btn btn-warning cancel">
							<i class="glyphicon glyphicon-ban-circle"></i>
							<span>Cancel</span>
						</button>
					{% } %}
				</div>
			</div>
		{% } %}
	</script>
	<!-- The template to display files available for download -->
	<script id="template-download" type="text/x-tmpl">
		{% for (var i=0, file; file=o.files[i]; i++) { %}
			<div class="template-download fade span22">
				<div class="span4">
					<span class="preview">
						{% if (file.thumbnailUrl) { %}
							<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
						{% } %}
					</span>
				</div>
				<div class="span11">
					<p class="name">
						{% if (file.url) { %}
							<a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
						{% } else { %}
							<span>{%=file.name%}</span>
						{% } %}
					</p>
					{% if (file.error) { %}
						<div><span class="label label-danger">Error</span> {%=file.error%}</div>
					{% } %}
				</div>
				<div class="span3">
					<span class="size">{%=o.formatFileSize(file.size)%}</span>
				</div>
				<div class="span3">
					{% if (file.deleteUrl) { %}
						<button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
							<i class="glyphicon glyphicon-trash"></i>
							<span>Delete</span>
						</button>
						<input type="checkbox" name="delete" value="1" class="toggle">
					{% } else { %}
						<button class="btn btn-warning cancel">
							<i class="glyphicon glyphicon-ban-circle"></i>
							<span>Cancel</span>
						</button>
					{% } %}
				</div>
			</div>
		{% } %}
	</script>
	<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
	<script src="/pluggin/jQueryFileUpload/js/vendor/jquery.ui.widget.js"></script>
	<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
	<script src="/pluggin/jQueryFileUpload/js/load-image.min.js"></script>
	<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
	<script src="/pluggin/jQueryFileUpload/js/jquery.iframe-transport.js"></script>
	<!-- The basic File Upload plugin -->
	<script src="/pluggin/jQueryFileUpload/js/jquery.fileupload.js"></script>
	<!-- The File Upload processing plugin -->
	<script src="/pluggin/jQueryFileUpload/js/jquery.fileupload-process.js"></script>
	<!-- The File Upload image preview & resize plugin -->
	<script src="/pluggin/jQueryFileUpload/js/jquery.fileupload-image.js"></script>
	<!-- The File Upload audio preview plugin -->
	<script src="/pluggin/jQueryFileUpload/js/jquery.fileupload-audio.js"></script>
	<!-- The File Upload video preview plugin -->
	<script src="/pluggin/jQueryFileUpload/js/jquery.fileupload-video.js"></script>
	<!-- The File Upload validation plugin -->
	<script src="/pluggin/jQueryFileUpload/js/jquery.fileupload-validate.js"></script>
	<!-- The File Upload user interface plugin -->
	<script src="/pluggin/jQueryFileUpload/js/jquery.fileupload-ui.js"></script>
	<!-- The main application script -->
	<script src="/pluggin/jQueryFileUpload/js/main.js"></script>
	<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
	<!--[if (gte IE 8)&(lt IE 10)]>
	<script src="js/cors/jquery.xdr-transport.js"></script>
	<![endif]-->

@stop

