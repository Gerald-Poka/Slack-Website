<?php

namespace App\Modules\Theme\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = ['name', 'label', 'is_active', 'version'];

    public function settings()
    {
        return $this->hasMany(ThemeSetting::class);
    }
}
