<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SinnersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IDsController;
use App\Http\Controllers\AssociationController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/sinners', [SinnersController::class, 'list']);
Route::get('/sinners/create', [SinnersController::class, 'create']);
Route::post('/sinners/put', [SinnersController::class, 'put']);
Route::get('/sinners/update/{sinners}', [SinnersController::class, 'update']);
Route::post('/sinners/patch/{sinners}', [SinnersController::class, 'patch']);
Route::post('/sinners/delete/{sinners}', [SinnersController::class, 'delete']);

//authentication
Route::get('/login', [AuthController::class,'login'])->name('login');
Route::post('/auth', [AuthController::class,'authenticate']);
Route::get('/logout', [AuthController::class,'logout']);

// ID routes
Route::get('/ids', [IDsController::class, 'list']);
Route::get('/ids/create', [IDsController::class, 'create']);
Route::post('/ids/put', [IDsController::class, 'put']);
Route::get('/ids/update/{ids}', [IDsController::class, 'update']);
Route::post('/ids/patch/{ids}', [IDsController::class, 'patch']);
Route::post('/ids/delete/{ids}', [IDsController::class, 'delete']);

// Association routes

Route::get('/associations', [AssociationController::class, 'list']);
Route::get('/associations/create', [AssociationController::class, 'create']);
Route::post('/associations/put', [AssociationController::class, 'put']);
Route::get('/associations/update/{association}', [AssociationController::class, 'update']);
Route::post('/associations/patch/{association}', [AssociationController::class, 'patch']);
Route::post('/associations/delete/{association}', [AssociationController::class, 'delete']);