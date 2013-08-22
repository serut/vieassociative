<?php
use Illuminate\Auth\UserInterface;
class Evenement
{
    static function getDSQFDSF(){
        $offset_result = mysql_query( " SELECT FLOOR(RAND() * COUNT(*)) AS `offset` FROM `table` ");
        $offset_row = mysql_fetch_object( $offset_result ); 
        $offset = $offset_row->offset;
        $result = mysql_query( " SELECT * FROM `table` LIMIT $offset, 1 " );
    }
    static function listeEvenementsDUneAssoc($idAssoc){
        $sql = 'SELECT evenement.id,id_assoc, titre,evenement.id_type_sous_evenement,type_repetition,id_photo,evenement.id_type_evenement, lieu.ville as nom_de_la_ville,date_format(date_deb,"%w") as jourEcrit, date_format(date_deb,"%d") as jour, date_format(date_deb,"%Y") as an,date_format(date_deb,"%c") as mois, texte, type_evenement.libelle as libelle_evenement,type_sous_evenement.libelle as libelle_sous_evenement 
            FROM lieu, type_evenement,type_sous_evenement,evenement 
            WHERE lieu.id=evenement.id_lieu AND type_evenement.id = evenement.id_type_evenement AND type_sous_evenement.id = evenement.id_type_sous_evenement AND evenement.id_assoc= ?  AND actif = 1 ORDER BY date_deb ASC';
        $result = DB::select($sql, array($idAssoc));
        return $result;
    }
    
    static function changerLogo($idPhoto,$idEve,$idAssoc){
        $update = 'UPDATE evenement SET id_photo= ? WHERE id= ? AND id_assoc = ?';
        $result = DB::update($sql, array($idPhoto,$idEve,$idAssoc));
        return $result;
    }
    
    static function rechercherEvenements($liste_lieu, $idFiltreTypeEvenement, $filtreTemporel){
        if(empty($liste_lieu)){
            return array();
        }
        //Generation de la requete de résultat
        $sql = 'SELECT evenement.id,
                evenement.id_assoc,
                titre,
                evenement.id_type_sous_evenement,
                type_repetition,id_photo,
                image.libelle,evenement.id_type_evenement,
                lieu.libelle as nom_de_la_ville,
                date_format(date_deb,"%w") as jourEcrit, 
                date_format(date_deb,"%d") as jour,
                date_format(date_deb,"%c") as mois, 
                texte, 
                type_evenement.libelle as libelle_evenement,
                type_sous_evenement.libelle as libelle_sous_evenement 
            FROM lieu, type_evenement,type_sous_evenement,evenement LEFT JOIN image ON evenement.id_photo = image.id 
            WHERE lieu.id=evenement.id_lieu 
            AND type_evenement.id = evenement.id_type_evenement 
            AND type_sous_evenement.id = evenement.id_type_sous_evenement 
            AND actif = 1
            AND evenement.id_lieu in ';
        $first = true; 
        foreach ($liste_lieu as  $k => $v ) {
            if($first)// Question de syntaxe
                $sql .="( ".$v['id'];
            else
                $sql .=",".$v['id'];
            $first = false;
        }
        $sql .=" )";

        //Gestion des filtres
        if(intval($idFiltreTypeEvenement)){
            $sql .= " AND evenement.id_type_evenement = ".$idFiltreTypeEvenement;
        }
        switch($filtreTemporel){
            case ' ' :
                $sql .= " AND (date_deb >= NOW() OR (type_repetition!=0 AND date_fin+999991 >= NOW()))"; // Le nombre permets de mettre la date en fin de jounrée
                $sql .=" ORDER BY date_deb ASC";
                break;
            case '-' :
                $sql .= " AND ((type_repetition=0 AND date_deb <= NOW()) OR (type_repetition!=0 AND date_fin < NOW()))";
            default :
                $sql .=" ORDER BY id DESC";
        }
        $result = DB::select($sql, array());
        $return = array();
        $lengthResult = $result->count();
        for($i=0; $i<$lengthResult; $i++){
            $e = $result->current();
            //Recupere les jours pour les évènements récurrents
            $idEvs = array();
            if($e['type_repetition'] != 0){
                $e['jours_repetition'] = $this->getJourDEvenementRecurrent($e['id']);
            }
            $return[] = $e;
            $result->next();
        }
        return $return;
    }
    
    static function getEvenement($idEvenement){
        $sql = 'SELECT evenement.id_assoc as id_assoc,
                    url as urlAffiche,
                    id_membre,
                    id_photo,
                    type_repetition,
                    lieu,
                    titre,
                    name,
                    association.nom as nomAssoc,
                    id_logo,
                    ville.nom as nom_de_la_ville,
                    date_format(date_fin,"%w") as jourEcrit,
                    date_format(date_fin,"%d") as jour,
                    date_format(date_fin,"%c") as mois,
                    date_format(date_ajout,"%d") as date_create_jour,
                    date_format(date_ajout,"%m") as date_create_mois,
                    date_format(date_ajout,"%Y") as date_create_an,
                    date_format(date_fin,"%c") as mois,
                    texte,
                    type_evenement.libelle as libelle_evenement,
                    type_sous_evenement.libelle as libelle_sous_evenement 
                FROM ville, type_evenement,type_sous_evenement,user,association,evenement LEFT JOIN image ON evenement.id_photo = image.id  
                WHERE association.id = evenement.id_assoc 
                AND user.user_id = evenement.id_membre 
                AND ville.id=evenement.ville 
                AND type_evenement.id = evenement.id_type_evenement 
                AND type_sous_evenement.id = evenement.id_type_sous_evenement 
                AND actif=1 
                AND evenement.id = '.$idEvenement;
        $result = DB::select($sql, array());
        $e = $result->current();

        //Recupere les jours pour les évènements récurrents
        $idEvs = array();
        if($e['type_repetition'] != 0){
            $e['jours_repetition'] = $this->getJourDEvenementRecurrent($idEvenement);
        }
        return $e;
    }
    
    static function getJourDEvenementRecurrent($idEv){
        $sql = 'SELECT * FROM evenement_repete_jour where id_evenement = ? ORDER BY id_jour';
        $result = DB::select($sql, array($idEv));
        $return = array();
        $lengthResult = $result->count();
        for($i=0; $i<$lengthResult; $i++){
            $return[] = $result->current();
            $result->next();
        }
        return $return;
    }
    
    static function getLibelleTypeEvenement($listeIdTypeEvenement){
        if(empty($listeIdTypeEvenement)){
            return array();
        }
        $listeId = "";
        $type_deja_vue = array();
        foreach($listeIdTypeEvenement as $k => $v){
            if(!in_array($v,$type_deja_vue)){
                $type_deja_vue[] = $v;
                $listeId .= $v .',';
            }
        }
        $listeId = trim($listeId,',');

        $sql = 'SELECT count(id_type_evenement) as count, id_type_evenement, type_evenement.libelle 
            FROM type_evenement,evenement 
            WHERE evenement.id_type_evenement = type_evenement.id AND  evenement.id_type_evenement in ('.$listeId.') 
                GROUP BY id_type_evenement 
                ORDER BY libelle asc';
        $result = DB::select($sql);
        $return = array();
        $lengthResult = $result->count();
        for($i=0; $i<$lengthResult; $i++){
            $return[] = $result->current();
            
            $result->next();
        }
        
        return $return;
    }
    
    static function getListeTypeEvenement(){
        $sql = 'SELECT * FROM type_evenement ORDER BY libelle asc';
        $result = DB::select($sql);
        $options = array();
        foreach($result as $type) {
            $options[$type->id]=$type->libelle;
        }
        return $options;
    }
    static function getSousCategorie($idCategorie){
        $sql = 'SELECT id, libelle FROM type_sous_evenement WHERE id_type_evenement = ?';
        $result = DB::select($sql,array($idCategorie));
        $return = array();
        $lengthResult = $result->count();
        for($i=0; $i<$lengthResult; $i++){
            $return[] = $result->current();
            $result->next();
        }
        return $return;
    }
    static function ajouterEvenement($data, $sousCategorie, $type_repetition,$idAssoc, $idUser, $idLieu){
        $sql = 'INSERT INTO evenement 
            (id_assoc,id_membre,type_repetition,actif,titre,id_lieu,date_deb
            ,date_fin,date_ajout,texte,id_type_evenement,id_type_sous_evenement,ip) VALUES
            (?,?,?,1,?,?,?,?,?,?,?,?,?)';
        $result = DB::select($sql,array($idAssoc,$idUser,$type_repetition,$data['nomEv'],$idLieu,$data['ddd'],$data['ddf'],date("Y-m-d H:i:s"),$data['text'],$data['cate'],$sousCategorie,IP));
        return intval($result->getGeneratedValue());
    }			
}