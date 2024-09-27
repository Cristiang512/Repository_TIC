<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dependencia;
use App\Models\Subdependencia;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['admin']=User::leftJoin('dependencia AS depe', 'users.id_dependencia', 'depe.id_dependencia')
        ->leftJoin('subdependencia AS subdepe', 'users.id_subdependencia', 'subdepe.id_subdependencia')
        ->select(
            'users.id',
            'users.name',
            'users.document',
            'users.email',
            'users.tipo',
            'users.rol_id',
            'depe.nombre as depe',
            'subdepe.nombre as subdepe'
        )
        ->get();
        // $datos['admin'] = User::select('id_dependencia', 'id_subdependencia', User::raw('COALESCE(id_subdependencia, id_dependencia) as subdependencia'), 'otra_columna1', 'otra_columna2')
        //     ->get();


        return view('admin.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request;
    $campos = [
        'name' => ['required', 'string', 'max:255'],
        'document' => ['required', 'string', 'max:255', 'unique:users'],
        'tipo' => ['string', 'max:255'],
        'email' => ['string', 'max:255'],
        ];

        $mensaje=["required" => ' :attribute es requerido'];
        $this ->validate ($request,$campos,$mensaje);
        $dataAdmin=request()->except('_token');

        $dataAdmin = User::create([
            'name' => $request->name,
            'document' => $request->document,
            'email' => $request->email,
            'tipo' => $request->tipo,
            'password' => Hash::make(substr($request->document, -4)),
            'rol_id' => 1,
        ]);

        return redirect('admin')->with('mensaje','Administrador Agregado con Éxito');
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $admin=User::findOrFail($id);
        return view('admin.edit',compact ('admin'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validación de campos
        $campos = [
            'name' => ['required', 'string', 'max:255'],
            'document' => ['required', 'string', 'max:255'],
        ];

        $mensaje = ["required" => ':attribute es requerido'];

        // Validar los campos
        $this->validate($request, $campos, $mensaje);

        // Obtener datos del formulario, excluyendo los campos _token y _method
        $dataAdmin = $request->except(['_token', '_method']);

        // Verificar si se debe restablecer la contraseña
        if ($request->has('password')) {
            // Actualizar la contraseña con los últimos 4 dígitos del campo "document"
            $dataAdmin['password'] = Hash::make(Str::substr($request->document, -4));
        }

        // Actualizar el administrador en la base de datos
        User::where('id', $id)->update($dataAdmin);

        // Redirigir a la página de administradores con un mensaje de éxito
        return redirect('admin')->with('mensaje', 'Administrador Modificado con Éxito');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('admin')->with('mensaje','Administrador Eliminado con Éxito');
    }

    public function changePassword()
    {
        return view('admin.change-password');
    }

    public function updatePassword(Request $request)
    {
        # Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "La Contraseña Anterior No es Correcta!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return redirect()->back()->with("status", "Cambio de Contraseña Exitoso!");
        // return redirect('/identificacion/'.auth()->user()->id.'/index')->with("status", "Cambio de Contraseña Exitoso!");
    }
}
