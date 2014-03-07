<?php

/**
 * An Eloquent Model: 'News'
 *
 * @property integer $id
 * @property integer $id_assoc
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\Partial[] $partial
 */
class News extends Eloquent
{
    protected $table = 'news';
    public $timestamps = true;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function partial()
    {
        return $this->hasMany('Partial', 'id_news');
    }

    /**
     * @return string
     */
    public function getModificatedDate()
    {
        return $this->update_at;
        //return date("g:i a F j, Y ", strtotime($this->update_at));
    }

    /**
     * @param integer $idNews
     * @return array
     */
    static function get($idNews)
    {
        if (intval($idNews) == 0) {
            return array();
        } else {
            $p = News::where('id', $idNews)->get();
            return Partial::get($p);
        }
    }

    /**
     * Needs a real association !
     */
    static function add($id_assoc,$id_wall_news)
    {
        $association = Association::findOrFail($id_assoc);
        $association->nb_publications++;
        $association->touch();
        $news = new News();
        $news->id_wall_news = $id_wall_news;
        $news->touch();
        return $news->id;
    }

    /**
     * @param $id_assoc
     * @return array
     */
    static function listNews($id_wall_news)
    {
        $news = News::where('id_wall_news', $id_wall_news)->orderBy('id', 'DESC')->get();
        return Partial::getNews($news);
    }

    /**
     * @param $id_assoc
     * @return int
     */
    static function countNews($id_assoc)
    {
        return News::where('id_assoc', $id_assoc)->count();
    }
}