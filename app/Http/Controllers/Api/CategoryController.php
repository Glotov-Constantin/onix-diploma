<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Category::query()->select([
            'categories.id',
            'categories.name',
            'categories.description'
        ]);

        return CategoryResource::collection($query
            ->groupBy('categories.id')
            ->paginate(10));
    }

    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    public function store(Request $request)
    {
        $category= new Category();
        $category->name=$request->name;
        $category->description=$request->description;
        $category->save();
        if ($category){
            return response()->json('Category created', 200);
        }
        else{
            return response()->json('Created category has been failed');
        }
    }

    public function update(Request $request)
    {
        $category=Category::find($request->id);
        $category->name=$request->name;
        $category->description=$request->description;

        $category->save();
        if ($category){
            return response()->json('Category updated', 200);
        }
        else{
            return response()->json('Update has been failed');
        }
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json('The category was deleted', 200);
    }
}
