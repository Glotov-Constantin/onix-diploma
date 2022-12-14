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

    public function __construct()
    {
        $this->authorizeResource(Product::class);
    }

    public function index(Request $request)
    {
        $query = Product::query()->with('categories');
        if ($request->has('category_ids')){
            $categoriesIds=explode(',', $request->get('category_ids'));
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
        $product = new Product();
// !Dab!        $product = Product::created($request->validated());
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->in_stock = $request->in_stock;
        $product->rating = $request->rating;
        $product->save();
        if ($request->has('category')) {
            $product->applyCategoryByName($request->get('category'));
        }
        if ($request->has('category_ids')) {
            $product->categories()->sync($request->get('category_ids'));
        }
//        return $productService->create($request->validated());
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
        $product->price = $request->price;
        $product->rating=$request->rating;

        if ($request->has('category')) {
            $product->applyCategoryByName($request->get('category'));
        }
        if ($request->has('category_ids')) {
            $product->categories()->sync($request->get('category_ids'));
        }
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
