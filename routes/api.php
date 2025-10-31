<?php

use App\Http\Controllers\InternshipController;
use App\Http\Controllers\UserController;
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
});

Route::controller(InternshipController::class)->group(function () {
    Route::prefix('internship')->group(function () {
        Route::get('/', 'getAllInternships'); // Listar Estágios
        Route::get('/{id}', 'getInternshipById'); // Buscar Estágio por ID
        Route::post('/', 'storeInternship'); // Cadastrar Estágio
        Route::put('/{id}', 'updateInternship'); // Atualizar Estágio
        Route::post('/update-status', 'updateInternshipStatus'); // Atualizar Status do Estágio
        // Submeter Documentação
        // Acompanhar Estágio
    });
});
