<?php

/*
 * This file is part of HTMLPurifier Bundle.
 * (c) 2012-2013 Maxime Dizerens
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return array(
    'finalize' => true,
    'preload' => false,
    'settings' => array(
        'HTML.Doctype' => 'XHTML 1.0 Strict',
        'HTML.Allowed' => 'div,b,strong,i,em,a[href|title],ul,ol,li,p[style],br,span[style],img[width|height|alt|src]',
        'CSS.AllowedProperties' => 'font,font-size,font-weight,font-style,font-family,text-decoration,padding-left,color,background-color,text-align',
        'AutoFormat.AutoParagraph' => false,
        'AutoFormat.RemoveEmpty' => true
    ),
);