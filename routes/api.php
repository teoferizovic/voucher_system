<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VoucherController;

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

Route::group(['prefix' => 'vouchers'], function () {
	Route::post('/', [VoucherController::class, 'create']);
	Route::get('/{id?}', [VoucherController::class, 'index']);
    Route::put('/{code}', [VoucherController::class, 'update']);
    Route::delete('/{code}', [VoucherController::class, 'delete']);
});
