<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
            <title>
                @section('title')
                @show
                 ~ VieAssociative.fr
            </title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Le styles -->
        @section('header-css')
        <link href="{{ asset('/css/bootstrap.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/bootstrap-responsive.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/design.css') }}" rel="stylesheet">
        @show

        <link rel="shortcut icon" href="{{ asset('/img/favicon.png') }}">

        <!-- Scripts -->
        <script src="{{ asset('/js/jquery.min.js') }}"></script>
        <script src="{{ asset('/js/bootstrap.js') }}"></script>
        <script src="{{ asset('/js/jquery-ui-1.8.23.custom.min.js') }}"></script>
        <script src="{{ asset('/js/jquery.placeholder.js') }}"></script>
        <!--[if lt IE 9]>
            <script src="{{ asset('/js/html5.js') }}"></script>
        <![endif]-->
    </head>
    <body>
    <header>
        <div class="container clearfix" id="header">
            <a id="logo" href="/">
                <img alt="Vie Associative" src="/img/logo.png">
            </a>
            <nav id="menu">
                <ul>
                    @if (Auth::check())
                        <li class="dropdown">
                            <a id="dropdown-association" class="dropdown-toggle" data-description="
                            @if(Session::has('associationEnManagementNom') && Session::get('associationEnManagementNom')!= null )
                                Actuellement {{ Session::get('associationEnManagementNom')}}
                            @else
                                Ajouter une association
                            @endif
                            " href="#"><i class="fa fa-user"></i> Gerer mes associations<b class="caret"></b></a>
                            <div id="dropdown-association-toggle" class="dropdown-hide">
                                <div class="dropdown-items">
                                    <div class="dropdown">
                                        <div class="arrow"></div>
                                        <h3 class="dropdown-title">{{ Session::get('associationEnManagementNom')}}</h3>
                                        <div class="dropdown-content">
                                            <div class="dropdown-sub">
                                                <a href="/association/evenement/ajouter">
                                                    <div class="icon"><i class="fa fa-plus"></i></div>
                                                    Gerer ses évènements
                                                </a><br>
                                                <a class="others" href="/association/evenement/ajouter">Ajouter un évènement</a><br>
                                            </div>
                                            <div class="dropdown-sub">
                                                <a href="/image/gestion-image">
                                                    <div class="icon"><i class="fa fa-tasks"></i></div>
                                                    Gestion des fichiers envoyés 
                                                </a><br>
                                                <a class="others">You have <strong>8</strong> pending tasks</a>
                                            </div>
                                            <div class="dropdown-sub">
                                                <a href="/association/profil">
                                                    <div class="icon"><i class="fa fa-tasks"></i></div>
                                                    Gestion du profil
                                                </a><br>
                                                <a class="others">Modifier le profil</a>
                                            </div>
                                            <div class="dropdown-footer dropdown-sub">
                                                <a href="/association/gerer">Ajouter une autre association</a><br>
                                                    <?php $myassocs = Session::get('myassocs') ?>
                                                    @if (!empty( $myassocs))
                                                        Gerer une autre association :
                                                        @foreach ($myassocs as $k => $v)
                                                            <?php /*  TO DO : ne pas afficher le texte du dessus quand on n'a qu'un association */ ?>
                                                            @if($v->id_assoc!=Session::get('associationEnManagement'))
                                                            <a href="/association/gerer-maintenant/{{$v->id_assoc}}">{{$v->nom}}</a>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        
                        <li class="dropdown">
                            <a id="dropdown-user" class="dropdown-toggle" data-description="Bienvenue {{Auth::user()->username}}" href="#"><i class="fa fa-user"></i> Gerer mon profil<b class="caret"></b></a>
                            <div id="dropdown-user-toggle" class="dropdown-hide">
                                <div class="dropdown-items">
                                    <div class="dropdown">
                                        <div class="arrow"></div>
                                        <div class="dropdown-content">
                                            <div class="dropdown-sub">
                                                <a href="/">
                                                    <div class="icon"><i class="fa fa-plus"></i></div>
                                                    Rechercher des évènements
                                                </a><br>
                                                <a class="others">View your profile</a>
                                            </div>
                                            <div class="dropdown-sub">
                                                <a href="/membre/profil">
                                                    <div class="icon"><i class="fa fa-user"></i></div>
                                                    Mon profil
                                                </a><br>
                                                <a class="others">You have <strong>17</strong> new messages</a>
                                            </div>
                                            <div class="dropdown-footer dropdown-sub">
                                                <a href="/membre/deconnexion">Deconnexion</a><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @else
                            <li class="dropdown">
                                <a data-description="Vous n'êtes pas encore connecté" class="dropdown-toggle" href="/membre/connexion"> Connexion</a>
                            </li>
                    @endif
                </ul>
            </nav><!-- end #menu -->
        </div>
    </header>
    @section('before-body')
    @show

    @if(isset($transparent))
    <section id="content" class=" span12">
    @else
    <section id="content" class="well span12">
    @endif
        <div class=" container">
        @yield('content')
        <div class="clear"></div>
    </div>
    </section>
    <section id="push">
    </section>
        
    <div id="footer">
        <footer class="clearfix container">
            <div>
                <div>
                    <ul class="left">
                        <li><a href="index.html">Accueil</a></li>
                        <li><a href="elements.html">Evènement</a></li>
                        <li><a href="blog.html">Association</a></li>
                        @if (Auth::check())
                            <li><a href="portfolio-4-columns.html">Espace membre</a></li>
                        @else
                            <li><a href="portfolio-4-columns.html">Connexion / inscription</a></li>
                        @endif
                        <li><a href="/contact/contact">Contact</a></li>
                    </ul>
                    <ul class="social_icons right">
                        <li class="facebook"><a title="facebook" href="https://www.facebook.com/vieassociativeofficiel"></a></li>
                        <li class="twitter"><a title="twitter" href="https://twitter.com/VieAssociative"></a></li>
                        <li class="googleplus"><a title="googleplus" href="#"></a></li>
                        <li class="rss"><a title="rss" href="#"></a></li>
                    </ul>
                    
                    <ul class="right">
                        <li><a href="#">Généré en {{round(microtime(true) - TIME_AT_START,3)}} s</a></li>
                        <li><a href="#">&copy; Vie Associative 2013</a></li>
                    </ul>
                </div><!-- end .one-fourth.last -->
            </div>
            <div class="right">
            </div>
        </footer>
     </div> 
        @section('footer-js')
        <script src="{{ asset('/js/main.js') }}"></script>
        <script src="{{ asset('/pluggin/prettyPhoto/prettyPhotoLaunch.js') }}"></script>
        <script src="{{ asset('/pluggin/prettyPhoto/jquery.prettyPhoto.js') }}"></script>
        <script src="{{ asset('/pluggin/Flat-ui/jquery.dropkick-1.0.0.js') }}"></script>
        <script src="{{ asset('/pluggin/Flat-ui/jquery.tagsinput.js') }}"></script>
        @show
        
    </body>
</html>
<?php
Form::macro('fullInput', function($id,$options)
{
    $text ='<div class="control-group ';
    if($errors->get($id)){
        $text +="error";
    }
    $text += '">';
    $text +='        <div class="formulaire">';
    foreach ($errors->get($id,'<span class="help-inline">:message</span>') as $message){
        $text +=$message;
    }
    $text += Form::password($id,$options);
    $text +='         </div>';
    $text +='      </div>';
    return $text;
}); 