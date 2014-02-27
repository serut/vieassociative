<?php

class EvenementController extends BaseController
{
    /**
     *    TODO : this is not functionnal
     */
    public function getEvenementAssociation($idAssoc)
    {
        return View::make('evenement.evenement-association');
    }

    /**
     *    TODO : this is not functionnal
     */
    public function getEdit($idAssoc, $idEve)
    {
        return View::make('evenement.edit');
    }

}