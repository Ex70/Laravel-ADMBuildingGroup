<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use PDF;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function index(){
        // $users = User::orderBy('id', 'ASC')->get();
        // return $users;
        $this->authorize('isAdmin');
        return User::paginate(10);
    }

    public function store(Request $request){
        $this->validate($request,[
            'nombre'=>'required|string|max:191',
            'usuario'=>'required|string|max:191|unique:users',
            'email'=>'required|string|email|max:191|unique:users',
            'password'=>'required|string|min:6'
        ],
        [
            'nombre.required' => 'Debes ingresar un nombre valido!',
            'password.required' => 'La contraseña debe tener al menos 6 caracteres',
            "email.unique" => "El correo proporcionado ya existe",
            "usuario.unique" => "El usuario proporcionado ya existe",
            'password.min' => "La contraseña debe tener al menos 6 caracteres"
        ]);
        $user = auth('api')->user();
        $fecha = Carbon::now()->setTimezone('America/Mexico_City');
        $usuario = User::create([
            'nombre' => $request['nombre'],
            'usuario' => $request['usuario'],
            'email' => $request['email'],
            'tipo' => $request['tipo'],
            'activo' => $request['activo'],
            'password' => Hash::make($request['password']),
        ]);
        $data = "[".$fecha."] El usuario " .$user->usuario. " agregó el módulo " .$request->nombre. " con los siguientes datos: " .$usuario;
        Storage::append('logs.txt', $data);
        return $usuario;
    }

    public function logueado(){
        return auth('api')->user()->id;
    }

    public function updateProfile(Request $request){
        $user = auth('api')->user();
        return ['message' => "Success"];
    }

    public function obtenerUsuarios(){
        $usuarios = User::pluck('usuario', 'id');
        return $usuarios;
    }

    public function profile(){
        return auth('api')->user();
    }

    public function show($id){
        //
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        $this->validate($request,[
            'nombre'=>'required|string|max:191',
            'email'=>'required|string|email|max:191|unique:users,email,'.$user->id,
            'password'=>'sometimes|min:6'
        ]);
        $request['password'] = Hash::make($request['password']);;
        $user->update($request->all());
        $user = auth('api')->user();
        $fecha = Carbon::now()->setTimezone('America/Mexico_City');
        $data = "[".$fecha."] El usuario " .$user->usuario. " actualizó al usuario " .$request->usuario. " con los siguientes datos: " .$user;
        Storage::append('logs.txt', $data);
        return['message' => 'Información de usuario actualizada'];
    }

    public function destroy($id){
        $user = User::findOrFail($id);
        $user->delete();
        $user = auth('api')->user();
        $fecha = Carbon::now()->setTimezone('America/Mexico_City');
        $data = "[".$fecha."] El usuario " .$user->usuario. " eliminó al usuario " .$user->usuario. " que contenía los siguientes datos: " .$user;
        Storage::append('logs.txt', $data);
        return['message' => 'Usuario Eliminado'];
    }

    public function search(){

        if ($search = \Request::get('q')) {
            $users = User::where(function($query) use ($search){
                $query->where('usuario','LIKE',"%$search%")
                        ->orWhere('email','LIKE',"%$search%");
            })->paginate(20);
        }else{
            $users = User::latest()->paginate(5);
        }
        return $users;
    }

    public function listarPdf(){
        return view('invoice');
        //$pdf = \PDF::loadView('ejemplo');
        //return $pdf->download('ejemplo.pdf');
        //return['message' => 'Usuario Eliminado'];
        // $usuarios = User::latest()->paginate(5);
        // return $usuarios;
        // $cont = User::count();
        // $pdf = PDF::loadView('pdf.usuariospdf',['usuarios'=>$usuarios, 'cont'=>$cont]);
        // return $pdf->download('usuarios.pdf');
    }
}