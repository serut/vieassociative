<?php
class validators_associationEditPost extends BaseValidator
{
    public function validate(){
        $rules = array(
            'title' => 'required|min:3|max:150',
            'text' => 'required|min:5',
        );
        $toPurify = array('title','text');
        return $this->test($rules);
    }
}
