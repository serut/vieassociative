<?php

/**
 * Class validators_associationAdd
 */
class validators_associationAdd extends BaseValidator
{
    /**
     * @return array
     */
    public function add()
    {
        $rules = array(
            'name' => 'required|min:4|max:120',
            'choice' => 'required|in:true,false',
            'link' => 'min:2|max:50',
        );
        $toPurify = array('name');
        return $this->test($rules,$toPurify);
    }
}
