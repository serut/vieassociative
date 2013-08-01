<?php 
$this->headTitle('Les évènements associatifs dans ta région !');
$this->headlink()->prependStylesheet('/css/index.css');
$this->inlineScript()->prependFile('/js/index.js')->prependFile('/js/twitter-widget.js')->prependFile('/js/social.js');
?>
        <div class="column left span3">
        	<div class="box-small">
		        <h1 class="head">Filtres</h1>
			    <div>
			    	<ul class="nav nav-list well">
	                    <li class="nav-header">Critères</li>
	                    <li <?php if('Tous'==$this->filtreCategorie) { echo 'class="active"';} ?>><a href="<?php echo $this->url_actuelle_categorie?>&categorie=Tous"><i class="icon-inbox"></i> Tous</a></li>
	                    <?php if(!empty($this->menu_categorie)){
	                    foreach($this->menu_categorie as $k => $type) { ?>
	                            <li <?php if($type['id_type_evenement']==$this->filtreCategorie) { echo 'class="active"';} ?>><a href="<?php echo $this->url_actuelle_categorie?>&categorie=<?php echo $type['id_type_evenement']; ?>"><i class="icon-inbox"></i> <?php echo $type['libelle']; ?><span class="badge badge-info nombre-sous-evenement"><?php echo $type['count']; ?></span></a></li>
	                    <?php }} ?>
	                    <li class="divider"></li>
	                    <li class="nav-header">Rayon</li>
	                            <li><?php echo $this->rayon; ?> kms</li>
	                </ul>
		        </div>
		    </div>
		    <div class="box-small facebook_module">
		        <h1 class="head">Facebook</h1>
		        <div class="facebookOuter">
		         <div class="facebookInner">
		          <div data-header="false" data-stream="false" data-show-faces="true" data-border-color="#fff" data-href="http://www.facebook.com/envato" data-height="280" data-width="300" colorscheme="light" class="fb-like-box fb_iframe_widget" fb-xfbml-state="rendered"><span style="height: 280px; width: 300px;"><iframe scrolling="no" id="f2bc320cd660af4" name="f1f8daecb165328" style="border: medium none; overflow: hidden; height: 280px; width: 300px;" class="fb_ltr" src="http://www.facebook.com/plugins/likebox.php?api_key=&amp;locale=en_US&amp;sdk=joey&amp;channel=http%3A%2F%2Fstatic.ak.facebook.com%2Fconnect%2Fxd_arbiter.php%3Fversion%3D19%23cb%3Df5dc7f5c48aaf8%26origin%3Dhttp%253A%252F%252Fchimpstudio.co.uk%252Ffdee0081b0999a%26domain%3Dchimpstudio.co.uk%26relation%3Dparent.parent&amp;height=280&amp;header=false&amp;show_faces=true&amp;stream=false&amp;width=300&amp;href=http%3A%2F%2Fwww.facebook.com%2Fenvato&amp;colorscheme=light&amp;border_color=%23fff&amp;show_border=true"></iframe></span></div>          
		         </div>
		        </div>
		                   
		        <div id="fb-root" class=" fb_reset">
		        	<div style="position: absolute; top: -10000px; height: 0px; width: 0px;">
		        		<div>
		        			<iframe scrolling="no" frameborder="0" name="fb_xdm_frame_http" allowtransparency="true" id="fb_xdm_frame_http" aria-hidden="true" title="Facebook Cross Domain Communication Frame" tab-index="-1" style="border: medium none;" src="http://static.ak.facebook.com/connect/xd_arbiter.php?version=19#channel=fdee0081b0999a&amp;origin=http%3A%2F%2Fchimpstudio.co.uk&amp;channel_path=%2Fwp-demo%2Frockit%2F%3Ffb_xd_fragment%23xd_sig%3Df12bc2d47771144%26"></iframe><iframe scrolling="no" frameborder="0" name="fb_xdm_frame_https" allowtransparency="true" id="fb_xdm_frame_https" aria-hidden="true" title="Facebook Cross Domain Communication Frame" tab-index="-1" style="border: medium none;" src="https://s-static.ak.facebook.com/connect/xd_arbiter.php?version=19#channel=fdee0081b0999a&amp;origin=http%3A%2F%2Fchimpstudio.co.uk&amp;channel_path=%2Fwp-demo%2Frockit%2F%3Ffb_xd_fragment%23xd_sig%3Df12bc2d47771144%26">
		        			</iframe>
		        		</div>
		        	</div>
		            <div style="position: absolute; top: -10000px; height: 0px; width: 0px;">
		            	<div>
		            	</div>
		            </div> 
		     	</div>
		       <script>(function(d, s, id) {
		            var js, fjs = d.getElementsByTagName(s)[0];
		            if (d.getElementById(id)) return;
		            js = d.createElement(s); js.id = id;
		            js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		            fjs.parentNode.insertBefore(js, fjs);
		            }(document, 'script', 'facebook-jssdk'));
		       </script>
		    </div>
		    <div class="box-small">
		        <h1 class="head">Poste ton évènement </h1>
		             
		            
		        <div>
		        <p class="minSubHead justify">Enregistrement ton association  dolor sit amet, consectetur adipiscing elit. Nulla in ligula risus. Nullam aliquet ullamcorper arcu, interdum bibendum orci dictum id. In et velit a nunc fermentum suscipit. Phasellus dui libero, sol !</p>
		        </div>
		    	 <span class="right"><a href="/evenement/ajouter" class="btn-vie-assoc">Ajouter une annonce</a></span>
		    </div>
		    <div class="box-small twitter_module">
		        <h1 class="head">Twitter </h1>
		        
		        <!-- Begin Twitter Feed Area  -->
		           <div class="twitterfeed">
		               <div class="head-twitter">
		                   <div class="right">
		                       <a href="https://twitter.com/VieAssociative" class="twitter-follow-button" data-show-count="false" data-lang="fr">Suivre @VieAssociative</a>
		                   </div>
		                </div>
		               <div id="tweet"></div>
		           </div>
		         <!-- End Twitter Feed Area  -->
		    </div>
		</div>
            <div class="column right span9">
                <ul class="nav nav-pills choix-date-evenement">
                        <li><span>La période : </span></li>
                        <li <?php if(' '==$this->filtreTemporel) { echo 'class="active"';} ?>><a href="<?php echo $this->url_actuelle_temporel?>&temps=+">Prochainement</a></li>
                        <li <?php if('-'==$this->filtreTemporel) { echo 'class="active"';} ?>><a href="<?php echo $this->url_actuelle_temporel?>&temps=-">Dépassé</a></li>
                        <li <?php if('n'==$this->filtreTemporel) { echo 'class="active"';} ?>><a href="<?php echo $this->url_actuelle_temporel?>&temps=n">Les deux</a></li>
                </ul>
            <?php if(!empty($this->liste_des_resultats)){ ?>
                        <?php 
                        foreach($this->liste_des_resultats as $k => $evenement) { ?>
                        
                        		<ul class="timeline">
                                    <li>
                                        <div class="date">
                                            <span>&nbsp;</span>
                                            <h6 class="colr">12JUN 2012</h6>
                                        </div>
                                        <div class="desc">
                                            <div class="desc-in">
                                                <span class="pointer">&nbsp;</span>
                                                <?php if(! empty($evenement['id_photo'])){?> 
                                                		<div class="thumb">
		                                                    <a href="blog-detail.html"><img alt="" src="<?php echo $evenement['url_affiche']; ?>"></a>
	                                                </div>
			                                <?php } ?>
                                                
                                                <div class="txt">
                                                            <h5><a href="<?php echo $evenement['url_evenement']; ?>"><?php echo $evenement['titre']; ?></a></h5>
                                                    <p>
                                                        <?php echo $evenement['texte']; ?>
                                                    </p>
                                                </div>
                                                <div class="gig-opts">
                                                    <h6 class="time"><?php echo $evenement['jours_concernes']; ?></h6>
                                                    <span><a href="<?php echo $evenement['url_evenement']; ?>">VOIR</a></span>
                                                    <span class="location" href=""><?php echo $evenement['nom_de_la_ville'] ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                    <?php 
                        } ?>

                <?php } else{ ?>
                    <p>Aucun résultat ne correspond à votre recherche.</p>
                <?php } ?>
                    <div class="span3 offset6 lien-bottom">
                         <a href="/evenement/ajouter"><i class="icon-plus"></i>Ajouter votre annonce</a>
                    </div>
                 </div>
