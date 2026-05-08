<?php

/**
 * Developed by: Poka Machande Junior Software Engineer
 * Project: Slack Website Platform
 */

namespace App\Modules\CMS\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\CMS\Models\Post;

class CMSController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('CMS::index', compact('posts'));
    }
}
