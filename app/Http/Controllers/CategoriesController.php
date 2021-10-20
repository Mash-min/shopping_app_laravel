<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function create(Request $request)
    {
        $category = Category::create($request->all());
        return response()->json(['category' => $category]);
    }

    public function delete($slug) 
    {
        Category::where(['slug' => $slug])->first()->delete();
        return response()->json(['message' => 'Category deleted']);
    }

    public function update(Request $request, $slug) 
    {
        $category = Category::where(['slug' => $slug])->first()->update($request->all());
        return response()->json(['category' => $category]);
    }
    
    public function categories($paginate)
    {
        $categories = Category::orderBy('created_at', 'ASC')->paginate($paginate);
        return response()->json(['categories' => $categories]);
    }
}
