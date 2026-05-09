<?php

namespace App\Modules\CMS\Models;

use App\Modules\Auth\Models\User;
use App\Modules\Media\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContentPost extends Model
{
    use SoftDeletes;

    protected $table = 'content_posts';

    protected $fillable = [
        'author_id',
        'category_id',
        'featured_image_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'content_type',
        'status',
        'is_featured',
        'is_sticky',
        'allow_comments',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'views_count',
        'event_start_at',
        'event_end_at',
        'event_location',
        'expires_at',
        'published_at',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_sticky' => 'boolean',
        'allow_comments' => 'boolean',
        'views_count' => 'integer',
        'event_start_at' => 'datetime',
        'event_end_at' => 'datetime',
        'expires_at' => 'datetime',
        'published_at' => 'datetime',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ContentCategory::class, 'category_id');
    }

    public function featuredImage(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'featured_image_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(ContentTag::class, 'content_post_tags', 'post_id', 'tag_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(ContentComment::class, 'post_id');
    }
}
