<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;

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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

/*Route::get('users', [UserController::class, 'index'])->middleware('auth:sanctum');
Route::get('users/{id}', [UserController::class, 'show']);
Route::post('users', [UserController::class, 'store'])->middleware('auth:sanctum');
Route::put('users/{id}', [UserController::class, 'update'])->middleware('auth:sanctum');
Route::delete('users/{id}', [UserController::class, 'destroy'])->middleware('auth:sanctum');*/

Route::get('companies', [CompanyController::class, 'index']);
Route::get('companies/{id}', [CompanyController::class, 'show']);
Route::post('companies', [CompanyController::class, 'store'])->middleware('auth:sanctum');
Route::put('companies/{id}', [CompanyController::class, 'update'])->middleware('auth:sanctum');
Route::delete('companies/{id}', [CompanyController::class, 'destroy'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {

    Route::get('users', [AuthController::class, 'index']);

    Route::get('contacts', [ContactController::class, 'index']);
    Route::get('contacts/{id}', [ContactController::class, 'show']);
    Route::post('contacts', [ContactController::class, 'store']);
    Route::put('contacts/{id}', [ContactController::class, 'update']);
    Route::delete('contacts/{id}', [ContactController::class, 'destroy']);
    Route::get('leads/user/{userId}', [LeadController::class, 'getLeadsByUserId']);
    Route::get('leads/contact/{contactId}', [LeadController::class, 'getLeadsByContactId']);
    Route::apiResource('leads', LeadController::class);
});
