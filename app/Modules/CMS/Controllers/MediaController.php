<?php

namespace App\Modules\CMS\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Media\Models\Media;

class MediaController extends Controller
{
    public function index()
    {
        $mediaItems = Media::latest()->paginate(24);
        return view('Media::index', compact('mediaItems'));
    }
}
