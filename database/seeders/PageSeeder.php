<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    public function run()
    {
        // Create the Home Page
        DB::table('pages')->updateOrInsert(
            ['slug' => 'home'],
            [
                'title' => 'Home Page',
                'status' => 'published',
                'type' => 'landing', // Matches the ENUM in your schema
                'author_id' => 1,
                'is_homepage' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Get the ID of the home page
        $page = DB::table('pages')->where('slug', 'home')->first();

        // Add a default Hero section if the page is empty
        if (DB::table('page_sections')->where('page_id', $page->id)->count() == 0) {
            $heroType = DB::table('block_types')->where('name', 'hero')->first();
            
            if ($heroType) {
                $sectionId = DB::table('page_sections')->insertGetId([
                    'page_id' => $page->id,
                    'name' => 'Home Hero',
                    'layout' => 'full',
                    'sort_order' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::table('page_blocks')->insert([
                    'section_id' => $sectionId,
                    'block_type_id' => $heroType->id,
                    'props' => $heroType->default_props,
                    'sort_order' => 1,
                    'is_active' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
