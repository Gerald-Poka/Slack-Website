<?php

namespace App\Modules\Plugin\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plugin extends Model
{
    protected $table = 'plugins';

    protected $fillable = [
        'name',
        'label',
        'description',
        'version',
        'author',
        'author_url',
        'homepage_url',
        'icon',
        'requires',
        'entry_class',
        'manifest',
        'status',
        'error_message',
        'installed_at',
        'activated_at',
    ];

    protected $casts = [
        'requires' => 'json',
        'manifest' => 'json',
        'installed_at' => 'datetime',
        'activated_at' => 'datetime',
    ];

    public function settings(): HasMany
    {
        return $this->hasMany(PluginSetting::class, 'plugin_id');
    }
}
