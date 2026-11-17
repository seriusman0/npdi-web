<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    public const UPDATED_AT = null;

    protected $fillable = ['path', 'referrer', 'visitor_id', 'user_agent', 'ip_hash', 'created_at'];

    protected $casts = ['created_at' => 'datetime'];
}
