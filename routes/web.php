<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\PostController::class, 'index']);

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/post/index-by-author',[PostController::class,'indexByAuthor'])->name('post.indexByAuthor');

Route::get('/post/index-by-unpublisher',[PostController::class,'indexByUnpublisher'])->name('post.indexByUnpublisher');

Route::resource('post',PostController::class);

Route::resource('comment',CommentController::class);
