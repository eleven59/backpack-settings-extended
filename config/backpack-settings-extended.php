<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Multiple routes
    |--------------------------------------------------------------------------
    |
    | You can change the default route and add as many as you want
    |
    | In the 'routes' array, if you uncomment the example line, this would mean:
    | /admin/url-slug would load a list of entries that have 'setting-type' in the type column in the database
    |
    |
    |
    */

    // Routes and types
    'default_route' => 'setting',

    // Additional routes
    'routes' => [
//        'url-slug' => 'type-column-value',
    ],


    /*
    |--------------------------------------------------------------------------
    | Default settings for field types
    |--------------------------------------------------------------------------
    */
    'field-defaults' => [
//        'textarea' => [
//            'attributes' => ['rows' => '8'],
//        ],
    ],


    /*
    |--------------------------------------------------------------------------
    | Other settings
    |--------------------------------------------------------------------------
    */

    // Default sort order for list pages
    'order-by' => [
        'field' => 'position',
        'order' => 'asc',
    ],

    // Custom entity name strings
    'entity-name-strings' => [
        'singular' => 'item',
        'plural' => 'items',
    ],

];
