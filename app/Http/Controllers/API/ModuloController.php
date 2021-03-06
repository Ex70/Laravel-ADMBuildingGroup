<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Modulo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ModuloController extends Controller{
    public function index(){
        $modulos = Modulo::orderBy('clave', 'ASC')->paginate(10);
        return $modulos;
    }

    public function modulosTotales(){
        $totales = Modulo::select('id')->where('id', '>=', 1)->get();
        return $totales;
    }

    public function modulosAccesos2($id){
        $Usuario = auth('api')->user()->id;
        if($id==$Usuario){
            $results = DB::select('select modulos.*,accesos.id_usuario from modulos JOIN accesos ON accesos.id_modulo = modulos.id where id_usuario in (?) order by clave,id_usuario desc', [$id]);
        }else{
            $results = DB::select('select modulos.*, accesos.id_usuario from modulos JOIN accesos ON accesos.id_modulo = modulos.id where id_usuario in (?,1)  order by clave,id_usuario desc', [$id]);
        }
        return $results;
    }

    public function modulosAccesos(){
        $Usuario = auth('api')->user()->id;
        $modulo = Modulo::select('modulos.*','accesos.id_usuario')
        ->orderBy('modulos.clave', 'ASC')
        ->leftJoin("accesos","accesos.id_modulo","=","modulos.id")
        ->where("id_usuario","=",$Usuario)
        ->get();
        return $modulo;
    }

    public function store(Request $request){
        $this->validate($request,[
            'nombre'=>'required|string|max:191',
            'clave'=>'required|numeric|max:10|unique:modulos',
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
        $data = "[".$fecha."] El usuario " .$user->usuario. " agreg?? el m??dulo " .$request->nombre. " con los siguientes datos: " .$modulo;
        Storage::append('logs.txt', $data);
        return $modulo;
    }

    public function show($id){
        //
    }

    public function update(Request $request, $id){
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
        $data = "[".$fecha."] El usuario " .$user->usuario. " actualiz?? el m??dulo " .$request->nombre. " con los siguientes datos: " .$modulo;
        Storage::append('logs.txt', $data);
        return['message' => 'Informacion actualizada del modulo'];
    }

    public function destroy($id){
        $modulo = Modulo::findOrFail($id);
        $modulo->delete();
        $user = auth('api')->user();
        $fecha = Carbon::now()->setTimezone('America/Mexico_City');
        $data = "[".$fecha."] El usuario " .$user->usuario. " elimin?? el m??dulo " .$modulo->nombre. " que conten??a los siguientes datos: " .$modulo;
        Storage::append('logs.txt', $data);
        return['message' => 'Modulo Eliminado'];
    }

    public function search(){
        if ($search = \Request::get('q')) {
            $modulos = Modulo::where(function($query) use ($search){
                $query->where('nombre','LIKE',"%$search%");
            })->orderBy('id', 'ASC')->paginate(10);
        }else{
            $modulos = Modulo::orderBy('id', 'ASC')->paginate(10);
        }
        return $modulos;
    }
}
