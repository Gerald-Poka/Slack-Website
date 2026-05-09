<?php

namespace App\Modules\PageBuilder\Models;

use App\Modules\Auth\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PageRevision extends Model
{
    protected $table = 'page_revisions';

    protected $fillable = [
        'page_id',
        'author_id',
        'revision_no',
        'snapshot',
        'change_note',
    ];

    protected $casts = [
        'snapshot' => 'json',
        'revision_no' => 'integer',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
