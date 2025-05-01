<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\MutasiController;


Route::prefix('user')->middleware('auth:api')->group(function () {
    Route::get('/list', [UserController::class, 'index']);       
    Route::get('/{id}', [UserController::class, 'show']);        
    Route::post('/create', [UserController::class, 'store']);     
    Route::put('/update/{id}', [UserController::class, 'update']); 
    Route::delete('/delete/{id}', [UserController::class, 'destroy']); 
});

Route::prefix('barang')->middleware('auth:api')->group(function () {
    Route::get('/list', [BarangController::class, 'index']);  
    Route::get('/{id}', [BarangController::class, 'show']);  
    Route::post('/', [BarangController::class, 'store']);  
    Route::put('/{id}', [BarangController::class, 'update']);   
    Route::delete('/{id}', [BarangController::class, 'destroy']);
});

Route::prefix('mutasi')->middleware('auth:api')->group(function () {
    Route::get('/list', [MutasiController::class, 'index']);       
    Route::get('/{id}', [MutasiController::class, 'show']);        
    Route::post('/create', [MutasiController::class, 'store']);     
    Route::put('/update/{id}', [MutasiController::class, 'update']);
    Route::delete('/delete/{id}', [MutasiController::class, 'destroy']); 
});

Route::middleware('auth:api')->get('/barang/{id}/history-mutasi', [BarangController::class, 'historyMutasiBarang']);
Route::middleware('auth:api')->get('/user/history-mutasi', [MutasiController::class, 'historyMutasiUser']);
Route::get('/users/{id}/mutasi-history', [MutasiController::class, 'historyMutasiByUserId']);

Route::post('/register',[AuthController::class,'register']);
Route::post('/login', [AuthController::class, 'login']);
