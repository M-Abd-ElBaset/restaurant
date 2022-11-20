<?php

use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IQsController;

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

//IQ part
Route::get('/countWithoutFive', [IQsController::class, "countNumbersWithoutFive"]);
Route::get('/evaluateString', [IQsController::class, "evaluateString"]);
Route::get('/leastNumberOfSteps', [IQsController::class, "leastNumberOfSteps"]);

//Auth
Route::post('/login', [UsersController::class, 'login'])->name('login');
Route::post('/register', [UsersController::class, 'register'])->name('register');

Route::group(["middleware"=>["auth:sanctum"]], function(){
    Route::post('/logout', [UsersController::class, 'logout']);
    Route::resource("/users", UsersController::class);
});
