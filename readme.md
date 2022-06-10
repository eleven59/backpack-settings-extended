# BackpackSettingsExtended

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]

**Extension for BackpackSettings module**

This package extends the BackpackSettings module:
- you can nog use "upload" and "image" types for the field types in the database (image settings and upload disks are configurable).
- easily create multiple backend pages for settings so you can categorize them for your users
- custom sort order for settings list pages
- customize entity names (use anything you want instead of "setting"/"settings")


## Installation


### Dependencies

This package requires
* PHP 8.0+
* [backpack/crud:4.1.*][link-backpack]
* [backpack/settings:^3.0][link-backpack-settings]
* [eleven59/backpack-images-traits:^1.0][link-image-traits]


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

### Image and upload field types
Image and upload fields are now automatically supported. Just use the following for your `field` column in the database and that's all she wrote. You can also change the upload path and disk as well as some standard options for the image compression in the `config/eleven59/backpack-settings-extended.php` file.

#### Upload field:
```json
{"name": "value", "label": "Upload field", "type": "upload", "upload": true}
```

#### Image field:
```json
{"name": "value", "label": "Image cropper", "type": "image", "upload": true, "crop": true}
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


## Change log

Breaking changes will be listed here. For other changes see commit log.



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
[link-image-traits]: https://github.com/eleven59/backpack-image-traits
