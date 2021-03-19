<?php

namespace App\Http\Controllers\API;

use App\Ciudad;
use App\Estado;
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
        $ciudades = DB::table('ciudades')
            ->join('estados', 'estados.id', '=', 'ciudades.id_estado')
            ->select('ciudades.*','estados.nombre as estado')
            ->get()->toArray();
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
        $this->validate($request,[
            'nombre'=>'required|string|max:191',
            'clave'=>'required|string|max:4|unique:ciudades',
        ],
        [
            'nombre.required' => 'Debes ingresar un nombre valido!',
            "clave.unique" => "La clave de ciudad proporcionada ya existe"
        ]);

        $claveEstado = Estado::select('clave')->where('id', $request['id_estado'])->first();
        $clave = $request['clave']."-".$claveEstado->clave;

        return Ciudad::create([
            'id_estado' => $request['id_estado'],
            'nombre' => $request['nombre'],
            'clave' => $clave,
        ]);
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
        $ciudad = Ciudad::findOrFail($id);
        $this->validate($request,[
            'nombre'=>'required|string|max:191',
            'clave'=>'required|string|max:4|unique:ciudades,clave,'.$ciudad->id,
        ],
        [
            'nombre.required' => 'Debes ingresar un nombre valido!',
            "clave.unique" => "La clave de estado proporcionada ya existe",
            "clave.max" => "La clave no puede ser mayor de 4 caracteres"
        ]);
        $claveEstado = Estado::select('clave')->where('id', $request['id_estado'])->first();
        $clave = $request['clave']."-".$claveEstado->clave;
        $request['clave'] = $clave;
        $ciudad->update($request->all());
        return['message' => 'Actualización de la información del estado'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ciudad = Ciudad::findOrFail($id);
        $ciudad->delete();
        return['message' => 'Ciudad Eliminada'];
    }
}
