<?php
class validators_associationAdd extends BaseValidator
{
    public function add(){
        $rules = array(
            'name' => 'required|min:4|max:50',
            'choice' => 'required|in:true,false',
        );
        $toPurify = array('name');
        return $this->test($rules);
    }
}
