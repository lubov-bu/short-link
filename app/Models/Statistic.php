<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Statistic extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'link_id',
        'ip_address',
        'user_agent',
        'created_at'
    ];

    public function links(): BelongsTo
    {
        return $this->belongsTo(Link::class);
    }
}
