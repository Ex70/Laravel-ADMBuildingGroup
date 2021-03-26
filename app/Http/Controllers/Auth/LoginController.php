<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function usuario(){
        return 'usuario';
    }

    public function login(Request $request)
    {
        $input = $request->all();

        $this->validate($request, [
            'usuario' => 'required',
            'password' => 'required',
            'empresa_id' => 'required',
        ]);

        $fieldType = filter_var($request->usuario, FILTER_VALIDATE_EMAIL) ? 'email' : 'usuario';
        if(auth()->attempt(array($fieldType => $input['usuario'], 'password' => $input['password'])))
        {
            Session::put('empresa',$request['empresa_id']);
            $empresa = $request['empresa_id'];
            return view('home',compact('empresa'));
            //return redirect()->route('home')->with( [ 'empresa' => $request['empresa_id']] );;
        }else{
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }
    }
}
