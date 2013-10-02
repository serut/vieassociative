<?php
class validators_discussion extends BaseValidator
{
	private function test($rules){
        $inputs = Input::get();

        $v = Validator::make($inputs, $rules);
        if(! $v->fails()){
            $message = array('success'=>'true','data'=>$inputs);
        }else{
            $message = array('error'=>'');
        }
        return $message;
    }
    public function add(){
        $rules = array(
            'text' => 'required|max:3000',
            'id_answer' => 'integer',
        );
        return $this->test($rules);
    }
}
