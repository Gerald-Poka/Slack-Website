<?php

namespace App\Modules\Auth\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Modules\Auth\Models\User $user */
        $user = Auth::user();

        if (! $user) {
            return redirect()->route('login');
        }

        if ($user->hasRole(['super_admin', 'admin'])) {
            return view('admin.dashboard');
        }

        if ($user->hasRole('editor')) {
            return view('public.home'); // Placeholder for editor dashboard
        }

        if ($user->hasRole('contributor')) {
            return view('public.home'); // Placeholder for contributor dashboard
        }

        return view('public.home');
    }
}
