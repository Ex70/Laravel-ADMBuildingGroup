<?php

namespace App\Http\Controllers\API;

use App\Estado;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EstadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
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
        $posts = Estado::orderBy('id', 'ASC')->get();
        //$estados = Estado::all()->orderBy('id','DESC')->toArray();
        return $posts;
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
            'clave'=>'required|string|max:4|unique:estados',
        ],
        [
            'nombre.required' => 'Debes ingresar un nombre valido!',
            "clave.unique" => "La clave de estado proporcionada ya existe"
        ]);

        return Estado::create([
            'nombre' => $request['nombre'],
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
        $estado = Estado::findOrFail($id);
        $this->validate($request,[
            'nombre'=>'required|string|max:191',
            'clave'=>'required|string|max:4|unique:estados,clave,'.$estado->id,
        ],
        [
            'nombre.required' => 'Debes ingresar un nombre valido!',
            "clave.unique" => "La clave de estado proporcionada ya existe",
            "clave.max" => "La clave no puede ser mayor de 4 caracteres"
        ]);
        $estado->update($request->all());
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
        $estado = Estado::findOrFail($id);
        $estado->delete();
        return['message' => 'Estado Eliminado'];
    }
}
