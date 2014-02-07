<header>
	<nav class="navbar container" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
				<span class="sr-only">Toggle navigation</span>
				<i class="fa fa-bars fa-lg"></i>
			</button>
			<a id="logo" href="{{URLSubdomain::to('www','')}}">
				<img alt="Vie Associative" src="/img/logo.png" class="navbar-brand hidden-xs hidden-sm">
				<img alt="Vie Associative" src="/img/logo-small.png" class="navbar-brand visible-xs visible-sm">
			</a>

			<div class="search-form-phone visible-xs col-xs-8 col-xs-push-1">
				<form action="{{URLSubdomain::to('association','/')}}" method="get" role="search">
					<div class="input-group">
						<input type="text" class="form-control" name="q" placeholder="Rechercher une association">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit">Go!</button>
						</span>
					</div>
				</form>
			</div>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="menu">
			<ul class="nav navbar-nav">
				<li class="menu-item-imaged" data-rel="tooltip" data-toggle="tooltip" data-placement="bottom" title="Signalez nous un problème !">
					<a href="#" onclick="modalUserProposition();return false;">
						<i class="fa fa-bullhorn fa-2x"></i>
					</a>
				</li>
			</ul>
			<div class="search-form col-lg-5 col-lg-push-1 col-md-4 col-md-push-1 col-sm-6 col-sm-push-1 col-xs-10 col-xs-push-1">
				<form class="navbar-form" action="{{URLSubdomain::to('association','/')}}" method="get" role="search">
					<div class="input-group">
						<input type="text" class="form-control" name="q" placeholder="Rechercher une association">
						<span class="input-group-btn">
							<button class="btn btn-default" type="submit">Go!</button>
						</span>
					</div>
				</form>
			</div>
			<ul class="nav navbar-nav navbar-right">
				@if (Auth::check())
				<li class="dropdown menu-item-imaged-with-text">
					<img src="{{Auth::user()->getAvatar()}}" class="img-user">
					<a href="#" class="dropdown-toggle menu-user" data-toggle="dropdown">
						<span class="hidden-sm"> {{Auth::user()->username}} <i class="caret"></i></span>
						
					</a>
					<ul class="dropdown-menu">
						<!--<li><a href="{{URLSubdomain::to('www','/user/'.Auth::user()->id.'/edit')}}">Options</a></li>-->
						<li><a href="{{URLSubdomain::to('www','/user/logout')}}">Deconnexion</a></li>
					</ul>
				</li>
				@if(App::environment() != "production")
				<li class="menu-item-imaged dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<i class="fa fa-bell-o fa-2x"></i>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#">Notification 1</a></li>
						<li><a href="#">Notification 1</a></li>
						<li><a href="#">Notification 1</a></li>
						<li class="divider"></li>
						<li><a href="#">Notification 1</a></li>
						<li class="divider"></li>
						<li><a href="#">Notification 1</a></li>
					</ul>
				</li>
				@endif
				@else
				<li class="menu-item-imaged-with-text">
				<span>
					<i class="fa fa-user fa-2x"></i>
					<a href="{{URLSubdomain::to('www','/user/log')}}"><span>Connexion</span></a>
					</span>
				</li>
				@endif
			</ul>
		</div><!-- /.navbar-collapse -->
	</nav>
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