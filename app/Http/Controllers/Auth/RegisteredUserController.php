<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Subdependencia;
use App\Models\Rol;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        // return $request;

        // $request['rol_id'] = 1;
        // $request->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'document' => ['required', 'string', 'max:255', 'unique:users'],
        //     'tipo' => ['required', 'string', 'max:255'],
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        //     'rol_id'=> ['integer', 'max:255'],
        // ]);
        // if($request['otro'] !== null){
        //     if($request['id_dependencia'] == null){
                // $request['id_dependencia'] = Subdependencia::select('id_dependencia')
                // ->where('id_subdependencia',$request['id_subdependencia'])
                // ->first()
                // ->id_dependencia;
        //     }
        // }

        $request->validate([
            'document' => ['required', 'string', 'max:255', 'unique:users'],
        ]);

        if ($request['id_dependencia'] !== null) {
            $request['id_dependencia'] = intval($request['id_dependencia']);
        }

        if ($request['id_subdependencia'] !== null) {
            $request['id_subdependencia'] = intval($request['id_subdependencia']);
        }

        if ($request['otro'] !== null && $request['id_dependencia'] == null) {
            $request['id_dependencia'] = Subdependencia::where('id_subdependencia', $request['id_subdependencia'])
                ->value('id_dependencia');
        }
    
        $request['rol_id'] = ($request['tipo'] == 'Administrador') ? 1 : 2;

        // $request['id_dependencia'] = ($request['rol_id'] == 1) ? 0 : $request['id_dependencia'];
        // $request['id_subdependencia'] = ($request['rol_id'] == 1) ? 0 : $request['id_subdependencia'];


        // return $request;

        // $user['rol_id'] = 1;
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'document' => $request->document,
            'tipo' => $request->tipo,
            'password' => Hash::make($request->password),
            'rol_id' => $request->rol_id,
            'id_dependencia' => $request['id_dependencia'],
            'id_subdependencia' => $request['id_subdependencia'],
        ]);

        // $request = User::insertGetId([
        //     'name' => $request['name'],
        //     'email' => $request['email'],
        //     'document' => $request['document'],
        //     'password' => Hash::make($request['password']),
        //     'rol_id' => 1
        // ], 'id');
        // $user['rol_id'] = 1;

        // return $user;
        event(new Registered($user));

        // Auth::login($user);
        // return $user;

        return redirect(RouteServiceProvider::ADMIN)->with('mensaje','Administrador Agregado con Éxito');
    }
}
