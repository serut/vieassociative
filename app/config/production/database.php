<?php

return array(
    'connections' => array(
        'mysql' => array(
            'driver' => 'mysql',
            'host' => getenv('VA_DB_HOST'),
            'database' => getenv('VA_DB_NAME'),
            'username' => getenv('VA_DB_USERNAME'),
            'password' => getenv('VA_DB_PASSWORD'),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ),
    ),
);
