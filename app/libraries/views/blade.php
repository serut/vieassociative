<?php


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


/*
The MIT License (MIT)

Copyright (c) 2013 Trevor Fitzgerald
Laravel HTML Minify
*/
Blade::extend(function($view)
{
	if (
		preg_match('/<(pre)/', $view)                     || // <pre> or <textarea> tags
		preg_match('/value=("|\')(.*)([ ]{2,})(.*)("|\')/', $view)    // Value attribute that contains 2 or more adjacent spaces
	) {
		return $view;
	} else {
		//return $view;
		/*
		$replace = array(
			'/<!--[^\[](.*?)[^\]]-->/s' => '',       // HTML comments (except IE conditional comments)
			"/<\?php/"                  => '<?php',  // Opening PHP tags
			"/\n/"                  	=> '',       // New lines
			"/\r/"                      => '',       // Carriage returns
			"/\t/"                      => ' ',      // Tabs
			"/ +/"                      => ' ',      // Multiple spaces
		);
		$view = preg_replace(array_keys($replace), array_values($replace), $view);
		*/
		return $view;
	}
});



// Recursive call of preg_replace - found every call of full_include  and replace by the file's code
/*
Not used anymore 

function include_blade($match){
	$pattern = '/@full_include ([a-z_\.-]+) * /';
	return preg_replace_callback($pattern, 'include_blade',file_get_contents(app_path().'/views/'.str_replace('.', '/',$match['1']).'.blade.php'));
}
Blade::extend(function($view)
{
	$pattern = '/@full_include ([a-z_\.-]+) * /';
	return preg_replace_callback($pattern, 'include_blade',$view);
});
*/