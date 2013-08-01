<div id="push"></div>
<footer>
    <div class="container">
        <div id="footer" class="row">
            <div class="span14 hidden-phone">
                <span><a href="index.html">Accueil</a></span>
                <span><a href="elements.html">Qui sommes-nous ?</a></span>
                @if (Auth::check())
                    <span><a href="portfolio-4-columns.html">Espace membre</a></span>
                @else
                    <span><a href="portfolio-4-columns.html">Connexion / inscription</a></span>
                @endif
                <span><a href="/contact/contact">Contact</a></span>
            </div>
            <div class="span9 align-right">
                <span class="social_icons">
                    <span class="rss"><a title="rss" href="#"></a></span>
                    <span class="googleplus"><a title="googleplus" href="#"></a></span>
                    <span class="twitter"><a title="twitter" href="https://twitter.com/VieAssociative"></a></span>
                    <span class="facebook"><a title="facebook" href="https://www.facebook.com/vieassociativeofficiel"></a></span>
                </span>
                <a href="legal" title="Généré en {{round(microtime(true) - TIME_AT_START,3)}} s">&copy; Vie Associative 2013</a>
            </div>
        </div>
    </div>
</footer>
