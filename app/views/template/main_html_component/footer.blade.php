<div id="push"></div>
<footer>
    <div class="container">
        <div id="footer" class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 hidden-xs">
                <col-lg-><a href="{{URLSubdomain::to('www','/')}}">Accueil</a></col-lg->
                <col-lg-><a href="http://doc.vieassociative.fr/">Developpeurs</a></col-lg->
                @if (Auth::check())
                    <col-lg-><a href="#"></a></col-lg->
                @else
                    <col-lg-><a href="{{URLSubdomain::to('www','/user/log')}}">Connexion / inscription</a></col-lg->
                @endif
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 align-right">
                <col-lg- class="social_icons">
                    {{--<col-lg- class="rss"><a title="rss" href="#"></a></col-lg->--}}
                    <col-lg- class="googleplus"><a title="Google +" href="https://plus.google.com/u/0/b/111279553320723865802/111279553320723865802"></a></col-lg->
                    <col-lg- class="twitter"><a title="Twitter" href="https://twitter.com/VieAssociative"></a></col-lg->
                    <col-lg- class="facebook"><a title="Facebook" href="https://www.facebook.com/vieassociativeofficiel"></a></col-lg->
                </col-lg->
                <a href="{{URLSubdomain::to('www','/info/condition')}}" title="Généré en {{round(microtime(true) - TIME_AT_START,3)}} s">&copy; Vie Associative 2013 - 2014</a>
            </div>
        </div>
    </div>
</footer>
