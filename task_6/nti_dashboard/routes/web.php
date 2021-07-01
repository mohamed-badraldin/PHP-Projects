<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\home\HomeController;
use App\Http\Controllers\dashboard\products\ProductController;

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
    // return view('auth.login');
    // return redirect()->route('login');
    return view('welcome');
})->middleware('auth');

Route::group(['prefix'=>'dashboard','middleware'=>'verified'],function(){
    Route::get('/',[HomeController::class,'index'])->name('home');
    Route::resource('products', ProductController::class)->middleware('password.confirm');
});



// Route::get('all-products',[ProductController::class,'index']);

// Route::get('add-products',[ProductController::class,'create']);
// Route::post('add-products',[ProductController::class,'add']);


// Route::get('edit-products',[ProductController::class,'edit']);
// Route::put('edit-products',[ProductController::class,'update']);

// Route::delete('delete-product',[ProductController::class,'destory']);

Auth::routes(['verify' => true]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
