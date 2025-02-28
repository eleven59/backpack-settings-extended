<?php

/**
 * Admin Routes
 */

use Eleven59\BackpackSettingsExtended\Http\Controllers\Admin\SettingCrudController;

Route::group([
     'prefix' => config('backpack.base.route_prefix', 'admin'),
     'middleware' => array_merge(
         (array) config('backpack.base.web_middleware', 'web'),
         (array) config('backpack.base.middleware_key', 'admin')
     ),
 ], function () {

     Route::crud(config('eleven59.backpack-settings-extended.default_route'), SettingCrudController::class);

     foreach(config('eleven59.backpack-settings-extended.routes') as $slug => $type) {
         Route::crud($slug, SettingCrudController::class);
     }
 });
