<header>
	<div class="container">
		<div class="row">
		    <div class="span10 offset1">
				<a id="logo" href="{{URLSubdomain::to('www','')}}">
					<img alt="Vie Associative" src="/img/logo.png">
				</a>
			</div>
	        <nav id="menu" class="span13 align-right hidden-phone ">
		        <div class="navbar">
		        	<ul class="nav">
						@if (Auth::check())
	                    <li class="dropdown">
	                    	<a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="fa fa-warning"></i> <b class="caret"></b></a>
	                        <ul class="dropdown-menu">
	                        	<li><a href="#">Notification 1</a></li>
	                            <li><a href="#">Notification 1</a></li>
	                        </ul>
	                	</li>
	                    <li class="dropdown">
	                    	<a data-toggle="dropdown" class="dropdown-toggle" href="#">Pages <b class="caret"></b></a>
	                        <ul class="dropdown-menu">
	                            <li><a href="about.html">About us</a></li>
	                            <li><a href="services.html">Services</a></li>
	                            <li><a href="pricing.html">Pricing</a></li>
	                            <li><a href="timeline.html">Timeline</a></li>
	                            <li><a href="sign-in.html">Sign in</a></li>
	                            <li><a href="sign-up.html">Sign up</a></li>
	                            <li><a href="breadcrumb.html">Page with breadcrumb</a></li>
	                            <li><a href="faq.html">FAQ</a></li>
	                            <li><a href="404.html">Error 404</a></li>
	                        </ul>
	                	</li>
	                    <li class="dropdown">
	                    	<img src="/img/items/user-thumb.jpg" style="margin-left: 0px; width: 45px; margin-top:-5px;margin-right:10px;"> <a data-toggle="dropdown" class="dropdown-toggle" href="#">Serutan  <b class="caret"></b></a>
	                        <ul class="dropdown-menu">
	                            <li><a href="#">Options</a></li>
	                            <li><a href="#">Profils</a></li>
	                            <li><a href="{{URLSubdomain::to('www','/user/logout')}}">Deconnexion</a></li>
	                        </ul>
	                	</li>

			            @else
	                	<li>
							<a href="{{URLSubdomain::to('www','/user/log')}}">Connexion - Inscription </a>
			            </li>
		            	@endif
								
	                </ul>
                </div>
	        	<div>
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