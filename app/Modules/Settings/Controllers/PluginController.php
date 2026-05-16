<?php

namespace App\Modules\Settings\Controllers;

use App\Http\Controllers\Controller;

class PluginController extends Controller
{
    public function index()
    {
        // Marketplace and installed plugins list
        return view('Settings::plugins.index');
    }
}
