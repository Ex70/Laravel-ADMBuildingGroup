<?php

namespace App\Http\Controllers\API;

use App\Ciudad;
use App\Estado;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CiudadController extends Controller{
    public function index(){
        $ciudades = DB::table('ciudades')
            ->join('estados', 'estados.id', '=', 'ciudades.id_estado')
            ->select('ciudades.*','estados.nombre as estado')
            ->get()->toArray();
        return $ciudades;
    }

    public function store(Request $request){
        $this->validate($request,[
            'nombre'=>'required|string|max:191',
            'nombre' => 'regex:/^[a-zA-Z ]+$/',
            'clave'=>'required|string|max:4|unique:ciudades',
        ],
        [
            'nombre.required' => 'Debes ingresar un nombre valido!',
            'nombre.regex' => 'EL nombre la ciudad solo debe contener letras',
            "clave.unique" => "La clave de ciudad proporcionada ya existe"
        ]);
        $claveEstado = Estado::select('clave')->where('id', $request['id_estado'])->first();
        $clave = $request['clave']."-".$claveEstado->clave;
        $user = auth('api')->user();
        $fecha = Carbon::now()->setTimezone('America/Mexico_City');
        $ciudad = Ciudad::create([
            'id_estado' => $request['id_estado'],
            'nombre' => $request['nombre'],
            'clave' => $clave,
        ]);
        $data = "[".$fecha."] El usuario " .$user->usuario. " agregó la ciudad " .$request->nombre. " con los siguientes datos: " .$ciudad;
        Storage::append('logs.txt', $data);
        return $ciudad;
    }

    public function show($id){
        //
    }

    public function update(Request $request, $id){
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
        $user = auth('api')->user();
        $fecha = Carbon::now()->setTimezone('America/Mexico_City');
        $data = "[".$fecha."] El usuario " .$user->usuario. " actualizó la ciudad " .$request->nombre. " con los siguientes datos: " .$ciudad;
        Storage::append('logs.txt', $data);
        return['message' => 'Actualización de la información del estado'];
    }

    public function destroy($id){
        $ciudad = Ciudad::findOrFail($id);
        $ciudad->delete();
        $user = auth('api')->user();
        $fecha = Carbon::now()->setTimezone('America/Mexico_City');
        $data = "[".$fecha."] El usuario " .$user->usuario. " eliminó la ciudad " .$ciudad->nombre. " que contenía los siguientes datos: " .$ciudad;
        Storage::append('logs.txt', $data);
        return['message' => 'Ciudad Eliminada'];
    }
}