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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);

Route::get('/companies', [CompanyController::class, 'index']);
Route::get('/companies/{id}', [CompanyController::class, 'show']);

Route::resource('contacts', ContactController::class);

Route::get('/leads', [LeadController::class, 'index']);
Route::get('/leads/{id}', [LeadController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('users', UserController::class)->except(['index', 'show']);
    Route::resource('leads', LeadController::class)->except(['index', 'show']);
    Route::resource('contacts', ContactController::class)->except(['index', 'show']);
    Route::resource('companies', CompanyController::class)->except(['index', 'show']);
});

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class)->only(['destroy']);
    Route::resource('companies', CompanyController::class)->only(['destroy']);
    Route::resource('contacts', ContactController::class)->only(['destroy']);
    Route::resource('leads', LeadController::class)->only(['destroy']);
});

Route::middleware('auth:sanctum')->get('/dashboard-stats', [DashboardController::class, 'getStats']);
