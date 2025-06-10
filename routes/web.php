<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard/1');
});

Route::get('/dashboard/{id}', 'App\Http\Controllers\DashboardController@show');

// Rota para visualizar dados da API em JSON
Route::get('/api/dados/{id}', 'App\Http\Controllers\DashboardController@verDados');
