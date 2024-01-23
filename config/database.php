<?php

return [
    'connections' => [
        'sqlite' => [
            'driver' => 'sqlite',
            'path' =>  dirname( __FILE__ , 2) . '/database/database.sqlite',
        ]
    ]
];