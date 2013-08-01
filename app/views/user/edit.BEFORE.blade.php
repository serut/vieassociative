<?php
$this->headTitle('Liste des Pages');
$this->headlink()->prependStylesheet('/css/portfolio.css')->prependStylesheet('/pluggin/prettyPhoto/prettyPhoto.css');;
$form = $this->form;
echo $this->form()->openTag($form);
?>
<div class="container">
    <section>
        <div class="row features">
            <div class="span9">
                <h5>Modifier mon profil</h5>
                <div class="form-horizontal">

                    <div class="control-group">
                        <label class="control-label">Nom de l </label>
                        <div class="control-label span4">
                            <label > <?php echo $this->associationEnGestationNom; ?></label>
                        </div>
                    </div>


                    <div class="control-group">
                        <label class="control-label" for="inputPassword">Logo  
                                <br><a href="/image/gestion-image?change=logo"> <i class="icon-arrow-right"></i> Changer de logo</a>
                        </label>
                            <div class="span2">   
                            
                            <?php
                             if (!empty($this->logo)) { ?>
                                <ul id="applications" class="thumbnails portfolio-thumbnails">
                                    <div class="portfolio">
                                    <li data-id="id-<?php echo$v['id']; ?>" class="portfolio-item" data-type="util">
                                        <div class="image-wrapper">
                                            <img src="<?php echo '/images/195x180/' . $this->logo['libelle']; ?>">
                                            <div> 
                                                <a href="<?php echo '/images/original/' . $this->logo['libelle']; ?>" class="first" data-rel="prettyPhoto[gallerie]"><span><i class="icon-zoom-in"></i>Agrandir</span></a><br>
                                        </div>
                                        </div>
                                        <div class="bottom-block">
                                            <p><?php echo $this->logo['libelle']; ?></p>
                                        </div>
                                    </li>
                                    </div>
                                </ul>
                            
                            <?php } else {
                                echo '<div class="control-label span4"> Vous n\'avez pas encore de logo lié à votre association.</div>';
                            } ?>
                                </div>
                    </div>


                    <div class="control-group">
                        <label class="control-label">Votre lien avec l'association
                            <br><a href="/association/changer-lien-association"> <i class="icon-arrow-right"></i> Changer ce lien </a>
                        </label>
                        <div class="control-label span4">
                            <label > <?php echo $this->rang['nom_lien'] ?></label>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label">Ajouter un administrateur à votre association</label>
                        <div class="controls">
                            <div class="formulaire">
                                <input>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div> 
<hr>