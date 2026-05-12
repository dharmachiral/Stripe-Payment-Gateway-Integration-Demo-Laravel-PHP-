<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'email',
        'product_id',
        'quantity',
        'amount',
        'payment_status',
        'stripe_payment_intent',
    ];
    public function product()
{
    return $this->belongsTo(Product::class);
}
}
