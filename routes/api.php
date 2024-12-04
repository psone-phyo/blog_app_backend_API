<?php

// use App\Http\Controllers\client\LoginController;

use App\Http\Controllers\api\ActionLogController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\PostController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\AuthenticationController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::post('user/login', LoginController::class, 'login');
// Route::get('user/', LoginController::class, 'index');

//Auth
Route::post('/user/login', [AuthenticationController::class,'login']);
Route::post('/user/register', [AuthenticationController::class,'register']);

// Route::group(['middleware' => 'auth:sanctum'], function(){

    //posts
    Route::get('/posts', [PostController::class, 'index']);
    Route::post('/posts/search', [PostController::class, 'search']);
    Route::post('/posts/details', [PostController::class, 'details']);
    Route::post('/posts/view', [ActionLogController::class, 'store']);

    //categories
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories/search', [CategoryController::class, 'search']);

// });
