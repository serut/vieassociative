<?php

/**
 * Class validators_associationEditPost
 */
class validators_associationEditPost extends BaseValidator
{

    /**
     * @return array
     */
    public function create()
    {
        $rules = array(
            'id' => 'required|integer',
            'id_wall_news' => 'required|integer',
        );
        return $this->test($rules);
    }

    /**
     * @return array
     */
    public function title()
    {
        $rules = array(
            'title' => 'required|min:3|max:150',
            'id' => 'required|integer',
            'id_news' => 'required|integer',
            'order' => 'required|integer',
        );
        $toPurify = array('title');
        return $this->test($rules, $toPurify);
    }

    /**
     * @return array
     */
    public function textarea()
    {
        $rules = array(
            'textarea' => 'required|min:1|max:5000',
            'id' => 'required|integer',
            'id_news' => 'required|integer',
            'order' => 'required|integer',
        );
        $toPurify = array('textarea');
        return $this->test($rules, $toPurify);
    }

    /**
     * @return array
     */
    public function onepicture()
    {
        $rules = array(
            'onepicture' => 'required|url',
            'id' => 'required|integer',
            'id_news' => 'required|integer',
            'order' => 'required|integer',
        );
        return $this->test($rules);
    }

    /**
     * @return array
     */
    public function youtube()
    {
        $rules = array(
            'youtube' => 'required|min:8|max:12',
            'id' => 'required|integer',
            'id_news' => 'required|integer',
            'order' => 'required|integer',
        );
        return $this->test($rules);
    }
}
