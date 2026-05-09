<?php

namespace App\Modules\PageBuilder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageBlock extends Model
{
    protected $table = 'page_blocks';

    protected $fillable = [
        'section_id',
        'block_type_id',
        'column',
        'props',
        'cache_key',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'props' => 'json',
        'column' => 'integer',
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(PageSection::class, 'section_id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(BlockType::class, 'block_type_id');
    }
}
