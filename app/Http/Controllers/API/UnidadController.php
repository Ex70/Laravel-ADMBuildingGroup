<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Unidad;
use Illuminate\Http\Request;

class UnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unidades = Unidad::orderBy('id', 'ASC')->get();
        return $unidades;
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
            'descripcion'=>'required|string|max:191',
            'clave'=>'required|string|max:10|unique:unidades',
        ],
        [
            'descripcion.required' => 'Debes ingresar una descripción',
            'clave.required' => 'Debes ingresar una clave',
            "clave.unique" => "La clave proporcionada ya existe"
        ]);

        return Unidad::create([
            'descripcion' => $request['descripcion'],
            'clave' => $request['clave'],
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
        $unidad = Unidad::findOrFail($id);
        $this->validate($request,[
            'descripcion'=>'required|string|max:191',
            'clave'=>'required|string|max:10|unique:unidades,clave,'.$unidad->id,
        ],
        [
            'descripcion.required' => 'Debes ingresar una descripción',
            "clave.unique" => "La clave proporcionada ya existe",
            "clave.max" => "La clave no puede ser mayor de 10 caracteres"
        ]);
        $unidad->update($request->all());
        return['message' => 'Información de la unidad actualizada'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $unidad = Unidad::findOrFail($id);
        $unidad->delete();
        return['message' => 'Unidad Eliminado'];
    }
}
