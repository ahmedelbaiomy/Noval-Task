<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PostController;
use \App\Http\Controllers\CommentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();
Route::get('logout', function(){
    auth()->logout();
    Session()->flush();
    return Redirect::to('/');
})->name('logout');

Route::get('/',[PostController::class,'index'])->name('posts.index');

Route::group(['middleware'=>'auth'],function(){
//    +++++++++++++ posts +++++++++++++
    Route::post('posts/store',[PostController::class,'store'])->name('posts.store');
    Route::get('/posts/{id}',[PostController::class,'show'])->name('posts.show');
    Route::get('posts/edit/{id}',[PostController::class,'edit'])->name('posts.edit');
    Route::post('posts/update/{id}',[PostController::class,'update'])->name('posts.update');
    Route::delete('posts/destroy/{id}',[PostController::class,'destroy'])->name('posts.destroy');
//    +++++++++++++ end posts ++++++++++++
//    +++++++++++++ comments ++++++++++++++++

    Route::get('/comments',[CommentController::class,'index'])->name('comments.index');
    Route::post('/comments/store',[CommentController::class,'store'])->name('comments.store');
    Route::delete('/comments/destroy/{id}',[CommentController::class,'destroy'])->name('comments.destroy');
//    +++++++++++++ comments ++++++++++++++++

});
