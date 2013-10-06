<?php
class Proposition  extends Eloquent
{
    static function add($type,$data,$where,$dataMessage){
        $proposition = new eloProposition();
        $proposition->finished = 0;

        //create a conversation
        $d = new eloDiscussion();
        $d->touch();
        //create the first post of this conversation
        Answer::addFirstMessageNewProposition($d->id,$type,$dataMessage);
        $proposition->id_discussion = $d->id;


        //store the query
        $proposition->type_query = $type;
        $proposition->data = JSON::encodeCommeTuVeux($data);
        $proposition->where = JSON::encodeCommeTuVeux($where);
        $proposition->touch();
    }
}