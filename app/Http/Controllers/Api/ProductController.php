<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\categoryResource;
use App\Http\Resources\productResource;
use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class ProductController extends Controller
{
    //
    public function addProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' =>'required',
            'price' =>'required',
            'description' =>'required',
            'category' =>'required',
            'image' =>'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $product = new product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->product_id = $request->product_id;
        $product->image = $request->image;
        $product->user_id = $request->user_id;
        if($product->save()){
            return new productResource($product);
        }
        else
        {
            return response()->json(['error' => 'Something went wrong'], 401);
        }
    }

    public function addCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories',
            'description' => 'required',
        ]);
    
        if ($validator->fails()) {
            $errors = $validator->errors();
            $errorResponse = [];
    
            if ($errors->has('name')) {
                $errorResponse['name'] = $errors->first('name');
            }
    
            if ($errors->has('description')) {
                $errorResponse['description'] = $errors->first('description');
            }
    
            return response()->json(['status' => '400', 'errors' => $errorResponse]);
        }
        $category = new category();
        $category->name = $request->name;
        $category->description = $request->description;
        if($category->save()){
            return new categoryResource($category);
        }
        else
        {
            return response()->json(['error' => 'Something went wrong'], 401);
        }   
    }

    public function getAllCategories()
    {
        $category = category::all();
        return categoryResource::collection($category);
    }
}
