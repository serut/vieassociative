<?php
	ob_start();
?>
@section ('form')
@show
<?php
	$form = ob_get_contents();
	ob_end_clean();
?>
@section ('head')
@show
<?php
	$head = ob_get_contents();
	ob_end_clean();
	$content = array('head'=>$head,'content'=>$form);
	echo json_encode($content);
?>


