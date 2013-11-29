<?php
class validators_associationAdministrator extends BaseValidator
{
    public function add_when_not_admin(){
        if(Input::get('who','true') == 'false'){
            // he adds himself as admin
            $rules = array(
                'link' => 'required|max:30',
            );
        }else{
            // he adds somebody else as admin
            $rules = array(
                'admin_mail' => 'email|exists:user,email',
                'link' => 'required|max:30',
                'who' => 'in:true,false',
            );
        }
        
        return $this->test($rules);
	}
    public function add_when_already_admin(){
        // he adds somebody else as admin
        $rules = array(
            'admin_mail' => 'required|email|exists:user,email',
            'link' => 'required|max:30',
        );
        return $this->test($rules);
    }
    public function remove(){
        // he adds somebody else as admin
        $rules = array(
            'id_user' => 'integer',
        );
        return $this->test($rules);
    }
}