<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    // return view('welcome'); 
    return view('layouts/admin');
});

// tipo resource para peticions CRUD
Route::resource('almacen/categoria', 'CategoriaController');
Route::resource('almacen/articulo', 'ArticuloController');

Route::resource('ventas/cliente', 'ClienteController');
Route::resource('compras/proveedor', 'ProveedorController');
Route::resource('almacen/empleado', 'EmpleadoController');

Route::resource('compras/ingreso', 'IngresoController');

Route::resource('ventas/venta', 'VentaController');

Route::resource('caja', 'CajaController');
/* 
Route::resource('ventas/venta', 'VentaController');
Route::resource('seguridad/usuario', 'UsuarioController');

//Route::auth();
Route::get('/home', 'HomeController@index');
// si la ruta escrita en la url, no existe
Route::get('/{slug?}', 'HomeController@index');

*/
/*
Route::auth();

Route::get('/home', 'HomeController@index');*/
