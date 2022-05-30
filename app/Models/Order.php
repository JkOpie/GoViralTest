<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'reference_no',
        'tax',
        'service_charge',
        'total_amount_cents',
        'status',
    ];

    public function order_items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'order_id', 'id');
    }

}
