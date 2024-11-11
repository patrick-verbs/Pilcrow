<?php

use App\Http\Controllers\UnzipController;
use App\Http\Controllers\EbookController;
use App\Http\Controllers\ViewController;
// use App\Http\Controllers\ZipController;
use Illuminate\Support\Facades\Route;

// header('Access-Control-Allow-Origin:  *');
// header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
// header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization'); 

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

Route::get('/', [UnzipController::class, 'index'])->name('index');

Route::post('/upload-zip', [UnzipController::class, 'upload'])->name('upload');
// Route::post('/read-zip', [ZipController::class, 'readZipFile']);

Route::get('show', [UnzipController::class, 'show'])->name('show');

Route::get('/upload-epub', function () {
    return view('ebook.upload');
});

Route::post('/show-epub', [EbookController::class, 'show']);

Route::get('ebook.read', [ViewController::class, 'showReadView'])->name('showReadView');