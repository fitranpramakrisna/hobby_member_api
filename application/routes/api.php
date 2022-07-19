<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\HobbyController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\VerificationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/register', [AuthController::class, 'register']);

Route::post('/hobby/create', [HobbyController::class, 'store'])->middleware('verified');
Route::post('/hobby/update/{id}', [HobbyController::class, 'update'])->middleware('verified');
Route::get('/hobby', [HobbyController::class, 'index'])->middleware('verified');

Route::get('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
