<?php

use App\Http\Controllers\apis\ProductController;
use App\Http\Controllers\apis\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware'=>'checkAuth'],function(){

    Route::group(['prefix'=>'products'],function () {
        Route::get('all',[ProductController::class,'index']);
        Route::get('create',[ProductController::class,'create']);
        Route::get('{product_id}/edit',[ProductController::class,'edit']);
        Route::delete('{product_id}/delete',[ProductController::class,'delete']);
        Route::post('store',[ProductController::class,'store']);
        Route::post('update/{id}',[ProductController::class,'update']);
    });

    Route::group(['prefix'=>'users'],function(){
        Route::post('register',[UserController::class,'register'])->withoutMiddleware('checkAuth');
        Route::post('login',[UserController::class,'login'])->withoutMiddleware('checkAuth');

        Route::get('send-code',[UserController::class,'sendCode']);
        Route::post('verify-code',[UserController::class,'verifyCode']);
        Route::get('user-profile',[UserController::class,'userProfile']);
        Route::post('update-profile',[UserController::class,'updateProfile']);
        Route::get('logout',[UserController::class,'logout']);
    });

});
