<?php

namespace App\Modules\CMS\Models;

use App\Modules\Auth\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContentComment extends Model
{
    protected $table = 'content_comments';

    protected $fillable = [
        'post_id',
        'parent_id',
        'user_id',
        'author_name',
        'author_email',
        'content',
        'status',
        'ip_address',
        'user_agent',
    ];

    public function post(): BelongsTo
    {
        return $this->belongsTo(ContentPost::class, 'post_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(ContentComment::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(ContentComment::class, 'parent_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
