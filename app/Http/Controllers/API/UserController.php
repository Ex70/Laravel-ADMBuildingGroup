<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        return User::latest()->paginate(10);
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

        return User::create([
            'nombre' => $request['nombre'],
            'usuario' => $request['usuario'],
            'email' => $request['email'],
            'tipo' => $request['tipo'],
            'password' => Hash::make($request['password']),
        ]);
    }

    public function updateProfile(Request $request)
    {
        $user = auth('api')->user();
        return ['message' => "Success"];
    }

    public function obtenerUsuarios(){
        $usuarios = User::pluck('usuario', 'id');
        return $usuarios;
    }

    public function profile()
    {
        return auth('api')->user();
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
        $user = User::findOrFail($id);

        $this->validate($request,[
            'nombre'=>'required|string|max:191',
            'email'=>'required|string|email|max:191|unique:users,email,'.$user->id,
            'password'=>'sometimes|min:6'
        ]);

        $request['password'] = Hash::make($request['password']);;

        $user->update($request->all());
        return['message' => 'Updated the user info'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        //Delete the user
        $user->delete();

        return['message' => 'User Deleted'];
    }
}
