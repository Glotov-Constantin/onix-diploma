<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Product extends Model
{
    use HasFactory;

    public function ProductImages(){
        return $this->hasMany(ProductImage::class);
    }

    public function Category(){
//        return $this->hasManyThrough(Category::class, ProductCategory::class, 'product_categories.product_id', 'product_categories.category_id', 'products.id', 'categories.id');
        return Category::query()
            ->select(['categories.*'])
            ->rightJoin('product_categories','categories.id','=','product_categories.category_id')
            ->where('product_categories.product_id',$this->id);
    }

    public function applyCategoryByName($categoryName=''){
        $category=ProductCategory::query()->where('product_categories.category_id', $categoryName)->get()->first();
        if (empty($category)){
            $category=new Category();
            $category->name=$categoryName;
            $category->save();
        }
        $this->categories()->save($category);
        $this->save();
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
