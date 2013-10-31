<?php
class validators_associationAdd extends BaseValidator
{
    public function register(){
        $inputs = Input::get();
        $inputsRequired = array('name','choice');
        // Looks if every inputs required are present
        try{
            $arrayElements = $this->need($inputsRequired);
            extract($arrayElements);
        }catch (Exception $e) {
            return $this->getMessageMissingInput();
        }

        $rules = array(
            'name' => 'required|min:4|max:50',
            'choice' => 'required|in:true,false',
        );
        $v = Validator::make($inputs, $rules);
        if(! $v->fails()){
            $message = array('success'=>'true','data'=>$inputs);
            $purifier = App::make('HTMLPurifier');
            $message['data']['name'] = $purifier->purify($message['data']['name']);
        }else{
            $message = array('error'=>'');
        }
        return $message;
	}
}
