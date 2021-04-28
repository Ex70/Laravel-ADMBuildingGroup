<?php

use App\User;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('pdfUser', function(){
    //$usuario = User::all();
    $usuarios = User::latest()->paginate(5);
    //return $usuarios;
    $cont = User::count();
    $pdf = \PDF::loadView('pdf.usuariospdf',['usuarios'=>$usuarios, 'cont'=>$cont]);
    return $pdf->stream('usuarios.pdf');
    //return view('invoice');
})->middleware('auth:api');

Route::get('invoice', function(){
    return view('invoice');
});

Route::get('listarpdf','API\UserController@listarPdf');
Route::get('{path}', "HomeController@index")->where('path','([A-z\/_.\d-]+)?');
