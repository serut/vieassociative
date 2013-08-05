<?php
class validators_associationEditPost extends BaseValidator
{
	public function validate(){
        $inputs = Input::get();
        $inputsRequired = array('title','text');
        // Looks if every inputs required are present
        try{
            $arrayElements = $this->need($inputsRequired);
            extract($arrayElements);
        }catch (Exception $e) {
            return $this->getMessageMissingInput();
        }

        $rules = array(
            'title' => 'required|min:4|max:80',
            'text' => 'required|min:5',
        );
        $v = Validator::make($inputs, $rules);
        if(! $v->fails()){
            $message = array('success'=>'true','data'=>$inputs);
        }else{
            $message = array('error'=>'');
        }
        return $message;
	}
}
