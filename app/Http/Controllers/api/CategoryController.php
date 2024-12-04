<?php

namespace App\Http\Controllers\api;

use Exception;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index(){
        try{
            $categories = Category::select('category_id', 'title')->get();
            return response()->json([
                'categories' => $categories,
                'status' => 200
            ],200);
        }catch(Exception $e){
            return response()->json([
                'error' => $e,
                'status' => 500
            ],500);
        }
    }

    public function search(Request $request){
        try{
            if ($request->category_id != 'all'){
                $searchData = Post::where('category_id',$request->category_id)->get();
                return response()->json([
                    'searchData' => $searchData,
                    'status' => 200
                ],200);
            }else{
                $searchData = Post::all();
                return response()->json([
                    'searchData' => $searchData,
                    'status' => 200
                ],200);
            }
        }catch(Exception $e){
            return response()->json([
                'error' => $e,
                'status' => 500
            ],500);
        }
    }
}
