<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorResponse = [];
    
            if ($errors->has('name')) {
                $errorResponse['name'] = $errors->first('name');
            }
    
            if ($errors->has('email')) {
                $errorResponse['email'] = $errors->first('email');
            }
    
            if ($errors->has('password')) {
                $errorResponse['password'] = $errors->first('password');
            }
    
            return response()->json(['status' => '400', 'errors' => $errorResponse]);
        }    
        $user = User::where('email',$request->get('email'))->first();
        if(!$user)
        {
            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' =>Hash::make($request->get('password')),
            ]);
        }
        else
        {
            return response()->json(['status' => '200', 'message' =>"users already exist"]);
        }
        return response()->json($user, 201);
    }
}
