<?php 
$this->headTitle('Les évènements associatifs dans ta région !');
$this->headlink()->prependStylesheet('/css/index.css');
$this->inlineScript()->prependFile('/js/index.js')->prependFile('/js/twitter-widget.js')->prependFile('/js/social.js');
?>
    <div class="container">
        <section class="blog full">
            <div class="row">
                <div class="col-lg-4">
                    <article>
                        <h3 class="post-title"><?php echo $resultat['titre']; ?></h3>
                        <p><?php
                        echo $resultat['jours_concernes'];
                        ?></p>
                        <div class="row">
                            <div class="col-lg-1">
                                <?php if (!empty($resultat['id_photo'])) { ?> 
                                    <a href="#" class="thumbnail"><img src="<?php echo $resultat['urlAffiche']; ?>" alt="test"></a>
<?php } ?>
                                <br>
                                <div class="info">
                                    <ul class="nav ">
                                        <li><i class="fa fa-user hidden-tablet"></i><small><i>Posté par : 
                                                    <?php
                                                        echo $resultat['name'];
                                                    ?></i></small></li>
                                        <li><i class="fa fa-time hidden-tablet"></i><small><i>Ajoute :  <?php echo $resultat['date_ajout'] ?></i></small></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="blog-post">
                                    <p>
                    <?php echo $resultat['texte']; ?>
                                </p>
                                </div>
                            </div>
                            <div class="g-plusone" data-size="small" data-annotation="none" data-width="120" data-url="http://www.vieassociative.fr<?php echo $resultats['url_actuelle']; ?>"></div>
                            <div class="fb-like" data-send="false" data-layout="button_count" data-width="50" data-show-faces="false" data-font="tahoma" data-url="http://www.vieassociative.fr<?php echo $resultats['url_actuelle']; ?>"></div>
                            <a href="https://twitter.com/share" class="twitter-share-button" data-size="small" data-width="80" data-lang="en" data-url="http://www.vieassociative.fr<?php echo $resultats['url_actuelle']; ?>">Tweet</a>

                        </div>	<!-- /row -->	
                    </article> 
                </div> <!-- /col-lg-4 -->
                <div class="col-lg-2">
                    <aside class="sidebar">
                        <div class="sidebar-item">
                            <h5>Organisateur : <?php echo $resultat['nomAssoc']; ?></h5>
                            <?php
                            if (!empty($logoDeLAssoc) && $logoDeLAssoc['locale'] == 1) {
                                echo '<img style="width:230px;" src="/imgs/logo/' . $logoDeLAssoc['url'] . '">';
                            }
                            ?>
                        </div><!-- /sidebar-item -->
                        <div class="accordion-group">
                            <div class="accordion-head">
                                <ul class="nav nav-pills nav-stacked" style="margin-bottom: 0px;">
                                    <li><a href="#ville" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle"><i class="fa fa-chevron-right "></i> Lieu : <?php echo $resultat['nom_de_la_ville']; ?></a></li>
                                </ul>
                            </div>
                            <div class="accordion-body collapse in" id="ville">
                                <div class="accordion-inner">

                                    <ul class="nav nav-list ">		
                                        <li class="nav-header">Precisions de l'auteur</li>
                                        <li><?php echo $resultat['lieu']; ?></li>			   						

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php /*
                          <div id="accordion2" class="accordion sidebar-item">
                          <div class="accordion-group">
                          <div class="accordion-head">
                          <a href="#collapseOne" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle">
                          Informations complementaire
                          </a>
                          </div>
                          <div class="accordion-body collapse" id="collapseOne">
                          <div class="accordion-inner">
                          <ul class="nav nav-list ">
                          <li class="nav-header">Nombre de vue</li>
                          <li>124 fois par nos visiteurs</li>
                          <li>
                          <li><a href="#">Son lien avec l'association</a></li>
                          </li>
                          </ul>
                          </div>
                          </div>
                          </div>
                          <div class="accordion-group">
                          <div class="accordion-head">
                          <a href="#collapseTwo" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle">
                          Reporter
                          </a>
                          </div>
                          <div class="accordion-body collapse" id="collapseTwo">
                          <div class="accordion-inner">
                          <ul class="nav nav-list ">
                          <li><a href="">Contenu innaproprié</a></li>
                          <li><a href="">Erreur dans le contenu</a></li>
                          <li><a href="">Faute d'orthographe</a></li>
                          </ul>
                          </div>
                          </div>
                          </div>
                          </div> <!-- /sidebar-item -->
                         */ ?>
                    </aside> <!-- /sidebar -->
                </div> <!-- /col-lg-2 -->
            </div> <!-- /row -->
        </section> <!-- /blog full -->	
    </div>
<hr>
