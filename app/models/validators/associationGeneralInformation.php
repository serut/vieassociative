<?php
class validators_associationGeneralInformation extends BaseValidator
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
            'name' => 'required|min:2|max:80',
        );
        return $this->test($inputsRequired,$rules);
	}
    public function legal_name(){
        $inputsRequired = array('legal_name');
        $rules = array(
            'legal_name' => 'required|min:2|max:80',
        );
        return $this->test($inputsRequired,$rules);
    }
    public function acronym(){
        $inputsRequired = array('acronym');
        $rules = array(
            'acronym' => 'required|min:2|max:80',
        );
        return $this->test($inputsRequired,$rules);
    }
    public function goal(){
        $inputsRequired = array('goal');
        $rules = array(
            'goal' => 'required|min:2|max:80',
        );
        return $this->test($inputsRequired,$rules);
    }
    public function official_date_creation(){
        $inputsRequired = array('official_date_creation');
        $rules = array(
            'official_date_creation' => 'required|min:2|max:80',
        );
        return $this->test($inputsRequired,$rules);
    }
    public function website_url(){
        $inputsRequired = array('website_url');
        $rules = array(
            'website_url' => 'required|min:2|max:80',
        );
        return $this->test($inputsRequired,$rules);
    }
    public function headquater(){
        $inputsRequired = array('headquater');
        $rules = array(
            'headquater' => 'required|min:2|max:80',
        );
        return $this->test($inputsRequired,$rules);
    }
    public function admitted_public_utility(){
        $inputsRequired = array('admitted_public_utility');
        $rules = array(
            'admitted_public_utility' => 'required|min:2|max:80',
        );
        return $this->test($inputsRequired,$rules);
    }
}