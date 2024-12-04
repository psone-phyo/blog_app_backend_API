<?php

namespace App\Http\Controllers\api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class PostController extends Controller
{
    public function index(){
        try{
            $posts = Post::all();
            return response()->json([
                'data' => $posts,
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
            if ($request->searchKey){
                $searchData = Post::where('title', 'like', '%'.$request->searchKey.'%')->get();
                return response()->json([
                    'searchData' => $searchData,
                    'status' => 200
                ],200);
            }else{
                $posts = Post::all();
                return response()->json([
                'searchData' => $posts,
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

    public function details(Request $request){
        try{

            if ($request->id){
                $postdetails = Post::where('post_id', $request->id)->first();
                return response()->json([
                    'details' => $postdetails,
                    'status' => '200'
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
