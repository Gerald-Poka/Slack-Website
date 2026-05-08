<?php

namespace App\Modules\Media\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['filename', 'path', 'mime_type', 'size', 'disk', 'alt_text'];
}
