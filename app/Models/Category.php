<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function Products(){
        return Product::query()
            ->select(['products.*'])
            ->rightJoin('product_categories','products.id','=','product_categories.product_id')
            ->where('product_categories.category_id',$this->id);
    }
}
