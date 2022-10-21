<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * @property Product[] $Products
 */

class Order extends Model
{
    use HasFactory;

    public function Products(){
        return $this->hasMany(OrderItem::class, 'order_id', 'orders.id');
    }

}
