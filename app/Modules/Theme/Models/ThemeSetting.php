<?php

namespace App\Modules\Theme\Models;

use Illuminate\Database\Eloquent\Model;

class ThemeSetting extends Model
{
    protected $fillable = ['theme_id', 'key', 'value', 'type'];

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
}
