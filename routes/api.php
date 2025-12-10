<?php

use App\Http\Controllers\InternshipController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VacanceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return response()->json([
        'table' => 'users',
        'data' => DB::table('users')->select('id', 'name', 'email')->get()
    ]);
});

Route::controller(UserController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::post('/forgot-password', 'forgotPassword');
    Route::post('/verify-token', 'verifyToken');
    Route::post('/reset-password', 'resetPassword');
    Route::prefix('user')->group(function () {
        Route::get('/{id}', 'getUserDetails');
    });
    Route::post('/logout', 'logout');
});

Route::controller(InternshipController::class)->group(function () {
    Route::prefix('internship')->group(function () {
        Route::post('/list', 'getAllInternships'); // Listar Estágios
        Route::get('/{id}', 'getInternshipById'); // Buscar Estágio por ID / Acompanhar Estágio
        Route::post('/', 'storeInternship'); // Cadastrar Estágio
        Route::put('/{id}', 'updateInternship'); // Atualizar Estágio
        Route::post('/update-status', 'updateInternshipStatus'); // Atualizar Status do Estágio
        Route::post('/submit-docs', 'submitInternshipDocs');// Submeter Documentação
    });
});


Route::controller(VacanceController::class)->group(function () {
    Route::prefix('vacance')->group(function () {
        Route::post('/list', 'getAllVacancies');
        Route::get('/{id}', 'getVacanceById');
        Route::post('/', 'storeVacance');
        Route::put('/{id}', 'updateVacance');
        Route::delete('/{id}', 'deleteVacance');
    });
});
