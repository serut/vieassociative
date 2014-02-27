<?php

class validators_discussion extends BaseValidator
{
    public function add()
    {
        $rules = array(
            'text' => 'required|max:3000',
            'id_answer' => 'integer',
            'id_discussion' => 'integer',
        );
        return $this->test($rules);
    }

    public function vote()
    {
        $rules = array(
            'id_answer' => 'integer',
            'value' => 'between:0,1',
        );
        return $this->test($rules);
    }

    public function validate()
    {
        Validator::extend('have_autorisation', function ($attribute, $value, $parameters) {
            $p = Proposition::findOrFail(Input::get('id_proposition'));
            return User::isAdministrator($p->id_assoc);
        });

        $rules = array(
            'id_proposition' => 'integer|have_autorisation:yes',
            'value' => 'between:0,1',
        );
        return $this->test($rules);
    }
}
