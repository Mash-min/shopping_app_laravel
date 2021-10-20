<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProductCategory;
use App\Models\Product;

use Illuminate\Http\Request;

class ProductCategoriesController extends Controller
{
    
    public function create(Request $request)
    {
        foreach($request->slug as $slug) 
        {
            $category = Category::where(['slug' => $slug])->first();
            ProductCategory::create([
                'product_id' => $request->product_id,
                'category_id' => $category->id
            ]);
        }
    }

}
