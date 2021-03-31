<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Modulo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ModuloController extends Controller
{
    public function __construct()
    {
        $this->middleware('api');
        $this->user = Auth::user();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modulos = Modulo::orderBy('id', 'ASC')->get();
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

        $user = auth('api')->user();
        $fecha = Carbon::now()->setTimezone('America/Mexico_City');
        $modulo = Modulo::create([
            'nombre' => $request['nombre'],
            'clave' => $request['clave'],
            'vista' => $request['vista'],
        ]);
        $data = "[".$fecha."] El usuario " .$user->usuario. " agregó el módulo " .$request->nombre. " con los siguientes datos: " .$modulo;
        Storage::append('logs.txt', $data);
        return $modulo;
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
        $user = auth('api')->user();
        $fecha = Carbon::now()->setTimezone('America/Mexico_City');
        $data = "[".$fecha."] El usuario " .$user->usuario. " actualizó el módulo " .$request->nombre. " con los siguientes datos: " .$modulo;
        Storage::append('logs.txt', $data);
        return['message' => 'Informacion actualizada del modulo'];
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
        $user = auth('api')->user();
        $fecha = Carbon::now()->setTimezone('America/Mexico_City');
        $data = "[".$fecha."] El usuario " .$user->usuario. " eliminó el módulo " .$modulo->nombre. " que contenía los siguientes datos: " .$modulo;
        Storage::append('logs.txt', $data);
        return['message' => 'Modulo Eliminado'];
    }
}
