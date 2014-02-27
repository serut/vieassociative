@if(App::environment() == "production")
	{{-- CDN link --}}
	<link rel="stylesheet" type="text/css" href="http://cdn.vieassociative.fr/css/compiled.css" />
@else
	{{-- Direct link --}}
	<link rel="stylesheet" type="text/css" href="/css/compiled.css" />
	{{-- With less
		<link href="/css/less/include.less" rel="stylesheet/less" type="text/css" />
		<script src="/js/vendor/less.min.js" type="text/javascript"></script>
	--}}
@endif