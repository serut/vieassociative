<?php
// Recursive call of preg_replace - found every call of full_include  and replace by the file's code
function include_blade($match){
	$pattern = '/@full_include ([a-z_\.-]+) */';
	return preg_replace_callback($pattern, 'include_blade',file_get_contents(app_path().'/views/'.str_replace('.', '/',$match['1']).'.blade.php'));
}
Blade::extend(function($view)
{
	$pattern = '/@full_include ([a-z_\.-]+) */';
	return preg_replace_callback($pattern, 'include_blade',$view);
});

Blade::extend(function($view)
{
	$pattern = '/@set_true ([\$a-z-_]+) */';
	return preg_replace($pattern, '<?php $1 = true; ?>',$view);
});

// It's forbiden to put some @ in the text for this regex
Blade::extend(function($view)
{
	$pattern = '/@([a-z]{5}) = (.*?)@/s';
	return preg_replace($pattern, '<?php $'.'$1'. '= $2; ?>',$view);
});