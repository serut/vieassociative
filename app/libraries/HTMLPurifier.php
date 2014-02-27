<?php

/*
* This file is part of HTMLPurifier Bundle.
* (c) 2012-2013 Maxime Dizerens
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

App::singleton('HTMLPurifier', function()
{
    if ( ! class_exists('HTMLPurifier_Config', false))
    {
        if (Config::get('purifier.preload'))
        {
            // Load the all of HTML Purifier right now.
            // This increases performance with a slight hit to memory usage.
            require base_path() . '/ezyang/htmlpurifier/library/HTMLPurifier.includes.php';
        }
        
        // Load the HTML Purifier auto loader
        require base_path() . '/vendor/ezyang/htmlpurifier/library/HTMLPurifier.auto.php';
    }
    
    // Create a new configuration object
    $config = HTMLPurifier_Config::createDefault();
    
    if ( ! Config::get('purifier.finalize'))
    {
        // Allow configuration to be modified
        $config->autoFinalize = false;
    }
    
    // Use the same character set as Laravel
    $config->set('Core.Encoding', Config::get('app.encoding'));
    
    if (is_array($settings = Config::get('purifier.settings')))
    {
        // Load the settings
        $config->loadArray($settings);
    }
    
    // Configure additional options
    $config = HTMLPurifier_Config::create($config);
    
    // Return the purifier instance
    return new HTMLPurifier($config);
});