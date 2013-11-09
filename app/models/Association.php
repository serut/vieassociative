<?php
class Association  extends Eloquent
{
    static function add($assoc){
        $a = new elo_Association;
        $a->name = $assoc['name'];
        $a->slug = Str::slug($assoc['name'],'-');
        $a->touch();
        return $a->id;
    }
    static function getRangUser($id_user, $id_assoc){
        $l = elo_UserAssociation::where('id_user',$id_user)->where('id_assoc',$id_assoc)->firstOrFail();
        return empty($l) ? $l->link : '';
    }
    
    static function getName($id_assoc){
        $a = elo_Association::findOrFail($id_assoc);
        return $a->name;
    }
    static function get($id_assoc){
        $a = elo_Association::findOrFail($id_assoc);
        return $a;
    }
    static function countAdmin($idAssoc){
        return elo_UserAssociation::where('id_assoc',$idAssoc)->count();
    }

    static function getAssociations($idUser){
        $sql = 'SELECT id_assoc as id,link FROM user_association WHERE user_association.id_user = ?';
        $result = DB::select($sql, array($idUser));
        return $result;
    }
    static function getLogo($idAssoc){
        $sql = 'SELECT image.libelle FROM association,image WHERE association.id_logo = image.id AND association.id = ?';
        $result = DB::select($sql, array($idAssoc));
        return $result;
    }
    
    static function changerLogo($idLogo,$idAssoc){
        $sql = 'UPDATE association SET id_logo= ? WHERE id = ?';
        $result = DB::update($sql, array($idLogo, $idAssoc));
        return $result;
    }
    
    static function changerLien($idAssoc, $lien, $idUser){
        $sql = 'UPDATE user_association SET nom_lien = ? WHERE id_user = ? AND id_assoc = ?';
        $result = DB::update($sql, array($lien, $idUser, $idAssoc));
        return $result;
    }
    static function existeNomAssociation($nom){
        $sql = 'SELECT id FROM association WHERE nom= ?';
        $result = DB::select($sql, array($nom));
        $next = $result->current();
        return !empty($next);
    }
    static function getMesAssociations($idUser){
        $sql = 'SELECT association.nom, association.id
                FROM user_association,association
                WHERE user_association.id_assoc = association.id 
                AND association.active = 1
                AND user_association.id_user = ?';
        $result = DB::select($sql, array($idUser));
        return $result;
    }
    
}