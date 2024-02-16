<?php
use App\Http\Controllers\Auth\LoginRegisterController;

use App\Http\Controllers\BidanController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\ObatController;
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

// Route::put('/mahasiswa2020003/uploadImage/{nim_2020003}', [Mahasiswa2020003Controller::class, 'uploadImage']);





Route::controller(LoginRegisterController::class)->group(function () {
    Route::post('/login', 'login');
    Route::apiResource('bidan', BidanController::class);
    Route::put('/bidan/uploadImage/{idBidan}', [BidanController::class, 'uploadImage']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [LoginRegisterController::class, 'logout']);
    Route::apiResource('bidan', BidanController::class);
    Route::put('/bidan/uploadImage/{idBidan}', [BidanController::class, 'uploadImage']);
    Route::apiResource('pasien', PasienController::class);
    Route::put('/pasien/uploadImage/{noRekamMedis}', [PasienController::class, 'uploadImage']);
    Route::apiResource('obat', ObatController::class);
});
