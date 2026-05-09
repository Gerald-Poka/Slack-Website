<?php

namespace App\Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $table = 'configurations';

    protected $fillable = [
        'group',
        'key',
        'value',
        'type',
        'is_public',
        'is_locked',
        'label',
        'description',
        'sort_order',
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'is_locked' => 'boolean',
        'sort_order' => 'integer',
    ];
}
