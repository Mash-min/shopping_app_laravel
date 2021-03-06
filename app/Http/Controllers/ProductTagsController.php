<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductTag;

class ProductTagsController extends Controller
{
    
    public function create(Request $request)
    {
        $productTag = ProductTag::create($request->all());
        return response()->json(['product-tag' => $productTag]);
    }

}
