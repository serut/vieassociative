<?php

class validators_associationGeneralInformation extends BaseValidator
{
    public function name()
    {
        $rules = array(
            'name' => 'required|min:2|max:80',
        );
        return $this->test($rules);
    }

    public function legal_name()
    {
        $rules = array(
            'legal_name' => 'required|min:2|max:80',
        );
        return $this->test($rules);
    }

    public function acronym()
    {
        $rules = array(
            'acronym' => 'required|min:2|max:80',
        );
        return $this->test($rules);
    }

    public function goal()
    {
        $rules = array(
            'goal' => 'required|min:2|max:80',
        );
        return $this->test($rules);
    }

    public function official_date_creation()
    {
        $rules = array(
            'official_date_creation' => 'required|min:2|max:80',
        );
        return $this->test($rules);
    }

    public function website_url()
    {
        $rules = array(
            'website_url' => 'required|min:2|max:80',
        );
        return $this->test($rules);
    }

    public function headquarter()
    {
        $rules = array(
            'headquarter' => 'required|min:2|max:80',
        );
        return $this->test($rules);
    }

    public function admitted_public_utility()
    {
        $rules = array(
            'admitted_public_utility' => 'required|min:2|max:80',
        );
        return $this->test($rules);
    }

    public function internal_regulation()
    {
        $rules = array(
            'internal_regulation' => 'required',
        );
        return $this->test($rules);
    }

    public function statuts()
    {
        $rules = array(
            'statuts' => 'required',
        );
        return $this->test($rules);
    }

    public function contact_adress()
    {
        $rules = array(
            'contact_adress' => 'required',
        );
        return $this->test($rules);
    }
}