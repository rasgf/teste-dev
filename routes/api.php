<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;

Route::get('/contatos', [UsuarioController::class, 'listarContatos']);
Route::post('/contatos', [UsuarioController::class, 'registrarContato']);
Route::put('/api/contatos/{contato}', [UsuarioController::class, 'atualizarContato']);
Route::delete('/contatos/{contato}', [UsuarioController::class, 'deletarContato']);