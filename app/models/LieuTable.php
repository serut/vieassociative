<?php
/*
/**
 *On garde ce fichier uniquement pour la requete getLieu.
 *Ce fichier ne compile pas du tout !!!
 *
namespace VieAssoc\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Adapter\Adapter;

class LieuTable extends AbstractTableGateway
{
    protected $table = "lieu";
    protected $adapter;

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->initialize();
    }


    public function getLieu($lng, $lat, $rayon)
    {
        $formule = "(6366*acos(cos(radians($lat))*cos(radians(`latitude`))*cos(radians(`longitude`) -radians($lng))+sin(radians($lat))*sin(radians(`latitude`))))";
        $sql = "SELECT id,$formule AS dist FROM lieu WHERE $formule<= ? ORDER by dist ASC";
        $result = $this->adapter->query($sql)->execute(array($rayon));
        $lengthResult = $result->count();
        $return = array();
        for ($i = 0; $i < $lengthResult; $i++) {
            $return[] = $result->current();
            $result->next();
        }
        return $return;
    }

    public function ajouterLieu($lng, $lat, $adresse_reelle, $ville)
    {
        $ville = str_replace(", France", "", $ville);
        $adresse_reelle = str_replace(", France", "", $adresse_reelle);
        $sql = 'INSERT INTO lieu (libelle,ville,latitude,longitude) VALUES (?,?,?,?)';
        $result = $this->adapter->query($sql)->execute(array($adresse_reelle, $ville, $lat, $lng));
        return $result->getGeneratedValue();
    }
}*/
