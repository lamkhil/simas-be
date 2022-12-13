<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/kualitas')->group(function () {
        Route::post('/add', [AdminController::class, 'store']);
        Route::post('/update', [AdminController::class, 'update']);
        Route::post('/delete', [AdminController::class, 'delete']);
    });
});

Route::get('/kualitas',[DashboardController::class, 'kualitas']);

Route::prefix('/beranda')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/upper', [DashboardController::class, 'upper']);
    Route::get('/middle', [DashboardController::class, 'middle']);
    Route::get('/bottom', [DashboardController::class, 'bottom']);
});
Route::prefix('/titik-pantau')->group(function () {
    Route::get('/', [DashboardController::class, 'titikPantau']);
});

Route::get('/', function (Request $request) {
    return response([
        "message" => "Bismillah!!!"
    ]);
});

Route::get('/register', [AdminController::class, 'register']);
Route::post('/login', [AdminController::class, 'login']);
