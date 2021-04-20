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
        $modulos = Modulo::orderBy('clave', 'ASC')->get();
        return $modulos;
    }

    public function modulosTotales(){
        $wordlist = Modulo::select('id')->where('id', '>=', 1)->get();
        $wordCount = $wordlist->count();
        return $wordlist;
        // return response()->json([
        //     'total' => $wordCount,
        //     'estado' => '1',
        // ]);
    }

    public function modulosAccesos2($id){
        $Usuario = auth('api')->user()->id;
        if($id==$Usuario){
            $results = DB::select('select modulos.*,accesos.id_usuario from modulos JOIN accesos ON accesos.id_modulo = modulos.id where id_usuario in (?) order by clave,id_usuario desc', [$id]);
        }else{
            $results = DB::select('select modulos.*,accesos.id_usuario from modulos JOIN accesos ON accesos.id_modulo = modulos.id where id_usuario in (?,1) order by clave,id_usuario desc', [$id]);
        }
        // $modulo = Modulo::select(
        //     DB::raw(REPLACE(accesos.id_usuario, 'NULL', '14') = id_usuario)
        // //     DB::raw('ISNULL(accesos.id_usuario, 14 ) AS id_usuario')
        //      )
        $modulo = Modulo::select('modulos.*','accesos.id_usuario')
        ->Join("accesos","accesos.id_modulo","=","modulos.id")
        ->where("id_usuario","=",14)
        //->whereNull('id_usuario')
        //->orWhere("id_usuario","=",$Usuario)
        // ->orWhereNull('id_usuario')
        // ->orderBy('modulos.clave', 'ASC')
        //("id_usuario","=",isNU)
        ->get();
        return $results;
    }

    public function modulosAccesos(){
        $Usuario = auth('api')->user()->id;
        $modulo = Modulo::select('modulos.*','accesos.id_usuario')
        ->orderBy('modulos.clave', 'ASC')
        ->leftJoin("accesos","accesos.id_modulo","=","modulos.id")
        ->where("id_usuario","=",$Usuario)
        // ->orWhere("id_usuario","=",NULL)
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
        $data = "[".$fecha."] El usuario " .$user->usuario. " agregó el módulo " .$request->nombre. " con los siguientes datos: " .$modulo;
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
        $data = "[".$fecha."] El usuario " .$user->usuario. " actualizó el módulo " .$request->nombre. " con los siguientes datos: " .$modulo;
        Storage::append('logs.txt', $data);
        return['message' => 'Informacion actualizada del modulo'];
    }

    public function destroy($id){
        $modulo = Modulo::findOrFail($id);
        $modulo->delete();
        $user = auth('api')->user();
        $fecha = Carbon::now()->setTimezone('America/Mexico_City');
        $data = "[".$fecha."] El usuario " .$user->usuario. " eliminó el módulo " .$modulo->nombre. " que contenía los siguientes datos: " .$modulo;
        Storage::append('logs.txt', $data);
        return['message' => 'Modulo Eliminado'];
    }
}
