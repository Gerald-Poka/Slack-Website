<?php

namespace App\Modules\PageBuilder\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title', 'slug', 'status', 'meta_title', 'meta_description'];

    public function sections()
    {
        return $this->hasMany(Section::class)->orderBy('sort_order');
    }
}
