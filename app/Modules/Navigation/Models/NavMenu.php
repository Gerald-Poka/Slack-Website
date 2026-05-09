<?php

namespace App\Modules\Navigation\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NavMenu extends Model
{
    protected $table = 'nav_menus';

    protected $fillable = [
        'name',
        'label',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(NavMenuItem::class, 'menu_id')->orderBy('sort_order');
    }
}
