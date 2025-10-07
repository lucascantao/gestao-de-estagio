<?php

use App\Http\Controllers\EstagioController;
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
    Route::post('/forgot-password', 'forgotPassword');
    Route::post('/verify-token', 'verifyToken');
    Route::post('/reset-password', 'resetPassword');
});

Route::controller(EstagioController::class)->group(function () {
    Route::prefix('estagio')->group(function () {
        Route::get('/', 'getAllEstagios'); // Listar Estágios
        Route::get('/{id}', 'getEstagioById'); // Buscar Estágio por ID
        Route::post('/', 'storeEstagio'); // Cadastrar Estágio
        Route::put('/{id}', 'updateEstagio'); // Atualizar Estágio
        Route::post('/update-status', 'updateEstagioStatus'); // Atualizar Status do Estágio
        // Submeter Documentação
        // Acompanhar Estágio
    });
});
