<?php

namespace App\Modules\Theme\Models;

use App\Modules\Media\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Theme extends Model
{
    use SoftDeletes;

    protected $table = 'themes';

    protected $fillable = [
        'name',
        'label',
        'description',
        'preview_image_id',
        'is_active',
        'is_default',
        'is_system',
        'version',
        'author',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_default' => 'boolean',
        'is_system' => 'boolean',
    ];

    public function previewImage(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'preview_image_id');
    }

    public function settings(): HasMany
    {
        return $this->hasMany(ThemeSetting::class, 'theme_id');
    }
}
