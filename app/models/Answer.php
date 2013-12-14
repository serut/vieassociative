<?php
class Answer extends Eloquent
{
    protected $table = 'answer';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function author()
    {
        return $this->belongsTo('User','id_user');
    }
    public function proposition()
    {
        return $this->hasOne('Proposition','id_answer');
    }
    static function getAnswer($id_discussion){
        $data = Answer::where('id_discussion',$id_discussion)
                            ->with('author')->orderBy('level', 'DESC')->orderBy('id', 'ASC')->get();
        return Answer::organizeComments($data);
    }
    static function getAnswerAndProposition($id_discussion){
        $data = Answer::where('id_discussion',$id_discussion)
                            ->with('author')->with('proposition')
                            ->orderBy('level', 'DESC')->orderBy('id', 'ASC')->get();
        return Answer::organizeComments($data);
    }
    static function organizeComments($result){
        
        $commentsLevel3 = array();
        $commentsLevel2 = array();
        $comments = array();

        //Classify comments between their level
        foreach ($result as $k => $v) {
            switch ($v->level) {
                case 3:
                    $commentsLevel3[$v->id_answer][] = $v;
                    break;
                case 2:
                    $commentsLevel2[$v->id_answer][$v->id] = $v;
                    if(isset($commentsLevel3[$v->id])){
                        $commentsLevel2[$v->id_answer][$v->id]['child'] = $commentsLevel3[$v->id];
                    }
                    break;
                case 1:
                    $comments[$v->id] = $v;
                    if(isset($commentsLevel2[$v->id])){
                        $comments[$v->id]['child'] = $commentsLevel2[$v->id];
                    }
                    break;
            }
        }


        $return = [];
        // put all comments on an array of 1 dimension, as it will be writen on the HTML
        foreach ($comments as $k => $v) {
            $return[] = $v;
            if(isset($v['child'])){ // If there are 2nd level comments
                foreach ($v['child'] as $k => $v) {
                    $return[] = $v;
                    if(isset($v['child'])){  // If there are 3rd level comments
                        foreach ($v['child'] as $k => $v) {
                            $return[] = $v;
                        }
                    }
                }
            }
        }
        return $return;
    }

    static function addFirstMessageNewProposition($data){
        $a = new Answer();
        $a->id_user = $data['id_user'];
        $a->content = Lang::get('association/proposition/answer.proposition'.$data['type_answer'],   
                                array('explanation'=>$data['explanation'],
                                    'precedent_value'=>$data['before'],
                                    'new_value'=>$data['after'])
                                );
        $a->id_discussion=$data['id_discussion'];
        $a->level=1;
        $a->touch();
        return $a->id;
    }
}