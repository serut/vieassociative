<?php
class validators_fileUpload extends BaseValidator
{
	private function test($inputsRequired,$rules){
        $inputs = Input::get();
        // Looks if every inputs required are present
        try{
            $arrayElements = $this->need($inputsRequired);
            extract($arrayElements);
        }catch (Exception $e) {
            return $this->getMessageMissingInput();
        }

        $v = Validator::make($inputs, $rules);
        if(! $v->fails()){
            $message = array('success'=>'true','data'=>$inputs);
        }else{
            $message = array('error'=>'');
        }
        return $message;
    }


    public function name(){
        $inputsRequired = array('name');
        $rules = array(
            'name' => 'required|min:4|max:50',
            'choice' => 'required|in:true,false',
        );
        return $this->test($inputsRequired,$rules);
    }

}
