<?php

namespace App\Modules\CMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ContentTag extends Model
{
    protected $table = 'content_tags';

    protected $fillable = [
        'name',
        'slug',
        'color',
    ];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(ContentPost::class, 'content_post_tags', 'tag_id', 'post_id');
    }
}
