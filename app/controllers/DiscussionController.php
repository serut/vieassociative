<?php

class DiscussionController  extends BaseController {

    public function getConversation($idAssoc, $idDiscu) {
    	$discussion = Answer::getAnswerAndProposition($idDiscu);
        return View::make('discussion.proposition')
            ->with('posts',$discussion)
            ->with('discussion',elo_Discussion::find($idDiscu))
            ->with('association',elo_Association::find($idAssoc));
    }

    public function postAdd(){
		$v = new validators_discussion;
		$result = $v->add();
        if(isset($result['success'])){
        	$e = new elo_Answer();
        	$e->id_user = Auth::user()->id;
        	$e->content = $result['data']['text'];
        	$e->id_discussion = $result['data']['id_discussion'];
        	if($result['data']['id_answer'] > 0){
        		$parent = elo_Answer::findOrFail(intval($result['data']['id_answer']));
        		$e->level = $parent->level +1;
				$e->id_answer = $result['data']['id_answer'];
        	}else{
        		$e->id_answer = null;
        		$e->level = 1;
        	}
        	$e->touch();
			$result['refresh'] = true;
			$result['data']=null; //Remove data
		}
		return Response::json($result);
    }
    

    public function postVote(){
		$v = new validators_discussion;
		$result = $v->vote();
        if(isset($result['success'])){
        	$voteExistant = elo_Vote::where('id_answer',intval($result['data']['id_answer']))
        			->where('id_user',Auth::user()->id)->first();
        	if(empty($voteExistant)){
        		$e = new elo_Vote();
        		$e->id_user = Auth::user()->id;
        		$e->id_answer = $result['data']['id_answer'];
        		$e->value = $result['data']['value'];
        		$e->touch();
    			$answer = elo_Answer::find(intval($e->id_answer));
        		if($e->value){
        			$answer->vote++;
        		}else{
        			$answer->vote--;
        		}
    			$answer->touch();
        	}else{
        		if($voteExistant->value==$result['data']['value']){
        			//Remove the vote
    				$answer = elo_Answer::find($voteExistant->id_answer);
	        		if(intval($result['data']['value'])){
	        			$answer->vote--;
	        		}else{
	        			$answer->vote++;
	        		}
	    			$answer->touch();
        			$voteExistant->delete();
        		}else{
        			//Add the oposite vote
        			$voteExistant->value=$result['data']['value'];
        			$voteExistant->touch();
    				$answer = elo_Answer::find($voteExistant->id_answer);
	        		if($result['data']['value']){
	        			$answer->vote+=2;
	        		}else{
	        			$answer->vote-=2;
	        		}
	    			$answer->touch();
        		}
        	}
			$result['vote_value'] = $answer->vote;
			$result['data']=null; //Remove data
		}
		
		return Response::json($result);
    }



    public function postValidate(){
        $v = new validators_discussion;
        $result = $v->validate();
        if(isset($result['success'])){
            Proposition::process($result['data']['id_proposition']);
            $result['data']=null; //Remove data
        }
        
        return Response::json($result);
    }
}