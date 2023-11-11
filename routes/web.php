<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\SendEmailController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\GalleryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// buat auth
Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/users', 'index')->name('users');
    // Route::delete('/users/{id}', 'deletePhoto')->name('delete.photo');
    Route::delete('/users/{id}', 'destroy')->name('user.destroy');
    Route::put('/users/{id}', 'update')->name('user.update');
    Route::get('/users/{id}', 'edit')->name('user.edit');
});

//buat email
Route::get('/send-mail', [SendEmailController::class,
            'index'])->name('kirim-email');
Route::post('/post-email', [SendEmailController::class,
            'store'])->name('post-email');

// buat upload file
Storage::disk('local')->put('file.txt', 'Contents');

// gallery
Route::resource('gallery', GalleryController::class);
