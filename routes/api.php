<?php

use App\Http\Controllers\Api\V1\TourController;
use App\Http\Controllers\Api\V1\TravelController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::get('/travels', [TravelController::class, 'index']);
    Route::get('/travels/{travel:slug}/tours', [TourController::class, 'index']);
    Route::post('/login', LoginController::class);
    Route::prefix('admin')->middleware(['auth:sanctum', RoleMiddleware::class.':admin'])->group(function () {
        Route::post('travels', [TravelController::class, 'store']);
    });
});// :admin is the parameter to that alias
