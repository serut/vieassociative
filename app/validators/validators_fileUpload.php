<?php

/**
 * Class validators_fileUpload
 */
class validators_fileUpload extends BaseValidator
{
    /**
     * @return array
     */
    public function name()
    {
        $rules = array(
            'name' => 'required|min:4|max:50',
            'choice' => 'required|in:true,false',
        );
        return $this->test($rules);
    }

}
