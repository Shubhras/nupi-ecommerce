<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'full_name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'country',
        'zip_code',
        'subtotal',
        'shipping',
        'tax',
        'total',
        'payment_method',
        'payment_status',
        'card_last4'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
