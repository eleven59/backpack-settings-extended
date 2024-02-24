<?php

namespace Eleven59\BackpackSettingsExtended\Models;

use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;

class Setting extends \Backpack\Settings\app\Models\Setting
{
    use HasTranslations;

    protected array $translatable = ['value'];

    /**
     * Grab a setting value from the database.
     *
     * @param string $key The setting key, as defined in the key db column
     *
     * @return string The setting value.
     */
    public static function get($key)
    {
        $setting = new self();
        $entry = $setting->where('key', $key)->first();

        if (!$entry) {
            return;
        }

        return $entry->value;
    }
}
