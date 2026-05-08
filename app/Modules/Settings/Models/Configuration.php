<?php

namespace App\Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = ['group', 'key', 'value', 'type', 'is_public'];
}
