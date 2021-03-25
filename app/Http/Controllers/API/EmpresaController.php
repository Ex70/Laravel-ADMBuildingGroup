<?php

namespace App\Http\Controllers\API;

use App\Empresa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::orderBy('id', 'ASC')->get();
        return $empresas;
    }

    public function profile($id){
        $empresas = Empresa::findOrFail($id)->get();
        return "HOLA";
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
            'direccion'=>'required|string|max:191',
            'telefono'=>'required|string|max:191',
            'rfc'=>'required|string|unique:empresas',
            'correo'=>'required|email|unique:empresas'
        ],
        [
            'nombre.required' => 'Debes ingresar un nombre valido!',
            'direccion.required' => 'Debes ingresar una direccion valida!',
            'telefono.required' => 'Debes ingresar un teléfono valido!',
            "rfc.unique" => "La clave rfc proporcionada ya existe",
            "correo.unique" => "El correo proporcionado ya existe"
        ]);
        $ultimoID = Empresa::latest('id')->first();
        $ultimoID = $ultimoID['id'] + 1;
        $direccionLogo = 'public/empresas/' . ($ultimoID) . '/logo/';
        $direccionContrato = 'public/empresas/' . ($ultimoID) . '/contrato/';
        $direccionFotos = 'public/empresas/' . ($ultimoID) . '/fotos/';
        Storage::makeDirectory($direccionLogo);
        Storage::makeDirectory($direccionContrato);
        Storage::makeDirectory($direccionFotos);
        $nombre = time().'.' . explode('/', explode(':', substr($request->logo, 0, strpos($request->logo, ';')))[1])[1];
        \Image::make($request->logo)->save(storage_path('app/'.$direccionLogo).$nombre);
        $request->merge(['logo' => $nombre]);

        return Empresa::create([
            'nombre' => $request['nombre'],
            'direccion' => $request['direccion'],
            'telefono' => $request['telefono'],
            'rfc' => $request['rfc'],
            'correo' => $request['correo'],
            'logo' => $request['logo'],
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
        $empresa = Empresa::findOrFail($id);
        $this->validate($request,[
            'nombre'=>'required|string|max:191',
            'direccion'=>'required|string|max:191',
            'telefono'=>'required|string|max:191',
            'rfc'=>'required|string|unique:empresas,rfc,'.$empresa->id,
            'correo'=>'required|email|unique:empresas,rfc,'.$empresa->id,
        ],
        [
            'nombre.required' => 'Debes ingresar un nombre valido!',
            'direccion.required' => 'Debes ingresar una direccion valida!',
            'telefono.required' => 'Debes ingresar un teléfono valido!',
            "rfc.unique" => "La clave rfc proporcionada ya existe",
            "correo.unique" => "El correo proporcionado ya existe"
        ]);
        $currentPhoto = $empresa->logo;
        $direccionLogo = 'public/empresas/' . ($id) . '/logo/';
        if($request->logo != $currentPhoto){
            $nombre = time().'.' . explode('/', explode(':', substr($request->logo, 0, strpos($request->logo, ';')))[1])[1];
            \Image::make($request->logo)->save(storage_path('app/'.$direccionLogo).$nombre);
            $request->merge(['logo' => $nombre]);
            $empresaLogo = storage_path('app/'.$direccionLogo . $currentPhoto);
            if(file_exists($empresaLogo)){
                @unlink($empresaLogo);
            }
        }
        $empresa->update($request->all());
        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empresa = Empresa::findOrFail($id);
        $empresa->delete();
        return['message' => 'Empresa Eliminada'];
    }
}
