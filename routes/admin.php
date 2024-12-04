<?php

use App\Http\Controllers\AdminListController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrendController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'profile'], function(){
    Route::get('/', [ProfileController::class, 'index'])->name('profile');
    Route::post('update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('changepassword', [ProfileController::class, 'changepasswordForm'])->name('profile.changepassword');
    Route::post('changepassword', [ProfileController::class, 'changepassword']);
});

Route::group(['prefix' => 'adminlist'], function(){
    Route::get('/', [AdminListController::class, 'index'])->name('adminlist');
    Route::get('/delete/{id}', [AdminListController::class, 'delete'])->name('adminlist.delete');
});

Route::group(['prefix' => 'category'], function(){
    Route::get('/', [CategoryController::class, 'index'])->name('category');
    Route::post('/create', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/updateForm/{id}', [CategoryController::class, 'updateForm'])->name('category.updateForm');
    Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
});

Route::group(['prefix' => 'post'], function(){
    Route::get('/', [PostController::class, 'index'])->name('post');
    Route::post('/create', [PostController::class, 'create'])->name('post.create');
    Route::get('/delete/{id}', [PostController::class, 'delete'])->name('post.delete');
    Route::get('/editForm/{id}', [PostController::class, 'editForm'])->name('post.editForm');
    Route::post('/edit/{id}', [PostController::class, 'edit'])->name('post.edit');

});

Route::group(['prefix' => 'trends'], function(){
    Route::get('/', [TrendController::class, 'index'])->name('trends');
    Route::get('/details/{id}', [TrendController::class, 'details'])->name('trends.details');
});



