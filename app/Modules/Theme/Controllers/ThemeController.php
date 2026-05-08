<?php

/**
 * Developed by: Poka Machande Junior Software Engineer
 * Project: Slack Website Platform
 */

namespace App\Modules\Theme\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Theme\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        $themes = Theme::all();
        return view('Theme::index', compact('themes'));
    }

    public function activate($id)
    {
        // Logic to switch active theme
    }
}
