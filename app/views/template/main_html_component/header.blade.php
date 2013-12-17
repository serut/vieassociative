<header>
	<div class="container">
		<div class="row">
		    <div class="span10">
				<a id="logo" href="{{URLSubdomain::to('www','')}}">
					<img alt="Vie Associative" src="/img/logo.png">
				</a>
			</div>
	        <nav id="menu" class="span14 align-right">
		        <div class="navbar" style="margin-top: 0px;">
		        	<ul class="nav">
						@if (Auth::check())
	                    <li class="dropdown">
	                    	<a data-toggle="dropdown" class="dropdown-toggle" href="#"><i class="fa fa-bell fa-2x"style="margin-top: -4px;"></i> <b class="caret"></b></a>
	                        <ul class="dropdown-menu">
	                        	<li><a href="#">Notification 1</a></li>
	                            <li><a href="#">Notification 1</a></li>
	                        </ul>
	                	</li>
	                	<!--
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
	                	-->
	                    <li class="dropdown">
	                    	<a data-toggle="dropdown" class="dropdown-toggle" href="#" style="margin-bottom: 5px;">
	                    	<img src="/img/items/user-thumb.jpg" style="margin-left: 0px; width: 28px; height: 28px;margin-top:-5px;margin-right:10px;">
	                    	<span class="hidden-phone"> Serutan  <b class="caret"></b></span>
	                    	</a>
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