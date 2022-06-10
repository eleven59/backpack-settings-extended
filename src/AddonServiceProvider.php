<?php

namespace Eleven59\BackpackSettingsExtended;

use Illuminate\Support\ServiceProvider;

class AddonServiceProvider extends ServiceProvider
{
    use AutomaticServiceProvider;

    protected $vendorName = 'eleven59';
    protected $packageName = 'backpack-settings-extended';
    protected $commands = [];
}
