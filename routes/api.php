<?php

use App\Http\Controllers\SmppCpntroller;
use App\Http\Controllers\SmsController;
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
Route::group(['namespace' => 'api\v1', 'prefix' => 'v1'], function () {
    Route::get('send', [SmsController::class, 'send']);

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
