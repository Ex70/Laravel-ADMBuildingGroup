<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources(['user'=>'API\UserController']);
Route::apiResources(['estado'=>'API\EstadoController']);
Route::apiResources(['modulo'=>'API\ModuloController']);
Route::apiResources(['unidad'=>'API\UnidadController']);
Route::apiResources(['ciudad'=>'API\CiudadController']);
Route::apiResources(['acceso'=>'API\AccesoController']);
Route::apiResources(['empresa'=>'API\EmpresaController']);

Route::get('profile','API\UserController@profile');
Route::get('empresa/{id}','API\EmpresaController@show');
Route::get('obtenerUsuarios','API\UserController@obtenerUsuarios');
Route::get('modulosAccesos','API\ModuloController@modulosAccesos');
