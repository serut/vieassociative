<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

    protected $table = 'user';
    protected $hidden = array('password');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    static function connexion($id){
        $infoProfil = User::getInfoProfils($id);
        Session::put('idUser', $id);
        Session::put('display_name', $infoProfil->display_name);
        Session::put('level', $infoProfil->level);
        Session::put('myassocs', Association::getAssociations($id));
        $token = sha1(mt_rand(0, 0x7fffffff ) ^ crc32("okw6XAw25BOX8EY") ^ crc32(microtime()));
        User::creerToken($id,$token);
        if(App::environment() == 'local')
            $domain = "vieassoc.lo";
        else
            $domain = "vieassociative.fr";
        setcookie('vieasso_remember', '', strtotime( '+30 days' ), '/',$domain);
    }
    static function addAssoc($id_user,$id_assoc,$link){
        $el = new elo_UserAssociation;
        $el->id_user = $id_user;
        $el->id_assoc = $id_assoc;
        $el->link = $link;
        $el->touch();
    }

    static function getInfoProfils($id){
        $sql = 'SELECT level,display_name from user where id = ?';
        $result = DB::select($sql, array($id));
        return $result[0];
    }
    
    static function isTakenUsername($username){
        $count = User::where('username', '=', $username)->count();
        return $count  != 0;

    }
    
    static function isTakenMail($email){
        $count = User::where('email', '=', $email)->count();
        return $count  != 0;
    }
    
    
    
    

    static function modifierLienAssoc($idUser,$idInsertAssoc,$lien){
        $sql = 'UPDATE user_association SET nom_lien=? WHERE id_user = ? AND id_assoc = ?';
        $result = DB::update($sql, array($lien,$idUser,$idInsertAssoc));
        return $result;
    }
    
    static function creerToken($id_user,$token){
        $el = new elo_UserToken;
        $el->id_user = $id_user;
        $el->token = $token;
        $el->date_fin = date('Y-m-d h:m:s', strtotime('+3 week'));
        $el->save();
    }
    static function reconnecterDepuisToken($token){
        $el = elo_UserToken::where('token', '=', $token)->where('date_fin', '>', date('Y-m-d h:m:s', time()))->first();
        if(!$el){
            return 0;
        }
        return $el->id_user;
    }
}
