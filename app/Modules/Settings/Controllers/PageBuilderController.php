<?php

namespace App\Modules\Settings\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageBuilderController extends Controller
{
    public function index()
    {
        $pages = DB::table('pages')->get();
        return view('Settings::pagebuilder.index', compact('pages'));
    }

    public function edit($id)
    {
        $page = DB::table('pages')->where('id', $id)->first();
        
        // Get sections and their blocks
        $sections = DB::table('page_sections')
            ->where('page_id', $id)
            ->orderBy('sort_order')
            ->get()
            ->map(function($section) {
                $section->blocks = DB::table('page_blocks')
                    ->join('block_types', 'page_blocks.block_type_id', '=', 'block_types.id')
                    ->where('section_id', $section->id)
                    ->select('page_blocks.*', 'block_types.label as type_label', 'block_types.icon as type_icon')
                    ->orderBy('sort_order')
                    ->get();
                return $section;
            });
            
        $blockTypes = DB::table('block_types')->where('is_active', true)->get();

        return view('Settings::pagebuilder.edit', compact('page', 'sections', 'blockTypes'));
    }

    public function addSection(Request $request, $id)
    {
        $blockType = DB::table('block_types')->where('id', $request->block_type_id)->first();
        
        // 1. Create the Section
        $sectionId = DB::table('page_sections')->insertGetId([
            'page_id' => $id,
            'name' => $blockType->label . ' Container',
            'layout' => 'full',
            'sort_order' => DB::table('page_sections')->where('page_id', $id)->count() + 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Create the Block inside the Section
        DB::table('page_blocks')->insert([
            'section_id' => $sectionId,
            'block_type_id' => $blockType->id,
            'props' => $blockType->default_props,
            'sort_order' => 1,
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Section and Block added successfully!');
    }
}
