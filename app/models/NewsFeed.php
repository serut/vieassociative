<?php
class NewsFeed extends Eloquent{
    protected $table = 'news';
    protected $primaryKey = 'id';
    public $timestamps = true;
}