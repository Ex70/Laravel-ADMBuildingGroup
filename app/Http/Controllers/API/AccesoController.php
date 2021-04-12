<?php

namespace App\Http\Controllers\API;

use App\Acceso;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccesoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $idUsuario = auth('api')->user()->id;
        //$posts = Acceso::orderBy('id', 'ASC')->get();
        //$accesos = Acceso::where("id_usuario","=",$idUsuario)->get();
        //$estados = Estado::all()->orderBy('id','DESC')->toArray();
        //return $posts;
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
        // $request->validate([
        //     'importar' => 'accepted'
        // ]);
        if($request->has('importar')){
            return "Checkbox Checked";
        }else{
            return "Checkbox Unchecked";
        }
        //return $request;
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
