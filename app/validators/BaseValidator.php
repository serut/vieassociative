<?php

/**
 * Class BaseValidator
 */
class BaseValidator
{
    /**
     * @param $rules
     * @param array $toPurify
     * @return array
     */
    public function test($rules, $toPurify = array())
    {
        $inputs = Input::all();
        if (!empty($toPurify)) {
            $inputs = $this->purify($inputs, $toPurify);
        }
        $v = Validator::make($inputs, $rules);
        if (!$v->fails()) {
            $message = array('success' => 'true', 'data' => $inputs);
        } else {
            $message = array('error' => "Une erreur est survenue avec la validation");
            foreach ($v->messages()->all('<li>:message</li>') as $m) {
                $message['error-message'][] = $m;
            }
        }
        return $message;
    }

    /**
     * @param $input
     * @param $toPurify
     * @return mixed
     */
    public function purify($input, $toPurify)
    {
        $purifier = App::make('HTMLPurifier');
        foreach ($toPurify as $v) {
            if (isset($input[$v])) {
                $input[$v] = $purifier->purify($input[$v]);
            }
        }
        return $input;
    }

    /**
     * @return array
     */
    public function getMessageMissingInput()
    {
        return array('error' => array('type' => 'Validateur Error', 'message' => Lang::get('core/form.input_missing'), 'file' => 'Validator', 'line' => 0));
    }

    /**
     * @param $elements
     * @return array
     * @throws Exception
     */
    public function need($elements)
    {
        $noProblem = true;
        $i = sizeof($elements) - 1;
        $inputs = array();

        while ($noProblem && $i >= 0) {
            if (Input::has($elements[$i]))
                $inputs[$elements[$i]] = Input::get($elements[$i], null);
            else
                $noProblem = false;
            $i--;
        }

        if ($noProblem)
            return $inputs;
        throw new Exception();

    }
}