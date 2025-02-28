<?php /** @noinspection PhpPropertyOnlyWrittenInspection */

namespace Eleven59\BackpackSettingsExtended\Models;

/**
 * @method where(string $string, string $key)
 */
class Setting extends \Backpack\Settings\app\Models\Setting
{
    private array $translatable;

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
