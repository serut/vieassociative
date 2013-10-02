<?php

class DiscussionController  extends BaseController {

    public function getIndex() {
    	$discussion = Answer::getAnswers(1);
        return View::make('discussion.index')
            ->with('posts',$discussion);
    }

    public function postAdd(){
		$v = new validators_discussion;
		$result = $v->add();
        if(isset($result['success'])){
        	$e = new elo_Answer();
        	$e->id_user = Auth::user()->id;
        	$e->content = $result['data']['text'];
        	$e->id_answer = null;
        	if($result['data']['id_answer'] > 0){
				$e->id_answer = $result['data']['id_answer'];
        	}
        	$e->touch();
			$result['redirect_url'] = '/discussion';
			$result['data']=null; //Remove data
		}
		return Response::json($result);
    }
    

}