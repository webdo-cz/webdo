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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('cart', [\App\Http\Controllers\Api\CartController::class, 'show']);
Route::post('cart-item/store', [\App\Http\Controllers\Api\CartItemController::class, 'store']);
Route::post('cart-item/update', [\App\Http\Controllers\Api\CartItemController::class, 'update']);
Route::post('cart-item/delete', [\App\Http\Controllers\Api\CartItemController::class, 'delete']);

Route::post('order/fill', [\App\Http\Controllers\Api\OrderController::class, 'fill']);
Route::post('order/submit', [\App\Http\Controllers\Api\OrderController::class, 'submit']);

Route::get('content/page/{name}', [\App\Http\Controllers\Api\ContentController::class, 'page']);
Route::post('content', [\App\Http\Controllers\Api\ContentController::class, 'handle']);

Route::post('contact/store', [\App\Http\Controllers\Api\ContactController::class, 'store']);