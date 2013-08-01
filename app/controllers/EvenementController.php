<?php

class EvenementController extends BaseController {
    public function getEvenementAssociation($idAssoc){
        return View::make('evenement.evenement-association');
    }

    public function getEdit($idAssoc,$idEve){
        return View::make('evenement.edit');
    }

    /*
    public function getChoisirAssociation(){
        return View::make('evenement.choisirAssociation')
            ->with('mesAssocs',Assoc::getMesAssociations(Session::get('idUser')));
    }
    public function postChoisirAssociation(){
        $id_assoc = Input::get('id_assoc',null);
        if($id_assoc!=null){ // He choosed / created an association, now we can add an event !
            $ev = new elo_Evenement;
            $ev->touch();
            return $this->redirect()->to('evenement/ajouter', array('idEv'=>$ev->id));
        }
        return $this->getChoisirAssociation();
    }
    public function getAjouter($idEv=null){
        if($idEv==null){
            return Redirect::to('association/evenement/choisir-association');
        }
        return View::make('evenement.ajouter')
            ->with('typeEvenement',Evenement::getListeTypeEvenement());
    }
    public function postModificationPremierePartie(){
        if(validators_editEvent::validateFirstStep(Input::get())){
            // Pas d'erreur, on ajoute ce que l'utilisateur nous a donné
            $ev = Evenement::modificationPremierePartie($idEv, $nomEv, $text);
            if(! $ev){
                return Response::json(array('status'=>'error','text'=>'L\'évènement n\'est pas modifiable'));
            }
            return Response::json(array('status'=>'success'));
        }
        return Response::json(array('status'=>'error','text'=>'Aucune donnée n\'a été recu'));
    }
    public function postModificationSecondPartie(){
        $idEv = Input::get('idEv',0);
        $nomEv = Input::get('nomEv',null);
        // TO DO categories / small categories
    }
    public function postModificationTroisiemePartie(){
        $idEv = Input::get('idEv',0);
        $nomEv = Input::get('ville',null);
        $nomEv = Input::get('adresse_reelle',null);
        $nomEv = Input::get('idVilleBDD',null);
        $nomEv = Input::get('lat',null);
        $nomEv = Input::get('lng',null);
        // TO DO localisation
    }
    
    public function postModificationQuatriemePartie(){
        $idEv = Input::get('idEv',0);
        $nomEv = Input::get('type',null);
        $nomEv = Input::get('deb',null);
        $nomEv = Input::get('fin',null);
        $nomEv = Input::get('ddd',null);
        $nomEv = Input::get('ddf',null);
        // TO DO localisation
    }
    







    public function postAjouter(){
        switch ($i = $this->gererCategorie($data['cate'],$data['propositionSousCategorie'],$data['sousCategorie'])){
            case -1:
                break;
            default:
                $sousCategorie = $i;
                $type_repetition = $this->gererRepetition($data);
                $idLieu  = Lieu::ajouterLieu($data['lng'],$data['lat'],$data['adresse_reelle'],$data['ville']);
                $ev = Evenement::ajouterEvenement($data, $sousCategorie, $type_repetition,$session->associationEnManagement, $session->idUser, $idLieu);
                if(is_int($ev)){
                    return Redirect::to('association/evenement/evenement-association');
                }
        }
        return View::make('evenement.ajouter')
            ->with('typeEvenement',Evenement::getListeTypeEvenement())
            ->with('errors',$v->messages());
    }
    

    */















    /*     * ***************************************** */
    /* 						 */
    /*     Liste des différents évènements      */
    /* 						 */
    /*     * ***************************************** */
    /* ZEND

    public function listeEvenementAction() {
        $lng = Input::get('lng',0);
        $lat = Input::get('lat',0);
        $rayon = Input::get('rayon',0);
        $filtreCategorie = Input::get('categorie');
        $filtreTemporel = Input::get('temps');

        $session->filtreCategorie = $this->setFiltreCategorie($filtreCategorie, $session->filtreCategorie);
        $session->filtreTemporel = $this->setFiltreTemporel($filtreTemporel, $session->filtreTemporel);

        $liste_lieu = $this->getLieuTable()->getLieu($lng,$lat,$rayon);
        $liste_des_resultats = $this->getEvenementTable()->rechercherEvenements(
                $liste_lieu, $session->filtreCategorie, $session->filtreTemporel
        );
        $liste_des_resultats = $this->listeEvenementData($liste_des_resultats); // Crée les URLs et raccourcis de texte
        $session->menu_categorie = $this->getMenu($filtreCategorie, $session->menu_categorie, $liste_des_resultats);

        
        // URL pour les filtres :
        $url_actuelle = '/evenement/liste-evenement?lng='.$lng.'&lat='.$lat.'&rayon='.$rayon;
        $url_actuelle_temporel = $url_actuelle.'&type_evenement='.$session->filtreCategorie;
        $url_actuelle_categorie = $url_actuelle.'&selection='.$session->filtreTemporel;
        
        //Fin statistique
        return new ViewModel(array(
                    'rayon' => $rayon,
                    'filtreCategorie' => $session->filtreCategorie,
                    'filtreTemporel' => $session->filtreTemporel,
                    "liste_des_resultats" => $liste_des_resultats,
                    "menu_categorie" => $session->menu_categorie,
                    "url_actuelle_temporel"=>$url_actuelle_temporel,
                    "url_actuelle_categorie"=>$url_actuelle_categorie
                ));
    }

    //  Controle de la catégorie des évènements
    private function setFiltreCategorie($categorie, $categorie_session) {
        if (!empty($categorie))
            return $categorie;
        if (empty($categorie_session))
            return 'Tous';
        return $categorie_session;
    }

    //  Controle des filtres : passée, bientot, ou les deux.
    private function setFiltreTemporel($type_evenement, $type_evenement_session) {
        if (!empty($type_evenement)) {
            $selection_active = $type_evenement;
        } else {
            if (empty($type_evenement_session))
                $selection_active = ' ';
            else
                $selection_active = $type_evenement_session;
        }
        return $selection_active;
    }

    //Les catégories du menu de gauche
    private function getMenu($categorie, $categorie_session, $listeEv) {
        if ((!empty($categorie) && $categorie_session != $categorie) || empty($categorie_session)) {
            // Soumission d'un changement de categorie               ou jamais eu de categorie
            // Liste des types d'evenements pour chaque sous menu

            $typeEve = array();
            foreach ($listeEv as $k => $v) {
                $typeEve[] = $v['id_type_evenement'];
            }

            $result = $this->getEvenementTable()->getLibelleTypeEvenement($typeEve);
            return $result;
        } else {
            // Meme menu car aucun changement
            return $categorie_session;
        }
    }

    private function listeEvenementData($liste_des_resultats) {

        for ($i = 0; $i < sizeof($liste_des_resultats); $i++) {

            if ($liste_des_resultats[$i]['type_repetition'] == 0) { // C'est un évènement à date unique, donc on affiche la date
                $liste_des_resultats[$i]['jours_concernes'] = jour::jourFrCourt($liste_des_resultats[$i]['jourEcrit']) . ' ' . $liste_des_resultats[$i]['jour'] . ' ' . jour::moisFr($liste_des_resultats[$i]['mois']);
            } else {

                $jours = array();
                foreach ($liste_des_resultats[$i]['jours_repetition'] as $jours_repetition) {
                    $jours[] = $jours_repetition['id_jour'];
                }
                $liste_des_resultats[$i]['jours_concernes'] = 'tous les ' . implode(' ', $jours) . ', ' . utf8_encode($liste_des_resultats[$i]['nom_de_la_ville']);
            }

            // Raccourcis du texte
            if (strlen($liste_des_resultats[$i]['texte']) > 300) {
                $liste_des_resultats[$i]['texte'] = substr(strip_tags($liste_des_resultats[$i]['texte']), 0, 300) . '...';
            }


            $liste_des_resultats[$i]['url_evenement'] = $this->url()->fromRoute('voir-evenement', array('ville' => url::texteURLee($liste_des_resultats[$i]['nom_de_la_ville']), 'categorie' => url::texteURLee($liste_des_resultats[$i]['libelle_sous_evenement']), 'titre' => url::texteURLee($liste_des_resultats[$i]['titre']), 'id' => url::texteURLee($liste_des_resultats[$i]['id'])));

            if (!empty($evenement['id_photo'])) {
                $liste_des_resultats[$i]['url_affiche'] = '/imgs/affiche/' . $liste_des_resultats[$i]['url'];
            }
        }

        return $liste_des_resultats;
    }

    */

    /*     * ***************************************** */
    /* 		FIN DE LA LISTE 		 */
    /*           des différents évènements      */
    /* 						 */
    /*     * ***************************************** */








    /*     * ***************************************** */
    /* 						 */
    /*               Vue d'un évènement         */
    /* 						 */
    /*     * ***************************************** */

    /* ZEND

    public function voirAction() {
        $idEvenement = $this->params()->fromRoute('id');
        $ville = $this->params()->fromRoute('ville');
        $categorie = $this->params()->fromRoute('categorie');
        $titreDeURL = $this->params()->fromRoute('titre');

        $resultat = $this->getEvenementTable()->getEvenement($idEvenement);
        $resultat = $this->voirData($resultat);
        $resultat['url_actuelle'] = $this->url()->fromRoute('voir-evenement', array('ville' => $ville, 'categorie' => $categorie, 'titre' => $titreDeURL, 'id' => $idEvenement));
        return new ViewModel(array(
                    "resultat" => $resultat,
                ));
    }

    private function voirData($resultat) {
        $resultat['date_ajout'] = $resultat['date_create_jour'] . ' ' . jour::moisFr($resultat['date_create_mois']) . ' ' . $resultat['date_create_an'];
        if (!empty($evenement['id_photo'])) {
            $evenement['url_affiche'] = '/imgs/affiche/' . $evenement['url'];
        }
        if ($resultat['type_repetition'] == 0) { // C'est un évènement à date unique, donc on afiche la date
            $resultat['jours_concernes'] = jour::jourFrCourt($resultat['jourEcrit']) . ' ' . $resultat['jour'] . ' ' . jour::moisFr($resultat['mois']) . ' à ' . $resultat['nom_de_la_ville'];
        } else {
            $jour = array(); // Sinon on recherche dans les évènements récursifs de cette requete quels sont les jours concernés
            foreach ($resultat['jours_repetition'] as $k => $v) {
                $jour[] = jour::jourFrEntier($v['id_jour']);
            }
            $resultat['jours_concernes'] = 'Tous les ' . implode(' ', $jour) . ' à ' . utf8_encode($resultat['nom_de_la_ville']);
        }
        return $resultat;
    }
    
    public function gererCategorie($cate,$propositionSousCategorie,$sousCategorie){
        if(empty($propositionSousCategorie)){
            if(! empty($sousCategorie)){
                return $sousCategorie;
            }
            return -1;
        }else{
            return $this->getCategorieTable()->ajouterSousCategorie($propositionSousCategorie,$cate);
        }
    }
    public function gererRepetition($data){
        
        return -0;
    }
    
    public function getEvenementAssociation(){
        return View::make('evenement.evenement-association')
            ->with('mesEvenements',Evenement::listeEvenementsDUneAssoc(Session::get('associationEnManagement')));
    }
    */
}