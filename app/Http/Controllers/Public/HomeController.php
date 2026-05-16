<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $page = DB::table('pages')->where('slug', 'home')->first();
        
        if (!$page) {
            // Default welcome if no page is built yet
            return view('welcome');
        }

        $sections = DB::table('page_sections')
            ->where('page_id', $page->id)
            ->where('is_active', 1)
            ->orderBy('sort_order')
            ->get()
            ->map(function($section) {
                $section->blocks = DB::table('page_blocks')
                    ->join('block_types', 'page_blocks.block_type_id', '=', 'block_types.id')
                    ->where('section_id', $section->id)
                    ->where('page_blocks.is_active', 1)
                    ->select('page_blocks.*', 'block_types.name as type_name')
                    ->orderBy('sort_order')
                    ->get();
                return $section;
            });

        return view('public.home', compact('page', 'sections'));
    }
}
