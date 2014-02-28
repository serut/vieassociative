<?php

/**
 * Class validators_discussion
 */
class validators_discussion extends BaseValidator
{
    /**
     * @return array
     */
    public function add()
    {
        $rules = array(
            'text' => 'required|max:3000',
            'id_answer' => 'integer',
            'id_discussion' => 'integer',
        );
        return $this->test($rules);
    }

    /**
     * @return array
     */
    public function vote()
    {
        $rules = array(
            'id_answer' => 'integer',
            'value' => 'between:0,1',
        );
        return $this->test($rules);
    }

    /**
     * @return array
     */
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
