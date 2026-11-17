<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsappMessage extends Model
{
    protected $fillable = ['wa_message_id', 'chat_id', 'phone', 'name', 'type', 'body', 'received_at'];

    protected $casts = ['received_at' => 'datetime'];
}
