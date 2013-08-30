<?php
class SiteHelpers{

	static function create_radio($options){
		$txt = '<div class="control-group">';
			$txt.= SiteHelpers::add_label($options);
			$txt.= '<div class="controls"';
			if(isset($options['data-toggle']))
				$txt.= ' data-toggle="'.$options['data-toggle'].'"';

			if(!isset($options['value']))
				$options['value']='';
			$txt.= '>';
				foreach ($options['elements'] as $k => $v) {
					$txt.= '<label class="checkbox">';
					if(isset($v['checked']) || $options['value']==$v['value']){
						$txt.= Form::radio($options['name'], $v['value'],true);
					}else{
						$txt.= Form::radio($options['name'], $v['value']);
					}
					$txt.= ' '.$v['text'];
					$txt.= '</label>';
				}
			$txt.= "</div>";
		$txt.= "</div>";
		return $txt;
	}

	static function create_checkbox($options){
		$txt = '<div>';
			$txt.= SiteHelpers::add_label($options);
			$txt.= '<div class="controls"';
			if(isset($options['data-toggle']))
				$txt.= ' data-toggle="'.$options['data-toggle'].'"';
			$txt.= '>';

				foreach ($options['elements'] as $k => $v) {
					$txt.= '<label class="checkbox">';
					if(isset($v['checked'])){
						$txt.= Form::checkbox($options['name'], $v['value'],$v['checked']);
					}else{
						$txt.= Form::checkbox($options['name'], $v['value']);
					}
					$txt.= ' '.$v['text'];
					$txt.= '</label>';
				}
			$txt.= "</div>";
		$txt.= "</div>";
		return $txt;
	}
	
	static function create_input($options){
		$txt = '<div class="control-group">';
			$txt.= SiteHelpers::add_label($options);
			$txt.= '<div class="controls">';
				$txt.= SiteHelpers::simple_input($options);
			$txt.= "</div>";
		$txt.= "</div>";
		return $txt;
	}
	
	static function create_datepicker_range(){
		$txt = '<div class="date-container">';
			$txt.= '<div class="date-range-field"><span></span>';
			$txt.= '<a href="#">▼</a></div>';
			$txt.= '<div class="datepicker-calendar"></div>';
		$txt.= "</div>";
		return $txt;
	}

	static function create_datepicker(){
		$txt = '<div class="date-container">';
			$txt.= '<div class="date-range-field"><span></span>';
			$txt.= '<a href="#">▼</a></div>';
			$txt.= '<div class="datepicker-calendar"></div>';
		$txt.= "</div>";
		return $txt;
	}

	static function simple_input($options){
		$txt= '';
			// manage the form
			$options['form']['id'] = $options['id'];
			if(isset($options['form']['data-original-title'])){
				$options['form']['data-placement'] = 'right';
				$options['form']['data-rel'] = 'tooltip';
				$options['form']['data-trigger'] = 'change';
				$options['form']['rele'] = 'tooltip';
			}
			if(!isset($options['type'])){
				$options['type'] = 'text';
			}
			if(!isset($options['value'])){
				$options['value'] = '';
			}
			$txt.= SiteHelpers::callFormClass($options);

			$txt.= '	<span class="text-error">';
				if(isset($options['errors'])){
					foreach ($options['errors']->get('pseudo','<ul class="help-inline">:message</ul>') as $message){
			            $txt.=$message;
					}
				}
		$txt.= "	</span>";
		return $txt;
	}

	static function callFormClass($options){
		switch ($options['type']) {
			case 'password':
				return Form::password($options['id'], $options['form']);
		}
		return Form::text($options['id'],$options['value'],$options['form']);
	}

	static function add_label($options){
		if(isset($options['label'])){
			return '<label class="control-label">'.$options['label'].'</label>';
		}
	}
}