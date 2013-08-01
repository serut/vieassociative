<?php
$this->headTitle('Liste des Pages');
$this->headlink();
$form = $this->form;
?>
<div class="container">
    <section>
        <div class="row features">
            <div class="span9">
                <h5>Ajouter une nouvelle association</h5>
                <?php
                echo $this->form()->openTag($form);
                ?>
                    <div class="control-group">
                        <label class="control-label">Votre lien actuel avec l'association</label>
                        <?php //echo $this->formElementErrors($form->get('lien')); 
                        ?>
                        <div class="control-label span4">
                            <label>{{$this->lienActuel->nom_lien}}</label>
                         </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label">Votre nouveau lien avec l'association</label>
                        <?php //echo $this->formElementErrors($form->get('lien')); 
                        ?>
                        <div class="controls-allbox">
                            <label class="radio noretourligne"><?php echo $this->formRadio($form->get('lien'));?> </label><br>
                         </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">ou bien</label>
                        <div class="controls">
                            <div class="formulaire">
                                <?php
                                    echo $this->formInput($form->get('autreLien'));
                                ?>
                            </div>
                        </div>
                    </div>
                    

                    <div class="form-actions">
                        <button class="btn btn-primary" type="submit">Valider</button>
                        <button class="btn btn-primary">Retour</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div> 
<hr>