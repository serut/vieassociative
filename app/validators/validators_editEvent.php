<?php

/**
 * Class validators_editEvent
 */
class validators_editEvent
{
    /**
     * @param $input
     * @return bool
     */
    static function validateFirstStep($input)
    {
        $rules = array(
            'idAssoc' => 'required',
            'idEv' => 'required',
            'nomEv' => 'required|min:5',
            'text' => 'required|min:15',
        );
        $v = Validator::make($input, $rules);
        return !$v->fails();
    }
}