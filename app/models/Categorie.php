<?php
class Categorie  extends Eloquent
{
    public function getSousCategorie($id){
        $sql = "SELECT * from type_sous_evenement WHERE id_type_evenement = ?";
        $result = DB::select($sql, array($id));
        return $result;
    }
    public function ajouterSousCategorie($propositionSousCategorie, $categorie){
        $sql = 'INSERT INTO type_sous_evenement (id_type_evenement,libelle) VALUES (?,?)';
        $result = DB::select($sql, array($categorie,$propositionSousCategorie));
        return $result->getGeneratedValue();
    }
}