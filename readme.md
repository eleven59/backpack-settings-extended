# BackpackSettingsExtended

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

**Extension for BackpackSettings module**

This package extends the BackpackSettings module:
- easily create multiple backend pages for settings so you can categorize them for your users
- custom sort order for settings list pages
- customize entity names (use anything you want instead of "setting"/"settings")
- default options for field types
- translatable values for settings


## Installation


### Dependencies

This package requires
* PHP 8.1+
* [backpack/crud:^6.0][link-backpack]
* [backpack/settings:^3.1][link-backpack-settings]
* [spatie/laravel-translatable:^6.0][link-spatie-laravel-translatable]


### Installation

Via Composer
``` bash
# Install module + dependencies 
composer require eleven59/backpack-settings-extended

# Publish assets and run migrations
php artisan vendor:publish --provider="Eleven59\BackpackSettingsExtended\AddonServiceProvider"
php artisan migrate
```
This should automatically prioritize backpack/settings to migrate first. However, If you run into migration errors:
- Uninstall eleven59/backpack-settings-extended
- Manuall install backpack/settings first and run migrations
- Then reinstall eleven59/backpack-settings-extended using the commands above


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
        'options' => [
            'heading' => [
                'options' => [
                    [
                        'model' => 'heading2sick',
                        'view' => [
                            'name' => 'h2',
                            'classes' => 'sick-heading',
                        ],
                        'title' => 'Sick heading',
                        'class' => 'ck-h2',
                        'converterPriority' => 'high',
                    ],
                ]
            ]
        ]
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

That just works. If you have defined more than one language in the config/backpack/crud.php file then the languages will magically appear in the settings CRUD create/update pages now.


## Change log

Breaking changes will be listed here. For other changes see commit log.

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
