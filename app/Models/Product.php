<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'in_stock',
        'price',
        'rating'
    ];

    public function ProductImages(){
        return $this->hasMany(ProductImage::class);
    }

    public function Categories(){
        return $this->belongsToMany(Category::class, 'product_categories', 'product_id', 'category_id');
    }

    public function applyCategoryByName($categoryName=''){

        ProductCategory::updateOrCreate([
            'product_id' => $this->id,
            'category_id' => Category::firstOrCreate(['name' => $categoryName])->id,
        ]);
    }

    /**
     * @param Builder $query
     * @param $sortBy
     */
    public function scopeWhereSortBy($query, $sortBy){
        if ($sortBy == 'rating'){
            $query->orderBy('rating', 'DESC');
        }
    }

// !Dab!    public function scopeSortBy($query, $sortBy){
//        $query->orderBy($sortBy, 'DESC');
//    }
//
//    public function scopeSortByRating(){
//        return $this->orderBy('rating', 'DESC');
//    }

    /**
     * @param Builder $query
     * @param $category_ids
     */

    public function scopeWhereCategory_ids($query, $category_ids){
        if(!empty($category_ids) && is_string($category_ids)){
            $query->where('product_categories.category_id' ,'=', $category_ids);
        }
    }
}
