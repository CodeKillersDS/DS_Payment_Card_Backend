<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\SmsController;

//with resource controller
use App\Http\Controllers\PayControllerRe;

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

//get route
//Route::get('list' , [PayController::class , 'list']);

//post route
Route::post('add' , [PayController::class , 'add']);

//put route
//Route::put('update' , [PayController::class , 'update']);

//search route
//Route::get('search/{name}' , [PayController::class , 'search']);

//delete route
//Route::delete('delete/{id}' , [PayController::class , 'delete']);



