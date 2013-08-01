<?php
class elo_ConnexionTentative  extends Eloquent
{
    protected $table = 'connexion_tentative';
    protected $primaryKey = 'ip';
   	public $timestamps = true;
}