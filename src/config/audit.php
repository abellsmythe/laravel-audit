<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Audit implementation
    |--------------------------------------------------------------------------
    |
    | Define which Audit model implementation should be used.
    |
    */

    'implementation' => Toncho\LaravelAudit\Models\Audit::class,

    /**
     * Define the guards.
     */
    'guards' => [
        'user' => [
            'primary_key' => 'id',
            'foreign_key' => 'user_id',
            'model' => App\Models\User::class
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Driver
    |--------------------------------------------------------------------------
    |
    | The default audit driver used to keep track of changes.
    |
    */

    'default' => 'database',

    /*
    |--------------------------------------------------------------------------
    | Audit Drivers
    |--------------------------------------------------------------------------
    |
    | Available audit drivers and respective configurations.
    |
    */
    'drivers' => [
        'database' => [
            'table'      => 'audit',
            'connection' => null,
        ],
    ]
    
];