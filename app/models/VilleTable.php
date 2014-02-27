<?php
namespace VieAssoc\Model;

use Zend\Db\Sql\Sql,
    Zend\Db\Sql\Where,
    Zend\Db\Sql\Expression,
    Zend\Db\Sql\Predicate,
    Zend\Db\TableGateway\AbstractTableGateway,
    Zend\Db\Adapter\Adapter,
    Zend\Db\ResultSet\ResultSet;

class VilleTable  extends AbstractTableGateway
{
    protected $table='ville';
    protected $adapter;
    protected $sql;
    protected $resultSet;

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
        $this->sql = new Sql($this->adapter);
        $this->resultSet = new ResultSet();
        $this->initialize();
    }
    
    
    public function getVille($idVille){
        $sql = 'SELECT precision_annexe,nom,vue,longitude,latitude FROM ville WHERE id = ?';
        $result = $this->adapter->query($sql)->execute(array($idVille));
        $e = $result->current();
        
        // Mise en forme du nom de la ville
        $nom_de_la_ville = '';
        $nom_de_la_ville .= (!empty($e['precision_annexe'])) ? $e['precision_annexe'] .', ' : '';
        $nom_de_la_ville .= $e['nom'];
        $e['nom'] = $nom_de_la_ville;
        return $e;
    }
    
    
    
    public function getVilleByString($nom){
        $nom = htmlspecialchars(strtolower($nom.'%')); // The % for the like things
        $sql = 'SELECT id,precision_annexe,nom,code_postal, latitude, longitude
            FROM ville
            WHERE LCASE(nom) LIKE ?
               OR LCASE(precision_annexe) LIKE ? ';
        $param = array($nom,$nom);
        if (preg_match('#^.*? .*?$#is',$nom)){ // si y'a un espace
                $sql .= 'OR LCASE(?) LIKE ? OR LCASE(precision_annexe) LIKE ? ';
                $newName = str_replace(' ','-',$nom);
                $param[] = $newName;
                $param[] = $newName;
        }
        $sql .= 'ORDER BY vue desc LIMIT 0,10';
        $statement = $this->adapter->query($sql);
        $result = $statement->execute($param);
        
        
        $return = array();
        $lengthResult = $result->count();
        for($i=0; $i<$lengthResult; $i++){
            $e = $result->current();
            $label =  (!empty($e['precision_annexe'])) ? $e['precision_annexe'] .', ' : '';
            $label.=  $e['nom'] . ', ';
            $label.= (strlen($e['code_postal']) == 4 ) ? '0'.$e['code_postal'] : $e['code_postal'];
            $return[] = array('label'=>$label, 'id'=>$e['id'],'latitude'=>$e['latitude'], 'longitude'=>$e['longitude']);
            $result->next();
        }
        return $return;
    }
    
    public function addUneDemandeQuery($idVille){
        $update = $this->sql->update('ville')->set(array('vue'=>'vue+1'))->where(array('id'=>$idVille));
        $updateString = $this->sql->prepareStatementForSqlObject($update);
        $updateString->execute();
    }
    
    public function listeVille($idVille, $distance){
        $sql = 'SELECT longitude,latitude FROM ville WHERE id = ?';
        $result = $this->adapter->query($sql)->execute(array($idVille));
        
        $lengthResult = $result->count();
        if($lengthResult > 0){ // La ville "source" existe t'elle ?
            $e = $result->current();
            $latitude = $e['latitude'];
            $longitude = $e['longitude'];
            $formule="(6366*acos(cos(radians($latitude))*cos(radians(`latitude`))*cos(radians(`longitude`) -radians($longitude))+sin(radians($latitude))*sin(radians(`latitude`))))";
            $sql = "SELECT id,$formule AS dist FROM ville WHERE $formule<= ? ORDER by dist ASC";
            $result = $this->adapter->query($sql)->execute(array($distance));
            $lengthResult = $result->count();
            $return = array();
            for($i=0; $i<$lengthResult; $i++){
                $return[] = $result->current();
                $result->next();
            }
        }else{
            $return = array('1');
        }
        return $return;
    }
    
}
