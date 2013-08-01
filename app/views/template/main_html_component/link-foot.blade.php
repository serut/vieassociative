@if(App::environment() == "prod")
	{{-- CDN link --}}
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
	<script src="http://cdn.vieassociative.fr/js/vendor/bootstrap.min.js"></script>
	<script src="http://cdn.vieassociative.fr/js/vendor/fancybox.min.js"></script>
	<script src="http://cdn.vieassociative.fr/js/main.js"></script>
	<script src="http://cdn.vieassociative.fr/js/vendor/images-loaded.min.js" async="true"></script>
	<script src="http://cdn.vieassociative.fr/js/vendor/parsley.min.js" async="true"></script>
	<script src="http://cdn.vieassociative.fr/js/vendor/tmpl.min.js" async="true"></script>
	<script src="http://cdn.vieassociative.fr/js/vendor/masonry.min.js" async="true"></script>
@else
	{{-- Direct link --}}
	<script src="/js/vendor/jquery-1.9.1.min.js"></script>
	<script src="/js/vendor/bootstrap.min.js"></script>
	<script src="/js/vendor/fancybox.min.js"></script>
	<script src="/js/main.js"></script>
	<script src="/js/vendor/images-loaded.min.js" async="true"></script>
	<script src="/js/vendor/parsley.min.js" async="true"></script>
	<script src="/js/vendor/tmpl.min.js" async="true"></script>
	<script src="/js/vendor/masonry.min.js" async="true"></script>
@endif


@yield('footer-js')