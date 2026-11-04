<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_id',
        'product_slug',
        'plan_slug',
        'customer_name',
        'customer_email',
        'customer_phone',
        'amount',
        'status',
        'xendit_invoice_id',
        'xendit_invoice_url',
        'xendit_payload',
        'paid_at',
        'provisioned',
        'temp_password',
    ];

    protected $casts = [
        'xendit_payload' => 'array',
        'paid_at' => 'datetime',
        'temp_password' => 'encrypted',
    ];

    protected $hidden = ['temp_password'];
}
