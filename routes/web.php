<?php

use App\Http\Controllers\CargoController;
use App\Http\Controllers\ColaboradorController;
use App\Http\Controllers\DesempenhoController;
use App\Http\Controllers\UnidadeController;
use Illuminate\Support\Facades\Route;

Route::controller(UnidadeController::class)->group(function(){
    Route::get('/','show')->name('unidade.show');
    Route::get('unidade/new','new')->name('unidade.new');
    Route::get('unidade/edit/{id}','edit')->name('unidade.edit');
    Route::post('unidade/create','create')->name('unidade.create');
    Route::put('unidade/update','update')->name('unidade.update');
    Route::delete('unidade/delete/{id}','delete')->name('unidade.delete');
});

Route::controller(CargoController::class)->group(function(){
    Route::get('cargo/','show')->name('cargo.show');
    Route::get('cargo/new','new')->name('cargo.new');
    Route::get('cargo/edit/{id}','edit')->name('cargo.edit');
    Route::post('cargo/create','create')->name('cargo.create');
    Route::put('cargo/update','update')->name('cargo.update');
    Route::delete('cargo/delete/{id}','delete')->name('cargo.delete');
});

Route::controller(ColaboradorController::class)->group(function(){
    Route::get('colaborador/','show')->name('colaborador.show');
    Route::get('colaborador/new','new')->name('colaborador.new');
    Route::get('colaborador/edit/{id}','edit')->name('colaborador.edit');
    Route::post('colaborador/create','create')->name('colaborador.create');
    Route::put('colaborador/update','update')->name('colaborador.update');
    Route::delete('colaborador/delete/{id}','delete')->name('colaborador.delete');
});

Route::controller(DesempenhoController::class)->group(function(){
    Route::get('colaborador/desempenho/show','show')->name('colaborador.desempenho.show');
    Route::get('colaborador/{id}/desempenho/new', 'new')->name('colaborador.desempenho.new');
    Route::post('colaborador/{id}/desempenho/create', 'create')->name('colaborador.desempenho.create');
    Route::get('colaborador/{id}/desempenho/edit/{desempenho_id}', 'edit')->name('colaborador.desempenho.edit');
    Route::put('colaborador/{id}/desempenho/update', 'update')->name('colaborador.desempenho.update');
});
