<?php

namespace App\Services;

use App\Models\Setting;
use Cache;

class SettingsService
{
    function getSettings(){
        return Cache::rememberForever('settings', function(){
            if(class_exists(Setting::class))
            {
                return Setting::pluck('value', 'key')->toArray();;
            }
        });
    }

    function setGlobalSettings() : void {
        $settings = $this->getSettings();
        config()->set('settings', $settings);
    }

    function clearCacheSettings(): void {
        Cache::forget('settings');
    }
}
