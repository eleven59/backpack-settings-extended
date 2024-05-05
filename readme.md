# Backpack Settings Extended

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

**Extension for `backpack/settings`**

This package extends the **Backpack for Laravel** `backpack/settings` package:
- easily create multiple backend pages for settings so you can categorize them for your users
- custom sort order for settings list pages
- customize entity names (instead of "setting"/"settings")
- default options for field types (e.g. custom ckeditor build)
- add widgets to list or update operations
- translatable settings


## Installation


### Dependencies

This package requires
* [backpack/crud:^6.0][link-backpack]
* [backpack/settings:^3.1][link-backpack-settings]
* [spatie/laravel-translatable:^6.0][link-spatie-laravel-translatable]


### Installation

Via Composer
``` bash
# Install module + dependencies 
composer require eleven59/backpack-settings-extended

# Publish Backpack Settings migration, then run all migrations
php artisan vendor:publish --provider="Backpack\Settings\SettingsServiceProvider" --tags=migrations
php artisan migrate

# Publish Backpack Extended config file
php artisan vendor:publish --provider="Eleven59\BackpackSettingsExtended\AddonServiceProvider"
```

You will now find the config file at `config/eleven59/backpack-settings-extended.php`


## Usage

### Multiple settings pages

This packages adds a `type` column to the settings table. Using this column, you can create multiple backend settings pages to categorize settings. You can configure the routes in the `config` file as follows:

```php
'routes' => [
    'url-slug' => 'type-column-value',
]
```

If you've added an entry to the database that has "type-column-value" in the `type` column, that settings entry will now automatically show up on the following pages if you have the above array in your config file:

``` bash
# All settings (default URL slug can be changed in config):
https://your-site/{backpack-admin-slug}/setting

# Only settings with "type-column-value" as their DB type
https://your-site/{backpack-admin-slug}/url-slug
```

### Default options for field types

You can use the `config/eleven59/backpack-settings-extended.php` file to add custom default definitions for field types, so you don't have to enter complex stuff in the database, that sometimes does not even work (e.g. for ckeditor fields like in the example below).

**Note:** the defaults are overwritten if the main key (i.e., 'crop' or 'withFiles' below) exists in the field definition in the database. The defaults are only used if the entire key is missing from the field definition in the database.


```php
'field-defaults' => [
    'image' => [
        'crop' => true,
        'withFiles' => [
            'disk' => 'public',
            'path' => 'settings',
        ],
    ],
    'ckeditor' => [
        'custom_build' => [
            resource_path('assets/ckeditor/ckeditor.js'),
            resource_path('assets/ckeditor/ckeditor-init.js'),
        ],
    ],
],
```

### Widgets

You can define widgets for both the list and update operations (since these are the only two available anyway). This will allow you to load custom scripts and css for example, which may help with some of the more convoluted custom default column defaults.

```php
'widgets' => [
    'list' => [],
    'update' => [
        [
            'type' => 'script',
            'content' => 'https://unpkg.com/jquery-colorbox@1.6.4/jquery.colorbox-min.js',
        ],
        [
            'type' => 'style',
            'content' => 'https://unpkg.com/jquery-colorbox@1.6.4/example2/colorbox.css',
        ],
    ],
],
```

### Custom sort order

This package adds a `position` column to the settings table. By default, the list pages are ordered by this column in ascending order. You can change this behavior in the `config/eleven59/backpack-settings-extended.php` file:


```php
'order-by' => [
    'field' => 'position',
    'order' => 'asc',
],
```

### Custom entity string names

This package allows you to change the default entity names of "setting" for singular and "settings" for plural. By default, the backpack/settings strings are used. You can change their values in the `config/eleven59/backpack-settings-extended.php` file:

```php
'entity-name-strings' => [
    'singular' => 'setting',
    'plural' => 'settings',
],
```

### Translatable

If you want to use translatable settings, you can do so by enabling the custom Settings model included for that:

```php
//'model' => \Eleven59\BackpackSettingsExtended\Models\Setting::class, // <-- default
'model' => \Eleven59\BackpackSettingsExtended\Models\SettingWithTranslations::class, // <-- switch to this one
```

Once you enable this, it "just works" and will automatically enable all languages you have enabled in the `config/backpack/crud.php` settings file.

Unfortunately, the way `spatie/translatable` works, this setting can't be enabled on a per-entity basis (since it requires setting a static property on the model itself). So it's either all settings are translatable or none of them are.

## Change log

Breaking changes will be listed here. For other changes see commit log.

### V2.1
The default model has been changed to the model that does not include the `HasTranslations` trait. This is better for those upgrading from backpack/settings after having already implemented it, because `spatie/translatable` changes the way the data is stored in and read from the database. Enabling by default would mean data loss, since all settings fields in the admin would be empty (because no translations could be found).

However, since v2.0 of *this* package, the default model *did* include translations. If you're updating from v2.0, please make sure to use the translatable model, as described above under the **translatable** heading.

### V2.0
- Now only works with backpack/crud:^6.0 and backpack/settings:^3.1
- Accordingly, now requires PHP 8.1+ and backpack/pro is needed for pro fields
- Added requirement for spatie/laravel-translatable:^6.0 for the translations
- Removed requirement for eleven59/backpack-images-traits. This is already possible out of the box with Backpack 6.0 since you can use the WithFiles directive now.



## Credits

- [Nik Linders @ eleven59.nl][link-author]
- Built with [Laravel Backpack addon skeleton][link-skeleton]



## License

This project was released under the MIT license, so you can install it on top of any Backpack & Laravel project. Please see the [license file](license.md) for more information.

However, please note that you do need Backpack installed, so you need to also abide by its [YUMMY License](https://github.com/Laravel-Backpack/CRUD/blob/master/LICENSE.md). That means in production you'll need a Backpack license code. You can get a free one for non-commercial use (or a paid one for commercial use) on [backpackforlaravel.com](https://backpackforlaravel.com).

[ico-version]: https://img.shields.io/packagist/v/eleven59/backpack-settings-extended.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/eleven59/backpack-settings-extended.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/eleven59/backpack-settings-extended
[link-downloads]: https://packagist.org/packages/eleven59/backpack-settings-extended
[link-author]: https://github.com/eleven59
[link-skeleton]: https://github.com/Laravel-Backpack/addon-skeleton
[link-backpack]: https://github.com/Laravel-Backpack/CRUD
[link-backpack-settings]: https://curatedphp.com/r/backpacksettings-laravel-backpacksettings/index.html
[link-spatie-laravel-translatable]: https://github.com/spatie/laravel-translatable
