<?php
class BaseValidator{
	public function getMessageMissingInput(){
		return array('error'=>array('type'=>'Validateur Error', 'message'=>Lang::get('core/form.input_missing'),'file'=>'Validator','line'=>0));
	}
	public function need($elements){
		$noProblem = true;
		$i = sizeof($elements)-1;
		$inputs = array();

		while ($noProblem && $i >= 0){
			if(Input::has($elements[$i]))
				$inputs[$elements[$i]] = Input::get($elements[$i],null);
			else
				$noProblem = false;
			$i--;
		}

		if($noProblem)
			return $inputs;
		throw new Exception();

	}
}