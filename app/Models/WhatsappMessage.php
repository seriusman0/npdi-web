<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsappMessage extends Model
{
    protected $fillable = [
        'wa_message_id',
        'direction',
        'chat_id',
        'phone',
        'name',
        'type',
        'body',
        'received_at',
        'ai_draft',
        'ai_model',
        'draft_token',
        'auto_send_at',
        'clicked_at',
        'auto_sent_at',
    ];

    protected $casts = [
        'received_at' => 'datetime',
        'auto_send_at' => 'datetime',
        'clicked_at' => 'datetime',
        'auto_sent_at' => 'datetime',
    ];
}
