<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query()->select([
            'products.id',
            'products.name',
            'products.description',
            'products.in_stock',
            'products.rating'
        ]);
        if ($request->has('category_ids')){
            $categoriesIds=explode(',', $request->get('category_ids'));
            $query->rightJoin('product_categories', 'product_categories.product_id', '=', 'products.id')
            ->whereIn('product_categories.category_id', $categoriesIds);
        }
        $query->whereSortBy($request->get('sort_by', ''));

        return ProductResource::collection($query
            ->paginate(18));
    }

    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    public function store(StoreProductRequest $request)
    {
        $product= new Product();
        $product->name=$request->name;
        $product->description=$request->description;
        $product->in_stock=$request->in_stock;
        $product->rating=$request->rating;
        if ($request->has('category')){
            $product->applyCategoryByName($request->get('category'));
        }
        $product->save();
        if ($product){
            return response()->json('Product created', 200);
        }
        else{
            return response()->json('Product has been failed');
        }
    }

    public function update(StoreProductRequest $request, Product $product)
    {
        $product->name=$request->name;
        $product->description=$request->description;
        $product->in_stock=$request->in_stock;
        $product->rating=$request->rating;
        $product->save();
        if ($product){
            return response()->json('Product updated', 200);
        }
        else{
            return response()->json('Update has been failed');
        }
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json('The product was deleted', 200);
    }
}
