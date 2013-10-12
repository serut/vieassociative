<?php
class Proposition  extends Eloquent
{
    static function add($data){
        $proposition = new elo_Proposition();
        $proposition->finished = 0;
        $data['message']['id_user'] = Auth::user()->id;
        //look if a conversation like this one exist
        $p = elo_Proposition::where('id_assoc',$data['id_assoc'])->where('type_query',$data['type'])->first();
        if(empty($p)){
            $d = new elo_Discussion();
            $d->title = $data['message']['title'];
            $d->touch();
            //create the first post of this conversation
            $data['message']['id_discussion'] = $d->id;
            $proposition->id_discussion = $d->id;
        }else{
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

    static function getPropositions($id_assoc){
        return elo_Proposition::where('id_assoc',$id_assoc)
                                ->with('discussion')
                                ->groupBy('id_discussion')
                                ->orderBy('updated_at', 'DESC')->get();
    }


    static function process($id){
        $p = elo_Proposition::findOrFail($id);
        switch($p->type_query){
            case 'name':
            case 'legal_name':
            case 'acronym':
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

    static function processSimpleAssociationUpdate($p){
        $where = json_decode($p->where,true);
        $data = json_decode($p->data,true); 
        elo_Association::where('id',$where['id'])->update($data);
        $p->delete();
        $a = elo_Answer::findOrFail($p->id_answer);
        $a->content .= '<h6 class="text-success">'.
                       Lang::get('association/proposition/answer.success').
                       \Carbon\Carbon::createFromTimeStamp(strtotime($p->created_at))->formatLocalized('%A %d %B %Y %H:%I').
                       '</h6>'; 
        $a->touch();
    }

    static function refused($id){
        $p = elo_Proposition::findOrFail($id);
        $p->delete();
        $a = elo_Answer::findOrFail($p->id_answer);
        $a->content .= '<h6 class="text-error">'.
                       Lang::get('association/proposition/answer.refused').
                       '</h6>'; 
        $a->touch();
    }
}