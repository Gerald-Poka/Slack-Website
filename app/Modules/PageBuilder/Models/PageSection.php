<?php

namespace App\Modules\PageBuilder\Models;

use App\Modules\Media\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PageSection extends Model
{
    protected $table = 'page_sections';

    protected $fillable = [
        'page_id',
        'bg_image_id',
        'name',
        'layout',
        'bg_color',
        'bg_type',
        'bg_gradient',
        'bg_video_url',
        'padding_top',
        'padding_bottom',
        'padding_left',
        'padding_right',
        'css_class',
        'css_id',
        'sort_order',
        'is_active',
        'full_width',
        'container_width',
    ];

    protected $casts = [
        'padding_top' => 'integer',
        'padding_bottom' => 'integer',
        'padding_left' => 'integer',
        'padding_right' => 'integer',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
        'full_width' => 'boolean',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function backgroundImage(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'bg_image_id');
    }

    public function blocks(): HasMany
    {
        return $this->hasMany(PageBlock::class, 'section_id')->orderBy('sort_order');
    }
}
