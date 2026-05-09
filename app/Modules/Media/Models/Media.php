<?php

namespace App\Modules\Media\Models;

use App\Modules\Auth\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;

    protected $table = 'media';

    protected $fillable = [
        'folder_id',
        'filename',
        'original_filename',
        'mime_type',
        'extension',
        'disk',
        'path',
        'url',
        'size',
        'width',
        'height',
        'duration',
        'alt_text',
        'caption',
        'thumbnails',
        'meta',
        'uploader_id',
    ];

    protected $casts = [
        'thumbnails' => 'json',
        'meta' => 'json',
        'size' => 'integer',
        'width' => 'integer',
        'height' => 'integer',
        'duration' => 'integer',
    ];

    public function folder(): BelongsTo
    {
        return $this->belongsTo(MediaFolder::class, 'folder_id');
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploader_id');
    }
}
