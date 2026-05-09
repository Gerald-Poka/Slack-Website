<?php

namespace App\Modules\PageBuilder\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlockType extends Model
{
    protected $table = 'block_types';

    protected $fillable = [
        'name',
        'label',
        'category',
        'icon',
        'description',
        'schema',
        'default_props',
        'renderer_class',
        'is_active',
        'is_system',
        'sort_order',
    ];

    protected $casts = [
        'schema' => 'json',
        'default_props' => 'json',
        'is_active' => 'boolean',
        'is_system' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function blocks(): HasMany
    {
        return $this->hasMany(PageBlock::class, 'block_type_id');
    }
}
