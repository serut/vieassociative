@if(App::environment() == "production")
	{{-- CDN link --}}
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
	<script src="http://cdn.vieassociative.fr/js/vendor/bootstrap.min.js"></script>
	<script src="http://cdn.vieassociative.fr/js/vendor/fancybox.min.js"></script>
	<script src="http://cdn.vieassociative.fr/js/vendor/bootstrap-wysiwyg.js"></script>
	<script src="http://cdn.vieassociative.fr/js/main.js"></script>
	<script type="text/javascript">
	   var _gaq=[['_setAccount','UA-35348467-1'],['_trackPageview']];
	   (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
	   g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	   s.parentNode.insertBefore(g,s)}(document,'script'));
   </script>
	<script src="http://cdn.vieassociative.fr/js/vendor/images-loaded.min.js" async></script>
	<script src="http://cdn.vieassociative.fr/js/vendor/parsley.min.js" async></script>
	<script src="http://cdn.vieassociative.fr/js/vendor/tmpl.min.js" async></script>
	<script src="http://cdn.vieassociative.fr/js/vendor/masonry.min.js" async></script>
	<script src="http://cdn.vieassociative.fr/pluggin/bootstrap-datepicker/bootstrap-datepicker.js" async></script>
	<script src="http://cdn.vieassociative.fr/js/vendor/jquery.hotkeys.js"></script>
	<script src="http://cdn.vieassociative.fr/js/vendor/toastr.min.js"></script>
@else
	{{-- Direct link --}}
	<script src="/js/vendor/jquery-1.9.1.min.js"></script>
	<script src="/js/vendor/bootstrap.min.js"></script>
	<script src="/js/vendor/fancybox.min.js"></script>
	<script src="/js/vendor/bootstrap-wysiwyg.js"></script>
	<script src="/js/main.js"></script>
	<script src="/js/vendor/images-loaded.min.js"></script>
	<script src="/js/vendor/parsley.min.js"></script>
	<script src="/js/vendor/tmpl.min.js"></script>
	<script src="/js/vendor/masonry.min.js"></script>
	<script src="/pluggin/bootstrap-datepicker/bootstrap-datepicker.js"></script>
	<script src="/js/vendor/jquery.hotkeys.js"></script>
	<script src="/js/vendor/toastr.min.js"></script>
@endif


@yield('footer-js')