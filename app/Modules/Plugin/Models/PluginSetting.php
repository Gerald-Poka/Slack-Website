<?php

namespace App\Modules\Plugin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PluginSetting extends Model
{
    protected $table = 'plugin_settings';

    protected $fillable = [
        'plugin_id',
        'key',
        'value',
        'type',
    ];

    public function plugin(): BelongsTo
    {
        return $this->belongsTo(Plugin::class, 'plugin_id');
    }
}
