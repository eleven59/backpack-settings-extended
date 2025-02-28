<?php

namespace Eleven59\BackpackSettingsExtended\Models;

use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;

/**
 * @method where(string $string, string $key)
 */
class SettingWithTranslations extends \Backpack\Settings\app\Models\Setting
{
    use HasTranslations;

    protected array $translatable = ['value'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * Grab a setting value from the database.
     *
     *
     * @param string $key
     * @param null $default
     * @return ?string The setting value.
     */
    public static function get($key, $default = null): ?string
    {
        $setting = new self();
        $entry = $setting->where('key', $key)->first();

        if (!$entry) {
            return $default;
        }

        return $entry->value;
    }
}
