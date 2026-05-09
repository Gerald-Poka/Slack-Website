<?php

namespace App\Modules\CMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContentCategory extends Model
{
    protected $table = 'content_categories';

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
        'image_id',
        'color',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(ContentCategory::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(ContentCategory::class, 'parent_id');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(ContentPost::class, 'category_id');
    }
}
