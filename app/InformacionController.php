<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Identificacion;
use App\Models\Parentesco;
use App\Models\TipoViolencia;
use App\Models\ActividadVS;
use App\Models\NoFamiliar;
use App\Models\MecanismoAgresion;
use App\Models\SitioComprometido;
use App\Models\Escenario;
use App\Models\Ambito;
use App\Models\Salud;
use App\Models\Justicia;
use App\Models\Proteccion;

use App\Models\Municipio;
use App\Models\TipoDocumento;
use Illuminate\Http\Request;
use Illuminate\Http\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Models\Informacion;
use Maatwebsite\Excel\Concerns\ToArray;
use PhpParser\Node\Stmt\TryCatch;

class InformacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $datos['identificacion'] = Identificacion::leftJoin('tipo_documento', 'tipo_documento.id_tipo_documento', '=', 'identificacion.id_tipo_documento')
        ->select(
        'identificacion.id_identificacion',
        'identificacion.nombres as nombre',
        'identificacion.apellidos',
        'identificacion.doc_numero',
        'tipo_documento.tipo'
        )
        ->where('id_identificacion', $id)
        ->get();
        // ->toArray();
// 
        // $datos['informacion']=Informacion::where('id_identificacion', $id)->firstOrFail();
        // $datos['informacion']=Informacion::where('id_identificacion',$id)->get();

        $datos['informacion'] = Informacion::leftJoin('tipo_violencia', 'tipo_violencia.id_tipo_violencia', '=', 'informacion.id_tipo_violencia')
        ->leftJoin('mecanismo_agresion', 'mecanismo_agresion.id_mecanismo_agresion', '=', 'informacion.id_mecanismo_agresion')
        ->leftJoin('escenario', 'escenario.id_escenario', '=', 'informacion.id_escenario')
        ->leftJoin('ambito', 'ambito.id_ambito', '=', 'informacion.id_ambito')
        ->select(
        'informacion.id_informacion',
        'tipo_violencia.violencia',
        'mecanismo_agresion.mecanismo',
        'escenario.escenario',
        'ambito.ambito',
        'informacion.fecha_hecho'
        )
        ->where('id_identificacion', $id)
        ->get();

        return view('informacion.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $datos['id_identificacion'] = $id;
        $parentesco=Parentesco::all();
        $violencia=TipoViolencia::all();
        $actividad=ActividadVS::all();
        $noFamiliar=NoFamiliar::all();
        $mecanismo=MecanismoAgresion::all();
        $sitio=SitioComprometido::all();
        $escenario=Escenario::all();
        $ambito=Ambito::all();
        
        return view('informacion.create', $datos, compact('parentesco','violencia','actividad','noFamiliar','mecanismo','sitio','escenario','ambito'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return $request;
    // $campos = [
    //     // 'name' => ['required', 'string', 'max:255'],
    //     'doc_numero' => ['required', 'string', 'max:255', 'unique:identificacion'],
    //     // 'phone' => ['string', 'max:255'],
    //     'correo' => ['string', 'max:255', 'unique:identificacion'],
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

        Informacion::create([
            'id_tipo_violencia' => $request->id_tipo_violencia,
            'id_actividad_vs' => $request->id_actividad_vs,
            'sexo' => $request->sexo,
            'id_parentesco' => $request->id_parentesco,
            'convive' => $request->convive,
            'id_no_familiar' => $request->id_no_familiar,
            'id_mecanismo_agresion' => $request->id_mecanismo_agresion,
            'id_sitio_comprometido' => $request->id_sitio_comprometido,
            'grado' => $request->grado,
            'extension' => $request->extension,
            'id_escenario' => $request->id_escenario,
            'id_ambito' => $request->id_ambito,
            'fecha_hecho' => $request->fecha_hecho,
            'contextualizacion' => $request->contextualizacion,
            'id_identificacion' => $request->id_identificacion
        ]);

        return redirect('informacion/'.$request->id_identificacion.'/index')->with('message', 'Información del Caso Agregada con Éxito');  

        // return redirect()->route('identificacion',['id'=>$registro['user_id']]);
        // return redirect('identificacion')->with('message','Registro Agregado con Éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show( $identificacion)
    {
        //
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
        $informacion=Informacion::where('id_informacion', $id)->firstOrFail();
        $parentesco=Parentesco::all();
        $violencia=TipoViolencia::all();
        $actividad=ActividadVS::all();
        $noFamiliar=NoFamiliar::all();
        $mecanismo=MecanismoAgresion::all();
        $sitio=SitioComprometido::all();
        $escenario=Escenario::all();
        $ambito=Ambito::all();

        return view('informacion.edit', compact('informacion', 'parentesco','violencia','actividad','noFamiliar','mecanismo','sitio','escenario','ambito'));
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
        Informacion::where('id_informacion', $id)
        ->update([
            'id_tipo_violencia' => $request->id_tipo_violencia,
            'id_actividad_vs' => $request->id_actividad_vs,
            'sexo' => $request->sexo,
            'id_parentesco' => $request->id_parentesco,
            'convive' => $request->convive,
            'id_no_familiar' => $request->id_no_familiar,
            'id_mecanismo_agresion' => $request->id_mecanismo_agresion,
            'id_sitio_comprometido' => $request->id_sitio_comprometido,
            'grado' => $request->grado,
            'extension' => $request->extension,
            'id_escenario' => $request->id_escenario,
            'id_ambito' => $request->id_ambito,
            'fecha_hecho' => $request->fecha_hecho,
            'contextualizacion' => $request->contextualizacion
        ]);
        return redirect('informacion/'.$request->id_identificacion.'/index')->with('message', 'Información del Caso Modificada con Éxito'); 
        // return redirect('identificacion')->with('message','Registro Modificado con Éxito');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $query=Informacion::where('id_informacion',$id)
        ->select(
            'id_identificacion'
        )
        ->get()
        ->toArray();

        $queryS=Salud::where('id_informacion',$id)->get();
        $queryJ=Justicia::where('id_informacion',$id)->get();
        $queryP=Proteccion::where('id_informacion',$id)->get();

        if($queryS){
            return redirect('informacion/'.$query[0]['id_identificacion'].'/index')->with('errors', 'No se puede Eliminar ya que Cuenta con un Seguimiento Intersectorial de Salud'); 
        }
        if($queryJ){
            return redirect('informacion/'.$query[0]['id_identificacion'].'/index')->with('errors', 'No se puede Eliminar ya que Cuenta con un Seguimiento Intersectorial de Justicia'); 
        }
        if($queryP){
            return redirect('informacion/'.$query[0]['id_identificacion'].'/index')->with('errors', 'No se puede Eliminar ya que Cuenta con un Seguimiento Intersectorial de Protección'); 
        }
        
        Informacion::where('id_informacion',$id)->delete();

        return redirect('informacion/'.$query[0]['id_identificacion'].'/index')->with('message', 'Información del Caso Eliminada con Éxito'); 
    }

    public function importExcel(Request $request)
    {
        $file = $request->file('file');
        $csv = str_getcsv($file);
        return $file;
        Excel::import(new UsersImport, $file);

        return back()->with('message', 'Importanción de usuarios completada');
    }

    



    public function importExcelTest(Request $request)
    {
        $file = $request->file('file');

        function csvtoarray($archivo,$delimitador = ";"){

            if(!empty($archivo) && !empty($delimitador) && is_file($archivo)):
        
                $array_total = array();
        
                $fp = fopen($archivo,"r");
        
                while ($data = fgetcsv($fp, 10000, $delimitador)){
        
                    $num = count($data);
        
                    $array_total[] = array_map("utf8_encode",$data);
        
                }
        
                fclose($fp);
        
                return $array_total;
        
            else:
        
                return false;
        
            endif;
        
        }

        $arraycsv = csvtoarray($file);

        foreach( $arraycsv AS $row ) {
            User::insertOrIgnore([
                'name'     => $row[0], //a
                    'document'    => $row[1], //b
                    'phone'    => $row[2], //c
                    'email'    => $row[3], //d
                    'password' => bcrypt(substr($row[1], -4)), //e
                    'rol_id'    => 2, //f
                ]);
        }
        return back()->with('message', 'Importanción de usuarios completada');

    }

    public function changePassword()
    {
        return view('identificacion.change-password');
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
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect('/identificacion/'.auth()->user()->id.'/index')->with("status", "Cambio de Contraseña Exitoso!");
    }
}
