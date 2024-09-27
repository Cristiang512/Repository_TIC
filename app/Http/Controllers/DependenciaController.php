<?php

namespace App\Http\Controllers;

use App\Models\Dependencia;
use App\Models\Subdependencia;
use App\Models\Archivo;
use App\Models\User;
use App\Models\Identificacion;
use App\Models\Municipio;
use App\Models\TipoDocumento;
use App\Models\IdentidadGenero;
use App\Models\OrientacionSexual;
use App\Models\CursoVida;
use App\Models\GrupoPoblacional;
use App\Models\Discapacidad;
use App\Models\EstatusMigratorio;
use App\Models\Etnia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Models\Informacion;

class DependenciaController extends Controller
{
    public function index()
    {
        $datos['dependencia'] = Dependencia::all();

        return view('dependencia.index', $datos);
    }
    
    public function create()
    {
        // $municipio = Municipio::all();
        // $documento = TipoDocumento::all();
        // $identidad = IdentidadGenero::all();
        // $orientacion = OrientacionSexual::all();
        // $curso = CursoVida::all();
        // $grupo = GrupoPoblacional::all();
        // $discapacidad = Discapacidad::all();
        // $estatus = EstatusMigratorio::all();
        // $etnia = Etnia::all();
        // $user = User::all()->where('rol_id','!=', 2);

        // return view('identificacion.create', compact('municipio','documento','identidad','orientacion','curso', 'grupo','discapacidad','estatus','etnia','user'));
    }

    public function store(Request $request)
    {
    // $campos = [
    //     'doc_numero' => ['required', 'string', 'max:255', 'unique:identificacion'],
    //     ];

    //     $mensaje=["required" => ' :attribute es requerido'];
    //     $this ->validate ($request,$campos,$mensaje);

    //     $id = User::insertGetId([
    //         'name' => $request->nombres,
    //         'document' => $request->doc_numero,
    //         'email' => $request->correo,
    //         'phone' => $request->telefono,
    //         'password' => Hash::make(substr($request->doc_numero, -4)),
    //         'rol_id' => 2,
    //     ], 'id');

    //     Identificacion::create([
    //         'id_lider_seguimiento' => $request->id_lider_seguimiento,
    //         'id_municipio' => $request->id_municipio,
    //         'instancia_remite'=> $request->instancia_remite,
    //         'estado_referencia'=> $request->estado_referencia,
    //         'nombres'=> $request->nombres,
    //         'apellidos'=> $request->apellidos,
    //         'id_tipo_documento'=> $request->id_tipo_documento,
    //         'doc_numero'=> $request->doc_numero,
    //         'fecha_nacimiento'=> $request->fecha_nacimiento,
    //         'edad'=> $request->edad,
    //         'telefono'=> $request->telefono,
    //         'direccion'=> $request->direccion,
    //         'barrio'=> $request->barrio,
    //         'correo'=> $request->correo,
    //         'sexo'=> $request->sexo,
    //         'id_orientacion'=> $request->id_orientacion,
    //         'id_identidad'=> $request->id_identidad,
    //         'id_curso'=> $request->id_curso,
    //         'personas_vive'=> $request->personas_vive,
    //         'area_ocurrencia'=> $request->area_ocurrencia,
    //         'regimen_salud'=> $request->regimen_salud,
    //         'eapb'=> $request->eapb,
    //         'id_grupo_poblacional'=> $request->id_grupo_poblacional,
    //         'id_discapacidad'=> $request->id_discapacidad,
    //         'semanas_gestacion'=> $request->semanas_gestacion,
    //         'lactante'=> $request->lactante,
    //         'nacionalidad'=> $request->nacionalidad,
    //         'entrada_pais'=> $request->entrada_pais,
    //         'id_estatus_migratorio'=> $request->id_estatus_migratorio,
    //         'id_etnia'=> $request->id_etnia,
    //         'id_user' => $id
    //     ]);
    //     return redirect('identificacion')->with('message','Registro Agregado con Éxito');
    }

    public function edit($id)
    {
        // $identificacion=Identificacion::where('id_identificacion', $id)->firstOrFail();
        // $municipio = Municipio::all();
        // $documento = TipoDocumento::all();
        // $identidad = IdentidadGenero::all();
        // $orientacion = OrientacionSexual::all();
        // $curso = CursoVida::all();
        // $grupo = GrupoPoblacional::all();
        // $discapacidad = Discapacidad::all();
        // $estatus = EstatusMigratorio::all();
        // $etnia = Etnia::all();
        // $user = User::all()->where('rol_id','!=', 2);
        // return view('identificacion.edit',compact ('identificacion','municipio','documento','identidad','orientacion','curso', 'grupo','discapacidad','estatus','etnia','user'));
    }

    public function update(Request $request, $id)
    {
        // $queryDoc = Identificacion::where([
        //     ['doc_numero', $request['doc_numero']],
        // ])
        // ->select('id_identificacion')
        // ->get()
        // ->toArray();

        // $queryMail = Identificacion::where([
        //     ['correo', $request['correo']],
        // ])
        // ->select('id_identificacion')
        // ->get()
        // ->toArray();

        // if(empty($queryDoc)){
        //     $campos = [
        //         'doc_numero' => ['required', 'string', 'max:255','unique:identificacion' ],
        //         ];
        
        //         $mensaje=["required" => ' :atributo es requerido'];
        //         $this ->validate ($request,$campos,$mensaje);
        // }

        // if(empty($queryMail)){
        //     $campos = [
        //         'correo' => ['string', 'max:255', 'unique:identificacion'],
        //         ];
        
        //         $mensaje=["required" => ' :atributo es requerido'];
        //         $this ->validate ($request,$campos,$mensaje);
        // }

        // Identificacion::where('id_identificacion', $id)
        // ->update([
        //     'id_lider_seguimiento' => $request->id_lider_seguimiento,
        //     'id_municipio' => $request->id_municipio,
        //     'instancia_remite'=> $request->instancia_remite,
        //     'estado_referencia'=> $request->estado_referencia,
        //     'nombres'=> $request->nombres,
        //     'apellidos'=> $request->apellidos,
        //     'id_tipo_documento'=> $request->id_tipo_documento,
        //     'doc_numero'=> $request->doc_numero,
        //     'fecha_nacimiento'=> $request->fecha_nacimiento,
        //     'edad'=> $request->edad,
        //     'telefono'=> $request->telefono,
        //     'direccion'=> $request->direccion,
        //     'barrio'=> $request->barrio,
        //     'correo'=> $request->correo,
        //     'sexo'=> $request->sexo,
        //     'id_orientacion'=> $request->id_orientacion,
        //     'id_identidad'=> $request->id_identidad,
        //     'id_curso'=> $request->id_curso,
        //     'personas_vive'=> $request->personas_vive,
        //     'area_ocurrencia'=> $request->area_ocurrencia,
        //     'regimen_salud'=> $request->regimen_salud,
        //     'eapb'=> $request->eapb,
        //     'id_grupo_poblacional'=> $request->id_grupo_poblacional,
        //     'id_discapacidad'=> $request->id_discapacidad,
        //     'semanas_gestacion'=> $request->semanas_gestacion,
        //     'lactante'=> $request->lactante,
        //     'nacionalidad'=> $request->nacionalidad,
        //     'entrada_pais'=> $request->entrada_pais,
        //     'id_estatus_migratorio'=> $request->id_estatus_migratorio,
        //     'id_etnia'=> $request->id_etnia
        // ]);

        // $userId = Identificacion::where('doc_numero',$request['doc_numero'])
        // ->select('id_user')
        // ->get()
        // ->toArray();

        // User::where('id',$userId[0]['id_user'])
        // ->update([
        //     'name' => $request->nombres,
        //     'document' => $request->doc_numero,
        //     'phone' => $request->telefono,
        //     'email' => $request->correo,
        // ]);

        // if($request['password']){
        //     User::where('id',$userId[0]['id_user'])
        //     ->update([
        //         'name' => $request['nombres'],
        //         'document' => $request['doc_numero'],
        //         'phone' => $request['telefono'],
        //         'email' => $request['correo'],
        //         'password' => Hash::make(substr($request->doc_numero, -4))
        //     ]);
        // }

        // return redirect('identificacion')->with('message','Registro Modificado con Éxito');
    }

    public function destroy($doc_numero)
    {
        // $queryID=Identificacion::where('doc_numero',$doc_numero)
        // ->select(
        //     'id_identificacion'
        // )
        // ->get()
        // ->toArray();

        // $query=Informacion::where('id_identificacion',$queryID[0]['id_identificacion'])->get();

        // if($query){
        //     return redirect('identificacion')->with('errors', 'No se puede Eliminar ya que Cuenta con una Información del Caso'); 
        // }

        // return $queryID[0]['id_identificacion'];

        // Identificacion::where('doc_numero','=',$doc_numero)->delete();

        // User::where('document','=',$doc_numero)->delete();
        // return redirect('identificacion')->with('message','Registro Eliminado con Éxito');
    }

    public function changePassword()
    {
        // return view('identificacion.change-password');
    }

    public function updatePassword(Request $request)
    {
        // # Validation
        // $request->validate([
        //     'old_password' => 'required',
        //     'new_password' => 'required|confirmed',
        // ]);


        // #Match The Old Password
        // if(!Hash::check($request->old_password, auth()->user()->password)){
        //     return back()->with("error", "Old Password Doesn't match!");
        // }


        // #Update the new Password
        // User::whereId(auth()->user()->id)->update([
        //     'password' => Hash::make($request->new_password)
        // ]);

        // return redirect('/identificacion/'.auth()->user()->id.'/index')->with("status", "Cambio de Contraseña Exitoso!");
    }
}
