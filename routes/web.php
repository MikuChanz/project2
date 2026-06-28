<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SinnersController;
use App\Http\Controllers\AuthController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/sinners', [SinnersController::class,'list']);
Route::get('/sinners/create', [SinnersController::class,'create']);
Route::get('/sinners/put', [SinnersController::class,'put']);
Route::get('/sinners/update/{sinners}', [SinnersController::class,'update']);
Route::post('/sinners/patch/{sinners}', [SinnersController::class,'patch']);
Route::post('/sinners/delete{sinners}', [SinnersController::class,'delete']);

//authentication
Route::get('/login', [AuthController::class,'login'])->name('login');
Route::post('/auth', [AuthController::class,'authenticate']);
Route::get('/logout', [AuthController::class,'logout']);