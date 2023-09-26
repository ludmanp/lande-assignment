<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;


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

Route::prefix('loan')->group(function (Router $router) {
    $router->post('', \App\Http\Controllers\Loans\CreateController::class)->name('loans.create');
    $router->post('euribor/adjust', \App\Http\Controllers\Loans\EuriborAdjustController::class)
        ->name('loans.euribor.adjust');
});
