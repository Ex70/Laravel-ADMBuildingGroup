<?php

namespace App\Http\Controllers\API;

use App\Estado;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EstadoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(){
        $estados = Estado::orderBy('id', 'ASC')->get();
        return $estados;
    }

    public function listado(){
        $estados = Estado::all(['id','name']);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'nombre'=>'required|string|max:191',
            'clave'=>'required|string|max:4|unique:estados',
        ],
        [
            'nombre.required' => 'Debes ingresar un nombre valido!',
            "clave.unique" => "La clave de estado proporcionada ya existe"
        ]);
        $user = auth('api')->user();
        $fecha = Carbon::now()->setTimezone('America/Mexico_City');
        $estado = Estado::create([
            'nombre' => $request['nombre'],
            'clave' => $request['clave'],
        ]);
        $data = "[".$fecha."] El usuario " .$user->usuario. " agregó el estado " .$request->clave. " con los siguientes datos: " .$estado;
        Storage::append('logs.txt', $data);
        return $estado;
    }

    public function show($id){
        //
    }

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
        $user = auth('api')->user();
        $fecha = Carbon::now()->setTimezone('America/Mexico_City');
        $data = "[".$fecha."] El usuario " .$user->usuario. " actualizó el estado " .$request->nombre. " con los siguientes datos: " .$estado;
        Storage::append('logs.txt', $data);
        return['message' => 'Actualización de la información del estado'];
    }

    public function destroy($id){
        $estado = Estado::findOrFail($id);
        $estado->delete();
        $user = auth('api')->user();
        $fecha = Carbon::now()->setTimezone('America/Mexico_City');
        $data = "[".$fecha."] El usuario " .$user->usuario. " eliminó el estado " .$estado->nombre. " que contenía los siguientes datos: " .$estado;
        Storage::append('logs.txt', $data);
        return['message' => 'Estado Eliminado'];
    }
}
