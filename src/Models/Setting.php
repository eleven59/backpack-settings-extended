<?php

namespace Eleven59\BackpackSettingsExtended\Models;

use Backpack\CRUD\app\Models\Traits\HasUploadFields;
use Eleven59\BackpackImageTraits\Traits\HasImageFields;
use Illuminate\Support\Str;

class Setting extends \Backpack\Settings\app\Models\Setting
{
    use HasImageFields;
    use HasUploadFields;

    public function setValueAttribute($value)
    {
        if(Str::startsWith($value, 'data:image')) {
            $this->attributes['value'] = $this->uploadImageData($value, [
                'disk' => config('eleven59.backpack-settings-extended.image.disk'),
                'destination_path' => config('eleven59.backpack-settings-extended.image.destination_path'),
                'quality' => config('eleven59.backpack-settings-extended.image.quality'),
                'format' => config('eleven59.backpack-settings-extended.image.format'),
            ]);
        } elseif (strlen($value) < 512 && is_file ($value)) {
            $disk = config('eleven59.backpack-settings-extended.storage.disk');
            $path = config('eleven59.backpack-settings-extended.storage.destination_path');
            $this->uploadFileToDisk($value, "value", $disk, $path);
            $this->attributes['value'] = 'storage/' . $this->attributes['value'];
        } else {
            $this->attributes['value'] = $value;
        }
    }
}
