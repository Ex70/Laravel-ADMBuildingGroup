<?php

namespace App\Http\Controllers\API;

use App\Acceso;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccesoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $idUsuario = auth('api')->user()->id;
        return Acceso::latest()->where("id_usuario","=",$idUsuario)->paginate(20);
    }

    public function modulosAccesos(){
        $Usuario = auth('api')->user()->id;
        $acceso = Acceso::select('*')
        ->orderBy('clave', 'DESC')
        ->leftJoin("modulos","accesos.id_modulo","=","modulos.id")
        ->where("id_usuario","=",$Usuario)
        ->get();
        return $acceso;
    }

    public function store(Request $request){
        DB::table('accesos')->where('id_usuario', '=', $request->id_usuario)->delete();
        $cadena = '';
        $idUsuario = $request->id_usuario;
        $index = 1;
        foreach($request->pruebas as $acceso){
            if($acceso[$index]==true){
                DB::insert('insert into accesos(id_usuario,id_modulo) values (?, ?)', [$idUsuario, $index]);
            }else{
                echo "No pasó";
            }
            $index++;
        }
        return "Resultó";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
