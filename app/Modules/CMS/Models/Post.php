<?php

namespace App\Modules\CMS\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'status', 'author_id'];
}
