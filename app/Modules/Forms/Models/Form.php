<?php

namespace App\Modules\Forms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Form extends Model
{
    protected $table = 'forms';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'fields',
        'recipient_emails',
        'success_message',
        'redirect_url',
        'is_active',
        'recaptcha_enabled',
        'honeypot_enabled',
        'submissions_count',
    ];

    protected $casts = [
        'fields' => 'json',
        'recipient_emails' => 'json',
        'is_active' => 'boolean',
        'recaptcha_enabled' => 'boolean',
        'honeypot_enabled' => 'boolean',
        'submissions_count' => 'integer',
    ];

    public function submissions(): HasMany
    {
        return $this->hasMany(FormSubmission::class, 'form_id');
    }
}
