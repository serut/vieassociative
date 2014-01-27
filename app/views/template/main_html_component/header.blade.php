<header>
	<div role="navigation" class="navbar">
		<div class="container">
			<div class="navbar-header col-lg-3 col-md-3 col-sm-2">
				<button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a id="logo" href="{{URLSubdomain::to('www','')}}">
					<img alt="Vie Associative" src="/img/logo.png" class="hidden-xs hidden-sm">
					<img alt="Vie Associative" src="/img/logo-small.png" class="visible-xs visible-sm">
				</a>
			</div>
				
			<div class="collapse navbar-collapse">
				<div class="nav navbar-nav search-form col-lg-5 col-lg-push-1 col-md-5 col-md-push-1 col-sm-6">
						<form class="navbar-form" action="{{URLSubdomain::to('association','')}}">
							<div class="form-group col-lg-8">
								<input type="text" class="form-control" placeholder="Rechercher une association">
							</div>
							<a href="{{URLSubdomain::to('association','/')}}" class="button button-orange">GO !</a>
						</form>
				</div>
				<ul class="nav navbar-nav navbar-right col-lg-4 col-md-4 col-sm-4">
					@if (Auth::check())
					<li class="dropdown navbar-right">
						<a data-toggle="dropdown" class="dropdown-toggle" href="#">
						<img src="{{Auth::user()->getAvatar()}}" class="img-user">
						<span> {{Auth::user()->username}}  <b class="caret"></b></span>
						</a>
						<ul class="dropdown-menu">
							<li><a href="{{URLSubdomain::to('www','/user/'.Auth::user()->id.'/edit')}}">Options</a></li>
							<li><a href="{{URLSubdomain::to('www','/user/logout')}}">Deconnexion</a></li>
						</ul>
					</li>
					@else
					<li class="navbar-right">
						<a href="{{URLSubdomain::to('www','/user/log')}}">Connexion - Inscription </a>
					</li>
					@endif
					<li class="navbar-right">
						<a href="#" onclick="modalUserProposition();return false;"><i class="fa fa-bullhorn fa-2x"></i></a>
					</li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>
</header>

<noscript>
	<div class="container">
		<div class="row">
			<section class="col-lg-7">
				<div>
					Notre site est incapable de bien fonctionner sans JavaScript. Merci de le réactiver ! 
				</div>
			</section>
		</div>
	</div>
</noscript>