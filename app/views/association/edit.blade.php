@extends('template.theme')


@set_true $main_and_aside 
@section('main-content')
    <section>
        <div>
            <ul class="breadcrumb">
              <li><a href="#">Association</a> <span class="divider">/</span></li>
              <li><a href="/1-qsdf">Faites de la musique</a> <span class="divider">/</span></li>
              <li class="active">Edition</li>
            </ul>
            <h3 class="head">{{Lang::get('association/edit.edit_association')}}</h3>
            <p>{{Lang::get('association/edit.warn_possiblity_for_normal_user')}}</p>
            <p>
            <span class="badge badge-warning">40</span> <span>Modification en attente :</span>
            <span class="pull-right">
              <a href=""><i class="icon-share-alt"></i></a> -
              <a href="#" onclick="$('#wait-moderation').toggle();"><i class="icon-eye-close"></i></a> -
              <a href="#"><i class="icon-refresh"></i></a>

            </span>
            </p>
            <div class="row" id="wait-moderation">
                <div id="list-modification" class="span14 content">
                    @for($i=0; $i<40;$i++)
                    <div class="item itemtwitter">
                        <div class="text">
                            <span>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</span>
                            <div class="tweetbtn">
                            <img width="13" height="13" alt="Favorite" src="/img/to sprite/retweet_mini.png">
                            <a href="http://twitter.com/intent/retweet?tweet_id=319926146185711616">Valider</a>
                            <img width="12" height="12" alt="Favorite" src="/img/to sprite/reply_mini.png">
                            <a href="http://twitter.com/intent/tweet?in_reply_to=319926146185711616">Refuser</a>
                            <img width="12" height="12" alt="Favorite" src="/img/to sprite/favorite_mini.png">
                            <a href="http://twitter.com/intent/favorite?tweet_id=319926146185711616">Ignorer</a>
                            <i>il y a 7 heures</i>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
            <hr>
            <table class="table table-striped">
              <tbody>
                <tr>
                  <td>Information générale de l'association</td>
                  <td>80% completé</td>
                  <td><a href="edit/general-informations"> Editer</a></td>
                </tr>
                <tr>
                  <td>La page Vie Associative</td>
                  <td>40% completé</td>
                  <td><a href="edit/vieassociative-informations"> Editer</a></td>
                </tr>
                <tr>
                  <td>Les publications</td>
                  <td>{{$count_news}} publications</td>
                  <td><a href="edit/news"> Editer</a></td>
                </tr>
                <tr>
                  <td>Les photos</td>
                  <td>16 images</td>
                  <td><a href="edit/picture"> Editer</a></td>
                </tr>
                <tr>
                  <td>Les évenements</td>
                  <td>2 évènements</td>
                  <td><a href="edit/evenement"> Editer</a></td>
                </tr>
                <tr>
                  <td>Les réseaux sociaux</td>
                  <td>0 réseaux sociaux liés</td>
                  <td><a href="edit/social"> Editer</a></td>
                </tr>
                <tr>
                  <td>Administrateurs</td>
                  <td>0 administrateurs</td>
                  <td><a href="edit/administrator"> Editer</a></td>
                </tr>
                <tr>
                  <td>Historique</td>
                  <td>200 élements</td>
                  <td><a href="history"> Afficher</a></td>
                </tr>

              </tbody>
            </table>

            </div>
        </div>
    </section>
@stop
@section('footer-js')
<script src="/js/vendor/jquery.mousewheel.min.js" async="true"></script>
<script type="text/javascript">
    /*List modifications PART START*/
    $.ajax({
        url: '/js/vendor/jquery.mCustomScrollbar.min.js',
        dataType: 'script',
        cache: true,
        success: function() {
            $("#list-modification").mCustomScrollbar({
                theme:"dark",
                scrollButtons:{
                    enable:true
                }
            });
        }
    });
    /*List modifications PART END*/
    
    </script>
@stop
