<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToDoController;

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

Route::resource('/', ToDoController::class);
Route::get('/show', [ToDoController::class, 'show']);
Route::get('/counttask', [ToDoController::class, 'counttask']);
Route::get('/show/status/{id}', [ToDoController::class, 'showByStatus']);
Route::post('/store', [ToDoController::class, 'store']);
Route::post('/update/task/{id}', [ToDoController::class, 'updatebyid']);
Route::post('/update/{id}', [ToDoController::class, 'update']);
Route::post('/delete/{id}', [ToDoController::class, 'destroy']);
Route::post('/destroy/completed', [ToDoController::class, 'destroyCompleted']);
