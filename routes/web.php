<?php

use App\Http\Controllers\FilesController;
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
    Route::post('/files/upload', [FilesController::class, 'store'])->name('files.upload');
});
// Route::get('/view/{short_url}', [FilesController::class, 'getFile'])->name('files.get');

Route::get('/info', function () {
    phpinfo();
});
Route::get('/download/{short_url}', [FilesController::class, 'download'])->name('files.download');
Route::get('/view/{short_url}', [FilesController::class, 'view'])->name('files.view');

require __DIR__.'/auth.php';
