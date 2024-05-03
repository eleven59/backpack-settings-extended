<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Which model should we use?
    |--------------------------------------------------------------------------
    |
    | This setting has two default options:
    | Default: \Eleven59\BackpackSettingsExtended\Models\SettingWithTranslations::class,
    | Optional: \Eleven59\BackpackSettingsExtended\Models\Setting::class (use if you don't want translatable values)
    |
    | Additionally, you could extend the class and thus use a custom class.
    */

//    'model' => \Eleven59\BackpackSettingsExtended\Models\Setting::class,
    'model' => \Eleven59\BackpackSettingsExtended\Models\SettingWithTranslations::class,

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
