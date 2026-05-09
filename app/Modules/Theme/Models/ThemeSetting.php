<?php

namespace App\Modules\Theme\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ThemeSetting extends Model
{
    protected $table = 'theme_settings';

    protected $fillable = [
        'theme_id',
        'key',
        'value',
        'type',
        'group',
        'label',
        'options',
        'sort_order',
    ];

    protected $casts = [
        'options' => 'json',
        'sort_order' => 'integer',
    ];

    public function theme(): BelongsTo
    {
        return $this->belongsTo(Theme::class, 'theme_id');
    }
}
