<?php

namespace App\Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;

class Plugin extends Model
{
    protected $fillable = [
        'name',
        'label',
        'icon',
        'version',
        'entry_class',
        'status',
    ];
}
