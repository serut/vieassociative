<div id="push"></div>
<footer>
    <div class="container">
        <div id="footer" class="row">
            <div class="span14 hidden-phone">
                <span><a href="{{URLSubdomain::to('www','/')}}">Accueil</a></span>
                <span><a href="http://doc.vieassociative.fr/">Developpeurs</a></span>
                @if (Auth::check())
                    <span><a href="{{URLSubdomain::to('www','/user/1')}}">Espace membre</a></span>
                @else
                    <span><a href="{{URLSubdomain::to('www','/user/log')}}">Connexion / inscription</a></span>
                @endif
            </div>
            <div class="span9 align-right">
                <span class="social_icons">
                    <span class="rss"><a title="rss" href="#"></a></span>
                    <span class="googleplus"><a title="googleplus" href="https://plus.google.com/u/0/b/111279553320723865802/111279553320723865802"></a></span>
                    <span class="twitter"><a title="twitter" href="https://twitter.com/VieAssociative"></a></span>
                    <span class="facebook"><a title="facebook" href="https://www.facebook.com/vieassociativeofficiel"></a></span>
                </span>
                <a href="legal" title="Généré en {{round(microtime(true) - TIME_AT_START,3)}} s">&copy; Vie Associative 2013</a>
            </div>
        </div>
    </div>
</footer>
