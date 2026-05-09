<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Navigation\Models\NavMenu;

class NavigationSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            ['name' => 'primary', 'label' => 'Primary Navigation', 'description' => 'Main top navigation menu displayed in the site header.'],
            ['name' => 'footer',  'label' => 'Footer Navigation',  'description' => 'Links displayed in the website footer.'],
            ['name' => 'mobile',  'label' => 'Mobile Navigation',  'description' => 'Hamburger menu for mobile viewports.'],
            ['name' => 'top_bar', 'label' => 'Top Bar',            'description' => 'Optional slim top bar above the header.'],
        ];

        foreach ($menus as $menu) {
            NavMenu::updateOrCreate(['name' => $menu['name']], $menu);
        }
    }
}
