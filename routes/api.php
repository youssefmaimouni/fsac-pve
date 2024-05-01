<?php

use App\Http\Controllers\etudiantController;
use App\Http\Controllers\surveillantController;
use App\Http\Controllers\departementController;
use App\Http\Controllers\FiliereController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\PVController;
use App\Http\Controllers\RapportController;
use App\Models\Administrateur;
use App\Models\departement;
use Illuminate\Http\Request;
use App\Http\Controllers\AdministrateurController;
use App\Http\Controllers\controlercontroller;
use App\Http\Controllers\tabletteController;
use App\Http\Controllers\sessionController;
use App\Http\Controllers\ControllerController;
use App\Http\Controllers\gererController;
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
Route::put('module/edit/{module}',[ModuleController::class,'update']);
Route::delete('module/{module}',[ModuleController::class,'delete']);

Route::get('etudiant',[etudiantController::class,'index']);

Route::post('etudiant/create',[etudiantController::class,'store']);
Route::put('etudiant/edit/{etudiant}',[etudiantController::class,'update']);
Route::delete('etudiant/{etudiant}',[etudiantController::class,'delete']);


Route::get('surveillant',[surveillantController::class,'index']);

Route::post('surveillant/create',[surveillantController::class,'store']);
Route::put('surveillant/edit/{surveillant}',[surveillantController::class,'update']);
Route::delete('surveillant/{surveillant}',[surveillantController::class,'delete']);


Route::post('pv/create',[PVController::class,'store']);
Route::put('pv/edit/{pv}',[PVController::class,'update']);
Route::delete('pv/{pv}',[PVController::class,'delete']);

Route::post('rapport/create',[RapportController::class,'store']);
Route::put('rapport/edit/{rapport}',[RapportController::class,'update']);
Route::delete('rapport/{rapport}',[RapportController::class,'delete']);



Route::get('departement',[departementController::class,'index']);

Route::post('departement/create',[departementController::class,'store']);
Route::put('departement/edit/{departement}',[departementController::class,'update']);
Route::delete('departement/{departement}',[departementController::class,'delete']);
 
Route::get('administrateur',[AdministrateurController::class,'index']);
Route::post('administrateur/create',[AdministrateurController::class,'store']);
Route::put('administateur/edit/{administrateur}',[AdministrateurController::class,'update']);
Route::delete('administrateur/{administrateur}',[AdministrateurController::class,'delete']);

Route::get('tablette',[tabletteController::class,'index']);
Route::post('tablette/create',[tabletteController::class,'store']);
Route::put('tablette/edit/{administrateur}',[tabletteController::class,'update']);
Route::delete('tablette/{administrateur}',[tabletteController::class,'delete']) ;

Route::get('gerer',[gererController::class,'index']);
Route::post('gerer/create',[gererController::class,'store']);
Route::put('gerer/edit/{administrateur}',[gererController::class,'update']);
Route::delete('gerer/{administrateur}',[gererController::class,'delete']);


Route::get('controler',[controlercontroller::class,'index']);
Route::post('controler/create',[controlerController::class,'store']);
Route::put('controler/edit/{controler}',[controlerController::class,'update']);
Route::delete('controler/{controler}',[controlerController::class,'delete']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    return $request->user();
});
