<header>
	<div role="navigation" class="navbar">
		<div class="container">
			<div class="navbar-header col-lg-3 col-md-3 col-sm-1">
				<button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
					<span class="sr-only">Toggle navigation</span>
					<i class="fa fa-bars fa-lg"></i>
				</button>
				<a id="logo" href="{{URLSubdomain::to('www','')}}">
					<img alt="Vie Associative" src="/img/logo.png" class="hidden-xs hidden-sm">
					<img alt="Vie Associative" src="/img/logo-small.png" class="visible-xs visible-sm">
				</a>
			</div>
				 
			<div class="collapse navbar-collapse">
				
				<ul class="nav navbar-nav navbar-right text-center col-lg-3 col-md-4 col-sm-5">
					<li class="navbar-right col-lg-4 col-lg-push-0 col-md-4 col-md-push-0 col-sm-4 col-sm-push-0 col-xs-6">
						<a href="#" onclick="modalUserProposition();return false;"><i class="fa fa-bullhorn fa-2x"></i></a>
					</li>
					@if (Auth::check())
					<li class="dropdown navbar-right col-lg-8 col-lg-push-1 col-md-8 col-md-push-2 col-sm-8 col-sm-push-1 col-xs-6">
						<img src="{{Auth::user()->getAvatar()}}" class="img-user">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
							<span class="hidden-sm"> {{Auth::user()->username}} <b class="caret"></b></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="{{URLSubdomain::to('www','/user/'.Auth::user()->id.'/edit')}}">Options</a></li>
							<li><a href="{{URLSubdomain::to('www','/user/logout')}}">Deconnexion</a></li>
						</ul>
					</li>
					@else
					<li class="navbar-right col-lg-8 col-lg-push-1 col-md-8 col-md-push-2 col-sm-4 col-sm-push-0 col-xs-6">
						<a href="{{URLSubdomain::to('www','/user/log')}}"><i class="fa fa-user fa-2x"></i><span>Connexion</span></a>
					</li>
					@endif
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>
</header>

<noscript>
	<div class="container">
		<div class="row">
			<section class="col-sm-8 col-sm-push-2 ">
				<div>
					Notre site est incapable de bien fonctionner sans JavaScript. Merci de le réactiver ! 
				</div>
			</section>
		</div>
	</div>
</noscript>