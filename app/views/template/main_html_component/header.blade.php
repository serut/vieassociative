<header>
	<div class="container">
		<div class="row">
		    <div class="span10">
				<a id="logo" href="{{URLSubdomain::to('www','')}}">
					<img alt="Vie Associative" src="/img/logo.png">
				</a>
			</div>
	        <nav id="menu" class="span14 align-right ">
	        	<div>
					<?php // <a href="#" class="button button-orange hidden-tablet">Découvrez le projet Vie Associative</a> ?>
					@if (Auth::check())
						<a href="{{URLSubdomain::to('www','/user/logout')}}" class="button button-blue">Deconnexion</a>
		            @else
						<a href="{{URLSubdomain::to('www','/user/log')}}" class="button button-blue">Connexion - Inscription </a>
		            @endif
				</div>
			</nav>
		</div>
	</div>
</header>

<noscript>
	<div class="container">
		<section class="span24">
			<p>
				Notre site est incapable de bien fonctionner sans JavaScript. Merci de le réactiver ! 
			</p>
		</section>
	</div>
</noscript>