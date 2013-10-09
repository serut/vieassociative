<?php
class Proposition  extends Eloquent
{
    static function add($data){
        $proposition = new elo_Proposition();
        $proposition->finished = 0;
        $proposition->title = $data['message']['title'];
        $data['message']['id_user'] = Auth::user()->id;
        //look if a conversation like this one exist
        $p = elo_Proposition::where('id_assoc',$data['id_assoc'])->where('type_query',$data['type'])->first();
        if(empty($p)){
            $d = new elo_Discussion();
            $d->touch();
            //create the first post of this conversation
            $data['message']['id_discussion'] = $d->id;
            $proposition->id_discussion = $d->id;
            
            
        }else{
            $data['message']['id_discussion'] = $p->id_discussion;
            $proposition->id_discussion = $p->id_discussion;
        }
        Answer::addFirstMessageNewProposition($data['message']);
        $proposition->id_assoc = $data['id_assoc'];
        //store the query
        $proposition->type_query = $data['type'];
        $proposition->data = json_encode($data['update']);
        $proposition->where = json_encode($data['where']);
        $proposition->touch();
        
    }

    static function getPropositions($id_assoc){
        return elo_Proposition::where('id_assoc',$id_assoc)
                                ->orderBy('updated_at', 'DESC')->get();
    }
}