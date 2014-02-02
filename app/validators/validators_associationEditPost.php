<?php
class validators_associationEditPost extends BaseValidator
{

    public function create(){
        $rules = array(
            'id'=> 'required|integer',
        );
        return $this->test($rules);
    }
    public function title(){
        $rules = array(
            'title' => 'required|min:3|max:150',
            'id'=> 'required|integer',
			'id_news'=> 'required|integer',
			'order'=> 'required|integer',
        );
        $toPurify = array('title');
        return $this->test($rules,$toPurify);
    }
    public function textarea(){
        $rules = array(
            'textarea' => 'required|min:1|max:1500',
            'id'=> 'required|integer',
			'id_news'=> 'required|integer',
			'order'=> 'required|integer',
        );
        $toPurify = array('textarea');
        return $this->test($rules,$toPurify);
    }
}
