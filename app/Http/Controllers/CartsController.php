<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;

class CartsController extends Controller
{

    public function create(Request $request)
    {   
        if(!User::find($request->user_id)->alreadyInCart($request->product_id)) {
            $cart = Cart::create($request->all());
            return response()->json(['cart' => $cart]);
        }else {
            return response()->json(['message' => 'Product already in Cart'], 400);
        }
    }

    public function delete($id)
    {
        Cart::findOrFail($id)->delete();
        return response()->json(['message' => 'Cart deleted']);
    }

    public function carts($id)
    {
        $cart = User::findOrFail($id)->carts()
                                     ->orderBy('created_at', 'ASC')
                                     ->with('product')
                                     ->paginate(8);
        return response()->json(['cart' => $cart]);
    }

}
