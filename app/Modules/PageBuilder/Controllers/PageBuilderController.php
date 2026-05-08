<?php

namespace App\Modules\PageBuilder\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\PageBuilder\Models\Page;

class PageBuilderController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('PageBuilder::index', compact('pages'));
    }

    public function edit($id)
    {
        // Drag and drop editor logic
    }
}
