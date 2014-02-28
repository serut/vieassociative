<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

/**
 * An Eloquent Model: 'User'
 *
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $level
 * @property string $firstname
 * @property string $lastname
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $state
 * @property string $avatar_img
 */
class User extends Eloquent implements UserInterface, RemindableInterface
{

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

    static function isAdministrator($id_assoc)
    {
        return User::isUserAdministrator($id_assoc, Auth::user()->id);
    }

    static function isUserAdministrator($id_assoc, $id_user)
    {
        $is_admin = UserAssociation::where('id_assoc', $id_assoc)->where('id_user', $id_user)->count();
        return $is_admin > 0 ? true : false;
    }

    static function addAssoc($id_user, $id_assoc, $link)
    {
        $association = Association::findOrFail($id_assoc);
        $association->nb_administrator++;
        $association->touch();
        $el = new UserAssociation();
        $el->id_user = $id_user;
        $el->id_assoc = $id_assoc;
        $el->link = $link;
        $el->touch();
    }

    static function connect($id)
    {
        $infoProfil = User::getInfoProfils($id);
        Session::put('name', $infoProfil->username);
        Session::put('myassocs', Association::getListWhereAdmin($id));
        $token = sha1(mt_rand(0, 0x7fffffff) ^ crc32("okw6XAw25BOX8EY") ^ crc32(microtime()));
        User::creerToken($id, $token);
        if (App::environment() == 'local')
            $domain = "vieassoc.lo";
        else
            $domain = "vieassociative.fr";
        setcookie('vieasso_remember', $token, strtotime('+30 days'), '/', $domain);
    }

    static function disconnect()
    {
        Session::put('name', null);
        Session::put('myassocs', array());
    }

    static function creerToken($id_user, $token)
    {
        $el = new UserToken;
        $el->id_user = $id_user;
        $el->token = $token;
        $el->date_fin = date('Y-m-d h:m:s', strtotime('+3 week'));
        $el->save();
    }

    static function reconnecterDepuisToken($token)
    {
        $el = UserToken::where('token', '=', $token)->where('date_fin', '>', date('Y-m-d h:m:s', time()))->first();
        if (!$el) {
            return 0;
        }
        return $el->id_user;
    }

    static function getInfoProfils($id)
    {
        $sql = 'SELECT level,username from user where id = ?';
        $result = DB::select($sql, array($id));
        return $result[0];
    }

    static function isTakenUsername($username)
    {
        $count = User::where('username', $username)->count();
        return $count != 0;

    }

    static function isTakenMail($email)
    {
        $count = User::where('email', $email)->count();
        return $count != 0;
    }

    /*
    static function modifierLienAssoc($idUser,$idInsertAssoc,$lien){
        $sql = 'UPDATE user_association SET nom_lien=? WHERE id_user = ? AND id_assoc = ?';
        $result = DB::update($sql, array($lien,$idUser,$idInsertAssoc));
        return $result;
    }
    */

    public function getAvatar()
    {
        if (empty($this->avatar_img)) {
            return "/img/items/user-thumb.jpg";
        }
        return $this->avatar_img;
    }
}
