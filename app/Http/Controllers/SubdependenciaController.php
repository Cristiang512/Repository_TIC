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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Models\Archivo;
use App\Models\Informacion;
use App\Models\Subdependencia;
use App\Models\Dependencia;
use App\Models\Carpeta;

class SubdependenciaController extends Controller
{
    public function index($id)
    {

        // return $id;
        $datos['subdependencia'] = Subdependencia::leftJoin('dependencia', 'dependencia.id_dependencia', '=', 'subdependencia.id_dependencia')
        ->select(
        'subdependencia.id_subdependencia',
        'subdependencia.nombre',
        )
        ->where('subdependencia.id_dependencia', $id)
        ->get();

        $datos['dependencia'] = Dependencia::leftJoin('subdependencia', 'dependencia.id_dependencia', '=', 'subdependencia.id_dependencia')
        ->select(
        'dependencia.id_dependencia',
        'dependencia.nombre',
        )
        ->where('dependencia.id_dependencia', $id)
        ->get();

        $datos['carpeta'] = Carpeta::leftJoin('dependencia', 'carpeta.id_dependencia', '=', 'dependencia.id_dependencia')
        ->select(
        'carpeta.id_carpeta',
        'carpeta.nombre',
        'carpeta.descripcion',
        'carpeta.fecha_creacion',
        )
        ->where('carpeta.id_dependencia', $id)
        ->whereNull('carpeta.id_subdependencia')
        ->get();

        $datos['archivo'] = Archivo::all();



        // $datos['dependencia'] = Informacion::leftJoin('tipo_violencia', 'tipo_violencia.id_tipo_violencia', '=', 'informacion.id_tipo_violencia')
        // ->leftJoin('mecanismo_agresion', 'mecanismo_agresion.id_mecanismo_agresion', '=', 'informacion.id_mecanismo_agresion')
        // ->leftJoin('escenario', 'escenario.id_escenario', '=', 'informacion.id_escenario')
        // ->leftJoin('ambito', 'ambito.id_ambito', '=', 'informacion.id_ambito')
        // ->select(
        // 'informacion.id_informacion',
        // 'tipo_violencia.violencia',
        // 'mecanismo_agresion.mecanismo',
        // 'escenario.escenario',
        // 'ambito.ambito',
        // 'informacion.fecha_hecho'
        // )
        // ->where('id_identificacion', $id)
        // ->get();

        return view('subdependencia.index', $datos);
    }

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

    // public function store(Request $request)
    // {
    //     Informacion::create([
    //         'id_tipo_violencia' => $request->id_tipo_violencia,
    //         'id_actividad_vs' => $request->id_actividad_vs,
    //         'sexo' => $request->sexo,
    //         'id_parentesco' => $request->id_parentesco,
    //         'convive' => $request->convive,
    //         'id_no_familiar' => $request->id_no_familiar,
    //         'id_mecanismo_agresion' => $request->id_mecanismo_agresion,
    //         'id_sitio_comprometido' => $request->id_sitio_comprometido,
    //         'grado' => $request->grado,
    //         'extension' => $request->extension,
    //         'id_escenario' => $request->id_escenario,
    //         'id_ambito' => $request->id_ambito,
    //         'fecha_hecho' => $request->fecha_hecho,
    //         'contextualizacion' => $request->contextualizacion,
    //         'id_identificacion' => $request->id_identificacion
    //     ]);

    //     return redirect('informacion/'.$request->id_identificacion.'/index')->with('message', 'Información del Caso Agregada con Éxito');  

    // }

    // public function edit($id)
    // {
    //     $informacion=Informacion::where('id_informacion', $id)->firstOrFail();
    //     $parentesco=Parentesco::all();
    //     $violencia=TipoViolencia::all();
    //     $actividad=ActividadVS::all();
    //     $noFamiliar=NoFamiliar::all();
    //     $mecanismo=MecanismoAgresion::all();
    //     $sitio=SitioComprometido::all();
    //     $escenario=Escenario::all();
    //     $ambito=Ambito::all();

    //     return view('informacion.edit', compact('informacion', 'parentesco','violencia','actividad','noFamiliar','mecanismo','sitio','escenario','ambito'));
    // }

    // public function ver($id)
    // {
    //     $informacion=Informacion::where('id_informacion', $id)->firstOrFail();
    //     $parentesco=Parentesco::all();
    //     $violencia=TipoViolencia::all();
    //     $actividad=ActividadVS::all();
    //     $noFamiliar=NoFamiliar::all();
    //     $mecanismo=MecanismoAgresion::all();
    //     $sitio=SitioComprometido::all();
    //     $escenario=Escenario::all();
    //     $ambito=Ambito::all();

    //     return view('vs.form', compact('informacion', 'parentesco','violencia','actividad','noFamiliar','mecanismo','sitio','escenario','ambito'));
    // }

    // public function update(Request $request, $id)
    // {
    //     Informacion::where('id_informacion', $id)
    //     ->update([
    //         'id_tipo_violencia' => $request->id_tipo_violencia,
    //         'id_actividad_vs' => $request->id_actividad_vs,
    //         'sexo' => $request->sexo,
    //         'id_parentesco' => $request->id_parentesco,
    //         'convive' => $request->convive,
    //         'id_no_familiar' => $request->id_no_familiar,
    //         'id_mecanismo_agresion' => $request->id_mecanismo_agresion,
    //         'id_sitio_comprometido' => $request->id_sitio_comprometido,
    //         'grado' => $request->grado,
    //         'extension' => $request->extension,
    //         'id_escenario' => $request->id_escenario,
    //         'id_ambito' => $request->id_ambito,
    //         'fecha_hecho' => $request->fecha_hecho,
    //         'contextualizacion' => $request->contextualizacion
    //     ]);
    //     return redirect('informacion/'.$request->id_identificacion.'/index')->with('message', 'Información del Caso Modificada con Éxito'); 
    // }

    // public function destroy($id)
    // {
    //     $query=Informacion::where('id_informacion',$id)
    //     ->select(
    //         'id_identificacion'
    //     )
    //     ->get()
    //     ->toArray();

    //     $queryS=Salud::where('id_informacion',$id)->get();
    //     $queryJ=Justicia::where('id_informacion',$id)->get();
    //     $queryP=Proteccion::where('id_informacion',$id)->get();

    //     if($queryS){
    //         return redirect('informacion/'.$query[0]['id_identificacion'].'/index')->with('errors', 'No se puede Eliminar ya que Cuenta con un Seguimiento Intersectorial de Salud'); 
    //     }
    //     if($queryJ){
    //         return redirect('informacion/'.$query[0]['id_identificacion'].'/index')->with('errors', 'No se puede Eliminar ya que Cuenta con un Seguimiento Intersectorial de Justicia'); 
    //     }
    //     if($queryP){
    //         return redirect('informacion/'.$query[0]['id_identificacion'].'/index')->with('errors', 'No se puede Eliminar ya que Cuenta con un Seguimiento Intersectorial de Protección'); 
    //     }
        
    //     Informacion::where('id_informacion',$id)->delete();

    //     return redirect('informacion/'.$query[0]['id_identificacion'].'/index')->with('message', 'Información del Caso Eliminada con Éxito'); 
    // }

    // public function VS($id)
    // {

        
    //     $idIdenticiacion = Identificacion::select('id_identificacion')->where('id_user',$id)->get();

    //     $datos['identificacion'] = Identificacion::leftJoin('tipo_documento', 'tipo_documento.id_tipo_documento', '=', 'identificacion.id_tipo_documento')
    //     ->select(
    //     'identificacion.id_identificacion',
    //     'identificacion.nombres as nombre',
    //     'identificacion.apellidos',
    //     'identificacion.doc_numero',
    //     'tipo_documento.tipo'
    //     )
    //     ->where('id_identificacion', $idIdenticiacion[0]['id_identificacion'])
    //     ->get();

    //     $datos['informacion'] = Informacion::leftJoin('tipo_violencia', 'tipo_violencia.id_tipo_violencia', '=', 'informacion.id_tipo_violencia')
    //     ->leftJoin('mecanismo_agresion', 'mecanismo_agresion.id_mecanismo_agresion', '=', 'informacion.id_mecanismo_agresion')
    //     ->leftJoin('escenario', 'escenario.id_escenario', '=', 'informacion.id_escenario')
    //     ->leftJoin('ambito', 'ambito.id_ambito', '=', 'informacion.id_ambito')
    //     ->select(
    //     'informacion.id_informacion',
    //     'tipo_violencia.violencia',
    //     'mecanismo_agresion.mecanismo',
    //     'escenario.escenario',
    //     'ambito.ambito',
    //     'informacion.fecha_hecho'
    //     )
    //     ->where('id_identificacion', $idIdenticiacion[0]['id_identificacion'])
    //     ->get();

    //     return view('informacion.index', $datos);
    // }
}
