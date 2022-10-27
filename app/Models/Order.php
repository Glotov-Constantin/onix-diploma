<?php

namespace App\Models;

use http\Env\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function OrderItem(){
        return $this->hasMany(OrderItem::class, 'order_items', 'order_id', 'product_id');
    }

    public function Products(){
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id');
    }

    public function applyOrderById($orderId=''){

        OrderItem::updateOrCreate([
            'order_id' => $this->id,
            'product_id' => Order::firstOrCreate(['id' => $orderId])->id
        ]);
    }
}
