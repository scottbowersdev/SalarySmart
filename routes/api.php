<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('categories', 'Api\CategoryController', ['except' => ['create', 'edit']]);

Route::resource('months', 'Api\MonthController', ['except' => ['create', 'edit']]);

Route::resource('payments', 'Api\PaymentController', ['except' => ['create', 'edit']]);

Route::resource('recurring-payments', 'Api\RecurringPaymentController', ['except' => ['create', 'edit']]);

Route::resource('users', 'Api\UserController', ['except' => ['create', 'edit']]);

Route::resource('wishlists', 'Api\WishlistController', ['except' => ['create', 'edit']]);