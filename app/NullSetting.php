<?php

namespace App;

use App\Models\Setting;

class NullSetting extends Setting
{
    protected $attributes = [
        'site_title' => 'PanExpres',
        'site_name' => 'PanExpres',
        'site_email' => 'panexpress1@gmail.com',
        'footer_text' => 'default footer text',
        'sidebar_collapse' => false,
    ];
}
