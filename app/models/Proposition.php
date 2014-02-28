<?php

/**
 * An Eloquent Model: 'Proposition'
 *
 * @property integer $id
 * @property \Carbon\Carbon $deadline
 * @property integer $id_discussion
 * @property integer $id_assoc
 * @property string $type_query
 * @property integer $id_answer
 * @property string $data
 * @property string $where
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Discussion $discussion
 */
class Proposition extends Eloquent
{
    protected $table = 'proposition';
    protected $primaryKey = 'id';
    protected $softDelete = true;
    public $timestamps = true;


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function discussion()
    {
        return $this->belongsTo('Discussion', 'id_discussion');
    }

    /**
     * @param $data
     */
    static function add($data)
    {
        $proposition = new Proposition();
        $data['message']['id_user'] = Auth::user()->id;
        //look if a conversation like this one exist
        $p = Proposition::where('id_assoc', $data['id_assoc'])->where('type_query', $data['type'])->first();
        if (empty($p)) {
            $d = new Discussion();
            $d->title = $data['message']['title'];
            $d->touch();
            //create the first post of this conversation
            $data['message']['id_discussion'] = $d->id;
            $proposition->id_discussion = $d->id;
        } else {
            $data['message']['id_discussion'] = $p->id_discussion;
            $proposition->id_discussion = $p->id_discussion;
        }
        $proposition->id_answer = Answer::addFirstMessageNewProposition($data['message']);
        $proposition->id_assoc = $data['id_assoc'];
        //store the query
        $proposition->type_query = $data['type'];
        $proposition->data = json_encode($data['update']);
        $proposition->where = json_encode($data['where']);
        $proposition->touch();
    }

    /**
     * @param $id_assoc
     * @return array|static[]
     */
    static function getPropositions($id_assoc)
    {
        return Proposition::where('id_assoc', $id_assoc)
            ->with('discussion')
            ->groupBy('id_discussion')
            ->orderBy('updated_at', 'DESC')->get();
    }


    /**
     * @param $id
     */
    static function process($id)
    {
        $p = Proposition::findOrFail($id);
        switch ($p->type_query) {
            case 'name':
            case 'legal_name':
            case '':
            case 'goal':
            case 'official_date_creation':
            case 'website_url':
            case 'headquater':
            case 'internal_regulation':
            case 'statuts':
            case 'contact_adress':
            case 'admitted_public_utility':
                Proposition::processSimpleAssociationUpdate($p);
        }
    }

    /**
     * @param $p
     */
    static function processSimpleAssociationUpdate($p)
    {
        $where = json_decode($p->where, true);
        $data = json_decode($p->data, true);
        Association::where('id', $where['id'])->update($data);
        $p->delete();
        $a = Answer::findOrFail($p->id_answer);
        $a->content .= '<h6 class="text-success">' .
            Lang::get('association/proposition/answer.success') .
            \Carbon\Carbon::createFromTimeStamp(strtotime($p->created_at))->formatLocalized('%A %d %B %Y %H:%I') .
            '</h6>';
        $a->touch();
    }

    /**
     * @param $id
     */
    static function refused($id)
    {
        $p = Proposition::findOrFail($id);
        $p->delete();
        $a = Answer::findOrFail($p->id_answer);
        $a->content .= '<h6 class="text-error">' .
            Lang::get('association/proposition/answer.refused') .
            '</h6>';
        $a->touch();
    }
}