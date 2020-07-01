<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () { return view('welcome'); });
});

// Rutas para administrador
Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/admin/users', 'AdminController@users')->name('users');
    Route::post('/admin/users/create', 'AdminController@createUser')->name('user-create');
    Route::get('/admin/users/show/{id}', 'AdminController@showUser')->name('user-show');
    Route::post('/admin/users/update', 'AdminController@updateUser')->name('user-update');
    Route::get('/admin/informe', 'AdminController@informe');
});

// Rutas para Proveedores
Route::group(['middleware' => ['permission:proveedores|universal']], function () {
    Route::get('/proveedores/list', 'ProveedoresController@index')->name('proveedores');
    Route::get('/proveedores/create', 'ProveedoresController@index');
    Route::post('/proveedores/create', 'ProveedoresController@create');
    Route::get('/proveedores/show/{id}', 'ProveedoresController@show');
    Route::post('/proveedores/update', 'ProveedoresController@update');
});

// Rutas para Productos
Route::group(['middleware' => ['permission:productos|universal']], function () {
    Route::get('/productos/list', 'ProductosController@index')->name('productos');
    Route::get('/productos/create', 'ProductosController@index');
    Route::post('/productos/create', 'ProductosController@create');
    Route::get('/productos/show/{id}', 'ProductosController@show');
    Route::get('/productos/historial/salidas/{id}', 'ProductosController@historialSalidas');
    Route::get('/productos/historial/entradas/{id}', 'ProductosController@historialEntradas');
    Route::post('/productos/update', 'ProductosController@update');
    Route::post('/productos/delete/proveedor', 'ProductosController@deleteProveedor');
    Route::post('/productos/add/proveedor', 'ProductosController@addProveedor');
});

// Rutas para Salidas
Route::group(['middleware' => ['permission:salidas|universal']], function () {
    Route::get('/salidas/list', 'SalidaController@index')->name('salidas');
    Route::get('/salidas/create', 'SalidaController@index');
    Route::post('/salidas/create', 'SalidaController@create');
    Route::get('/salidas/search/cliente/{id}', 'SalidaController@searchCliente');
    Route::get('/salidas/add/producto/{id}', 'SalidaController@addProducto');
    Route::get('/salidas/show/salida/{id}', 'SalidaController@showSalida');
    Route::get('/salidas/print/{id}', 'SalidaController@printSalida');
});

// Rutas para Entradas
Route::group(['middleware' => ['permission:entradas|universal']], function () {
    Route::get('/entradas/list', 'EntradaController@index')->name('entradas');
    Route::get('/entradas/create', 'EntradaController@index');
    Route::post('/entradas/create', 'EntradaController@create');
    Route::get('/entradas/list/productos/{id}', 'EntradaController@listProductos');
    Route::get('/entradas/show/entrada/{id}', 'EntradaController@showEntrada');
    Route::get('/entradas/print/{id}', 'EntradaController@printEntrada');
});

Route::post('/clientes/create', 'ClienteController@create');

Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
