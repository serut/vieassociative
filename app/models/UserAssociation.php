<?php

/**
 * An Eloquent Model: 'UserAssociation'
 *
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_assoc
 * @property string $link
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \User $author
 * @property-read \Association $association
 */
class UserAssociation extends Eloquent
{
    protected $table = 'user_association';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function author()
    {
        return $this->belongsTo('User', 'id_user');
    }

    public function association()
    {
        return $this->belongsTo('Association', 'id_assoc');
    }
}