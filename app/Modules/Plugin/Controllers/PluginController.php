<?php

namespace App\Modules\Plugin\Controllers;

use App\Http\Controllers\Controller;

class PluginController extends Controller
{
    public function index()
    {
        // Marketplace and installed plugins list
        return view('Plugin::index');
    }
}
