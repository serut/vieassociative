<?php

class EvenementController extends BaseController {
    public function getEvenementAssociation($idAssoc){
        return View::make('evenement.evenement-association');
    }

    public function getEdit($idAssoc,$idEve){
        return View::make('evenement.edit');
    }

}