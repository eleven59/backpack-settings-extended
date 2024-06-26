<?php

namespace Eleven59\BackpackSettingsExtended\Models;

use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;

class Setting extends \Backpack\Settings\app\Models\Setting
{
    public function __construct(array $attributes = [])
    {
        if (!config('eleven59.backpack-settings-extended.enable-translations')) {
            $this->translatable = [];
        }

        parent::__construct($attributes);
    }

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
