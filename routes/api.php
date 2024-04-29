<?php

use App\Http\Controllers\FiliereController;
use App\Http\Controllers\ModuleController;
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

Route::get('filiere',[FiliereController::class,'index']);

Route::post('filiere/create',[FiliereController::class,'store']);
Route::put('filiere/edit/{filiere}',[FiliereController::class,'update']);
Route::delete('filiere/{filiere}',[FiliereController::class,'delete']);


Route::get('module',[ModuleController::class,'index']);

Route::post('module/create',[ModuleController::class,'store']);
Route::put('module/edit/{filiere}',[ModuleController::class,'update']);
Route::delete('module/{filiere}',[ModuleController::class,'delete']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
