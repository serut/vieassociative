@if(App::environment() == "prod")
	{{-- CDN link --}}
	<link href="/css/less/include.less" rel="stylesheet/less" type="text/css" />
	<script src="http://cdn.vieassociative.fr/js/vendor/less.min.js" type="text/javascript"></script>
@else
	{{-- Direct link --}}
	<link href="/css/less/include.less" rel="stylesheet/less" type="text/css" />
	<script src="/js/vendor/less.min.js" type="text/javascript"></script>
@endif