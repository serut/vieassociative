<?php
use Illuminate\Auth\UserInterface;
class Image
{
    static function ajouterVue($nomImage){
        $sql = 'UPDATE image SET vue = vue+1 WHERE libelle = ?';
        $result = DB::update($sql, array($nomImage));
        return $result;
    }
    static function desactiverImage($idImage,$idAssoc){
        $sql = 'UPDATE image SET active=0 WHERE id = ? and id_assoc = ?';
        $result = DB::update($sql, array($idImage,$idAssoc));
        return $result;
    }
    static function isImageToujoursActive($nom_image){
        $sql = 'SELECT active FROM image WHERE libelle = ?';
        $result = DB::select($sql, array($nom_image));
        $return = $result->current();
        return !empty($return) && $return['active'] == 1;
    }
    static function mesImages($idAssoc){
        $sql = 'SELECT id,libelle,locale FROM image WHERE image.id_assoc= ? AND active=1 ORDER BY date desc';
        $result = DB::select($sql, array($idAssoc));
        return $result;
    }
    static function ajouterImage($idUser,$idAssoc,$nom,$ip){
        $sql = 'INSERT INTO image (id_user,id_assoc, libelle, locale,active,date, ip) VALUES (?,?,?,1,1,?,?)';
        $result = DB::insert($sql, array($idUser,$idAssoc,$nom,date("Y-m-d H:i:s"),$ip));
        return $result;
    }

                
    
    
}
