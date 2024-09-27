<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use App\Models\Dependencia;
use App\Models\Subdependencia;
use App\Models\User;
use App\Models\Carpeta;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use DB;

class CarpetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $datos['subdependencia'] = Subdependencia::select(
        'id_subdependencia',
        'nombre',
        )
        ->where('id_subdependencia', $id)
        ->get();

        $datos['carpeta'] = Carpeta::leftJoin('subdependencia', 'carpeta.id_subdependencia', '=', 'subdependencia.id_subdependencia')
        ->select(
        'carpeta.id_carpeta',
        'carpeta.nombre',
        'carpeta.descripcion',
        'carpeta.fecha_creacion',
        )
        ->where('carpeta.id_subdependencia', $id)
        ->get();
        return view('patient.extintores', $datos, compact('specialty', 'service'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request['id_dependencia'] == 0){
            $request['id_dependencia'] = Subdependencia::select('id_dependencia')
            ->where('id_subdependencia',$request['id_subdependencia'])
            ->first()
            ->id_dependencia;
        }else{
            $request['id_subdependencia'] = null;
        }

        // return $request;
        $now = new \DateTime();
        $registro = new Carpeta();
        $registro->nombre=$request->nombre;
        $registro->descripcion=$request->desc;
        $registro->fecha_creacion=$now->format('Y-m-d');
        $registro->id_dependencia=$request->id_dependencia;
        $registro->id_subdependencia=$request->id_subdependencia;
        $registro->save();

        return back();

        // return redirect()->route('cliente_extintor',['id'=>$registro['user_id']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Detalle  $detalle
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Detalle  $detalle
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Detalle  $detalle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Detalle  $detalle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return $id;
        $query = Archivo::where('id_carpeta', $id)->get();
        if (!$query->isEmpty()) {
            return back()->with('errors', 'No Se Puede Eliminar La Carpeta Porque Contiene Archivos');
        } 

        Carpeta::where('id_carpeta',$id)->delete();
        return back()->with('message', 'Carpeta Eliminada con Éxito');
    }

    public function ocultar($id)
    {       
        $file = Archivo::where('resultado_id',$id)->select('document')->get();
        $file_exist = '../public/Archivos/'.$file[0]['document'];
        if($file_exist){
            Archivo::where('resultado_id',$id)->delete();
            @unlink($file_exist);
            return redirect()->back();
        }else{
            return back()->with(["error"=>"File not found!"]);
        }
    }

}

