<?php
class validators_associationEditPost extends BaseValidator
{
    public function validate(){
        $rules = array(
            'title' => 'min:3|max:150',
            'text' => 'min:1',
        );
        $toPurify = array('title','text');
        return $this->test($rules);
    }
}
