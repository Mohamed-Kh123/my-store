<?php

use App\Http\Controllers\Api\Admin\ProductsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartContrtoller;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\PersonalAccessToken;

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







Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('/cart', CartContrtoller::class);
    Route::post('/checkout', [CheckoutController::class, 'store']);
    Route::get('/product/{slug}', [ProductController::class, 'show']);
    
    Route::get('/orders', [CheckoutController::class, 'index'])->name('orders');
    Route::delete('/order/{id}', [CheckoutController::class, 'destroy'])->name('order.delete');
});



Route::get('/test', function(){
    // $user = Auth::user();

    $user = PersonalAccessToken::findToken("6|MyXGd1hNjaNUhbJodmlusRRDVKVfbWUHW2eaKHRB");

    return $user->id;
});
