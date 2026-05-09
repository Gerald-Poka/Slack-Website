<?php

namespace App\Modules\SEO\Models;

use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    protected $table = 'redirects';

    protected $fillable = [
        'from_url',
        'to_url',
        'type',
        'hit_count',
        'is_active',
        'note',
    ];

    protected $casts = [
        'type' => 'integer',
        'hit_count' => 'integer',
        'is_active' => 'boolean',
    ];
}
