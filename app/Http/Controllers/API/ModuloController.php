<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Modulo;
use Illuminate\Http\Request;

class ModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return Estado::latest();
        //return Estado::orderBy('id', 'DESC')->get();
        //$estados = Estado::all();
        //return response()->json($estados);
        $modulos = Modulo::orderBy('id', 'ASC')->get();
        //$estados = Estado::all()->orderBy('id','DESC')->toArray();
        return $modulos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        //return ['message' => 'I have ytour data'];
        $this->validate($request,[
            'nombre'=>'required|string|max:191',
            'clave'=>'required|string|max:10|unique:modulos',
            'vista'=>'required|string|max:191',
        ],
        [
            'nombre.required' => 'Debes ingresar un nombre valido!',
            'clave.required' => 'Debes ingresar una clave valida!',
            'vista.required' => 'Debes ingresar una vista valida!',
            "clave.unique" => "La clave de modulo proporcionada ya existe"
        ]);

        return Modulo::create([
            'nombre' => $request['nombre'],
            'clave' => $request['clave'],
            'vista' => $request['vista'],
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
        $modulo = Modulo::findOrFail($id);
        $this->validate($request,[
            'nombre'=>'required|string|max:191',
            'clave'=>'required|string|max:10|unique:modulos,clave,'.$modulo->id,
            'vista'=>'required|string|max:191',
        ],
        [
            'nombre.required' => 'Debes ingresar un nombre valido!',
            'clave.required' => 'Debes ingresar una clave valida!',
            'vista.required' => 'Debes ingresar una vista valida!',
            "clave.unique" => "La clave de modulo proporcionada ya existe"
        ]);
        $modulo->update($request->all());
        return['message' => 'Información actualizada del modulo'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modulo = Modulo::findOrFail($id);
        $modulo->delete();
        return['message' => 'Modulo Eliminado'];
    }
}
