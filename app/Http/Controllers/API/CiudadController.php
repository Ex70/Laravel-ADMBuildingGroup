<?php

namespace App\Http\Controllers\API;

use App\Ciudad;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CiudadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $ciudades = Ciudad::all();
        // return $ciudades;

        // $ciudades = Ciudad::first();
        // //$ciudades->estados;
        // return json_encode($ciudades);
        //return $ciudades;

        // $acceso = DB::table('accesos')
        //     ->leftJoin('modulos', 'accesos.id_modulo', '=', 'modulos.id')
        //     ->get();
        //$acceso = Acceso::find(3)->modulo->where("usuario","=",$usuario)->get();
        //->toJson();

        //return response()->json(['message'=>'Datos para menú','data'=>$ciudad],200);




        $ciudades = DB::table('ciudades')
            ->join('estados', 'estados.id', '=', 'ciudades.id_estado')
            ->select('ciudades.*','estados.nombre as estado')
            ->get()->toArray();
        
        
        //$ciudades = Ciudad::select('ciudades.*', 'estados.nombre as estado')->with('estados')->get();
        //$ciudades=Ciudad::with('estados')->get();
        //return json_encode($ciudades);
        return $ciudades;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
