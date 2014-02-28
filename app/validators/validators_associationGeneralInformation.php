<?php

/**
 * Class validators_associationGeneralInformation
 */
class validators_associationGeneralInformation extends BaseValidator
{
    /**
     * @return array
     */
    public function name()
    {
        $rules = array(
            'name' => 'required|min:2|max:80',
        );
        return $this->test($rules);
    }

    /**
     * @return array
     */
    public function legal_name()
    {
        $rules = array(
            'legal_name' => 'required|min:2|max:80',
        );
        return $this->test($rules);
    }

    /**
     * @return array
     */
    public function acronym()
    {
        $rules = array(
            'acronym' => 'required|min:2|max:80',
        );
        return $this->test($rules);
    }

    /**
     * @return array
     */
    public function goal()
    {
        $rules = array(
            'goal' => 'required|min:2|max:80',
        );
        return $this->test($rules);
    }

    /**
     * @return array
     */
    public function official_date_creation()
    {
        $rules = array(
            'official_date_creation' => 'required|min:2|max:80',
        );
        return $this->test($rules);
    }

    /**
     * @return array
     */
    public function website_url()
    {
        $rules = array(
            'website_url' => 'required|min:2|max:80',
        );
        return $this->test($rules);
    }

    /**
     * @return array
     */
    public function headquarter()
    {
        $rules = array(
            'headquarter' => 'required|min:2|max:80',
        );
        return $this->test($rules);
    }

    /**
     * @return array
     */
    public function admitted_public_utility()
    {
        $rules = array(
            'admitted_public_utility' => 'required|min:2|max:80',
        );
        return $this->test($rules);
    }

    /**
     * @return array
     */
    public function internal_regulation()
    {
        $rules = array(
            'internal_regulation' => 'required',
        );
        return $this->test($rules);
    }

    /**
     * @return array
     */
    public function statuts()
    {
        $rules = array(
            'statuts' => 'required',
        );
        return $this->test($rules);
    }

    /**
     * @return array
     */
    public function contact_adress()
    {
        $rules = array(
            'contact_adress' => 'required',
        );
        return $this->test($rules);
    }
}