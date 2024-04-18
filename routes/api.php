<?php

use App\Http\Controllers\PendudukController;
use App\Http\Controllers\wargaAsliController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/v1')->group(function(){

    Route::get('/wargaAsli', [wargaAsliController::class, 'fetchAll'])->name("wargaAsli.fetchAll");
    Route::post('/wargaAsli/store-warga-asli', [wargaAsliController::class, 'simpan'])->name("wargaAsli.store");
    Route::get('/wargaAsli/store-warga-asli', [wargaAsliController::class, 'fetchAll'])->name("wargaAsli.store-get");
});