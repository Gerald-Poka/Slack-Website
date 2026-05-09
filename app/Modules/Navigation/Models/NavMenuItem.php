<?php

namespace App\Modules\Navigation\Models;

use App\Modules\CMS\Models\ContentPost;
use App\Modules\PageBuilder\Models\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NavMenuItem extends Model
{
    protected $table = 'nav_menu_items';

    protected $fillable = [
        'menu_id',
        'parent_id',
        'page_id',
        'post_id',
        'label',
        'url',
        'target',
        'icon',
        'css_class',
        'rel',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(NavMenu::class, 'menu_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(NavMenuItem::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(NavMenuItem::class, 'parent_id')->orderBy('sort_order');
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(ContentPost::class, 'post_id');
    }
}
