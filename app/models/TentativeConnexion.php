<?php

class TentativeConnexion extends Eloquent
{
    protected $table = 'connexion_tentative';
    protected $primaryKey = 'ip';
    public $timestamps = true;


    static function add($ip)
    {
        $test = new TentativeConnexion;
        $test->ip = $ip;
        $test->touch();
    }

    static function get($ip)
    {
        $sql = "SELECT count(*) AS nombre FROM connexion_tentative WHERE ip = ? AND created_at BETWEEN ? AND ? ";
        $result = DB::select($sql, array((String)$ip, date("Y-m-d H:i:s", time() - 600), date("Y-m-d H:i:s", time())));
        return $result[0]->nombre;
    }

    static function deleteOldEntries()
    {
        $sql = "DELETE FROM connexion_tentative WHERE created_at < ? ";
        $result = DB::insert($sql, array(time() - 600));
        return $result;
    }
}
