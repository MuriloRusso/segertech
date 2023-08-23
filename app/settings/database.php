<?php

return [

    'mysql' => [
        
        'Hostname' => '127.0.0.1',
        'Password' => '1qaz@WSX',
        'Username' => 'development',
        'Database' => 'boiler_plate',

        'Parameters' => [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        ],

        'provider' => App\Core\Database\Driver\MySqlDriver::class,
    ],
    
];