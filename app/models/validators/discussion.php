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
            'id_discussion' => 'integer',
        );
        return $this->test($rules);
    }
    public function vote(){
        $rules = array(
            'id_answer' => 'integer',
            'value' => 'between:0,1',
        );
        return $this->test($rules);
    }
    public function validate(){
        $rules = array(
            'id_proposition' => 'integer',
            'value' => 'between:0,1',
        );
        return $this->test($rules);
    }
}
