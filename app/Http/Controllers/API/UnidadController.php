<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Unidad;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UnidadController extends Controller{
    public function index(){
        $unidades = Unidad::orderBy('id', 'ASC')->get();
        return $unidades;
    }

    public function store(Request $request){
        $this->validate($request,[
            'descripcion'=>'required|string|max:191',
            'clave'=>'required|string|max:10|unique:unidades',
        ],
        [
            'descripcion.required' => 'Debes ingresar una descripción',
            'clave.required' => 'Debes ingresar una clave',
            "clave.unique" => "La clave proporcionada ya existe"
        ]);
        $user = auth('api')->user();
        $fecha = Carbon::now()->setTimezone('America/Mexico_City');
        $unidad = Unidad::create([
            'descripcion' => $request['descripcion'],
            'clave' => $request['clave'],
        ]);
        $data = "[".$fecha."] El usuario " .$user->usuario. " agregó la unidad " .$request->clave. " con los siguientes datos: " .$unidad;
        Storage::append('logs.txt', $data);
        return $unidad;
    }

    public function show($id){
        //
    }

    public function update(Request $request, $id){
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
        $user = auth('api')->user();
        $fecha = Carbon::now()->setTimezone('America/Mexico_City');
        $data = "[".$fecha."] El usuario " .$user->usuario. " actualizó la unidad " .$request->clave. " con los siguientes datos: " .$unidad;
        Storage::append('logs.txt', $data);
        return['message' => 'Información de la unidad actualizada'];
    }

    public function destroy($id){
        $unidad = Unidad::findOrFail($id);
        $unidad->delete();
        $user = auth('api')->user();
        $fecha = Carbon::now()->setTimezone('America/Mexico_City');
        $data = "[".$fecha."] El usuario " .$user->usuario. " eliminó la unidad " .$unidad->clave. " que contenía los siguientes datos: " .$unidad;
        Storage::append('logs.txt', $data);
        return['message' => 'Unidad Eliminada'];
    }
}