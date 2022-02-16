<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\UserController;
use App\Models\Catalog;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('login', [ApiController::class, 'login']);
Route::post('register', [ApiController::class, 'register']);

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::resource('catalogs', CatalogController::class);
    Route::resource('folders', FolderController::class);
    Route::resource('users', UserController::class);
});
