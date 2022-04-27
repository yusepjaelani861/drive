<?php

use App\Http\Controllers\FilesController;
use App\Http\Controllers\PostController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => 'auth'], function (){
    Route::get('/files', [FilesController::class, 'index'])->name('files.index');
    Route::get('/files/list', [FilesController::class, 'list'])->name('files.list');
    Route::post('/files/upload', [FilesController::class, 'multistore'])->name('files.upload');
    Route::post('/files/delete/{short_url}', [FilesController::class, 'delete'])->name('files.delete');

    // Blog Post
    Route::get('/post/create', [PostController::class, 'create_page'])->name('post.create');
    Route::post('/post/create', [PostController::class, 'create'])->name('create.post');
});

Route::get('/view/{short_url}', [FilesController::class, 'view'])->name('files.view');
Route::get('/get/{short_url}', [FilesController::class, 'get'])->name('files.get');
Route::get('/embed/{short_url}', [FilesController::class, 'embed'])->name('files.embed');

require __DIR__.'/auth.php';
