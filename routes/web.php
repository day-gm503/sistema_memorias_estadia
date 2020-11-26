<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//ruta principal
Route::get('/', function () {
    return view('/login');
});
//ruta para validar usuarios
Route::post('/', 'UsuariosController@login')->name('user.login');
//ruta de inicio
Route::get('/inicio', function () {
    return view('inicio');
});
//ruta de usuarios
Route::get('/usuarios/', function () {
    return view('usuarios');
});
//configuración de usuarios
Route:: group(['prefix'=>'config','as'=>'config'], function(){
    Route::get('/','AdminController@index');
    Route::get('/usuarios','UsuariosController@index');
    Route::post('/usuarios/edit','UsuariosController@editarUsuario');

    Route::resource('usuarios','UsuariosController');
});