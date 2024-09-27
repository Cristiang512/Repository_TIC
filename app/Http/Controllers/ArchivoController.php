<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use App\Models\Dependencia;
use App\Models\Subdependencia;
use App\Models\Carpeta;
use App\Models\User;
use App\Models\Service;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use DB;

class ArchivoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // return $id;
        $datos['carpeta']=Carpeta::where('id_carpeta',$id)->get();
        $datos['archivo'] = Archivo::select(
        'id_archivo',
        'nombre',
        'fecha_subida'
        )
        ->where('id_carpeta','=',$id)
        ->get();

        return view('archivo.depe', $datos);
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
        // esto es para crear carpeta OJO
        // if($request['id_dependencia'] == 0){
        //     $request['id_dependencia'] = Subdependencia::select('id_dependencia')
        //     ->where('id_subdependencia',$request['id_subdependencia'])
        //     ->first()
        //     ->id_dependencia;
        // }else{
        //     $request['id_subdependencia'] = null;
        // }

        // return $request;

        $archivo=$request->file('document');
        // if(file_exists('../public/Archivos/'.$archivo->getClientOriginalName())){
        //     return redirect()->route('cliente_extintor',['id'=>$request->user_id])->with('mensaje','Ya existe un Documento con este Nombre');
        // }
        $stringRandom = Str::random(3);
        $nameFile = $archivo->getClientOriginalName();
        $s1 = explode(".",$nameFile);
        $s2 = $s1[0]."-".$stringRandom.".".$s1[1];
        // return $s2;
            
        $now = new \DateTime();
        $registro = new Archivo();
        $registro->fecha_subida = $now->format('Y-m-d');
        $registro->id_carpeta = $request->id_carpeta;
        // $registro->id_subdependencia = $request->id_subdependencia;
        
        // if ($request->hasFile('document')) {
        $archivo = $request->file('document');
        $extension = $archivo->getClientOriginalExtension();
        // $nombreSinExtension = $archivo->getClientOriginalName();
        // return $nombreSinExtension;
        $nombreArchivo = $s1[0]. "-" . $stringRandom . '.' . $extension;
        // $nombreArchivo = $nombreSinExtension . '.' . $extension;
        
        $archivo->move(public_path('Archivos'), $nombreArchivo);

        // $nombreSinExtension = pathinfo($nombreArchivo, PATHINFO_FILENAME);
        $registro->nombre = $nombreArchivo;
        
        // $registro->nombre = $nombreArchivo;
        // }
        
        $registro->save();

        


        // try{
        //     DB::beginTransaction();
        //     $now = new \DateTime();
        //     $registro = new Archivo();
        //     $registro->fecha_subida=$now->format('Y-m-d');
        //     $registro->id_dependencia=$request->id_dependencia;
        //     $registro->id_subdependencia=$request->id_subdependencia;
        //     if($request->hasFile('document')){
        //         $archivo=$request->file('document');
        //         $archivo->move(public_path().'/Archivos/',$s2);
        //         $registro->nombre=$s2;
        //     }
        //     $registro->save();
        //         DB::commit();
        // } catch (Exception $e) {
        //         DB::rollBack();
        // }

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
    public function destroy(Request $id)
    {
        //
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

