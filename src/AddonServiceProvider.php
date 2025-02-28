<?php

namespace Eleven59\BackpackSettingsExtended;

use Illuminate\Support\ServiceProvider;

class AddonServiceProvider extends ServiceProvider
{
    use AutomaticServiceProvider;

    protected string $vendorName = 'eleven59';
    protected string $packageName = 'backpack-settings-extended';
    protected array $commands = [];
    private string $path;
}
