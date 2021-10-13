<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    
    public function create(Request $request)
    {
        $user = User::create($request->except('password') + [
            'password' => Hash::make($request->password)
        ]);
        return response()->json(['user' => $user]);
    }

    public function update(Request $request)
    {
        
    }

}
