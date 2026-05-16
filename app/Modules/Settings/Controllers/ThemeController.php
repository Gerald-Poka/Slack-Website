<?php

namespace App\Modules\Settings\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Settings\Models\Configuration;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        $settings = Configuration::where('group', 'theme')->orderBy('sort_order')->get();
        return view('Settings::theme.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $inputs = $request->except('_token');

        foreach ($inputs as $key => $value) {
            Configuration::where('key', $key)->update(['value' => $value]);
        }

        return back()->with('success', 'Theme settings updated successfully!');
    }
}
