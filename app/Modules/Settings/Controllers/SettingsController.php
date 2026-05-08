<?php

namespace App\Modules\Settings\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Settings\Models\Configuration;

class SettingsController extends Controller
{
    public function index($group = 'general')
    {
        $settings = Configuration::where('group', $group)->get();
        return view('Settings::index', compact('settings', 'group'));
    }
}
