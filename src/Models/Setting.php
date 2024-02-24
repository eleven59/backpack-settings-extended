<?php

namespace Eleven59\BackpackSettingsExtended\Models;

use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\HasTranslations;

class Setting extends \Backpack\Settings\app\Models\Setting
{
    use HasTranslations;

    protected array $translatable = ['value'];
}
