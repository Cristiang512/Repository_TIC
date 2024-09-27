<?php

namespace App\Exports;

use App\Models\Informacion;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
// use Maatwebsite\Excel\Concerns\Importable;

class InformacionExport implements FromView
{
    protected $inicio;
    protected $fin;
    protected $tipo;


    public function __construct($inicio, $fin, $tipo)
    {
        $this->inicio = $inicio;
        $this->fin = $fin;
        $this->tipo = $tipo;
    }

    public function view(): View
    {

        switch ($this->tipo) {
            case 1:
                return view('informacion.export', [
                    'informacion' => Informacion::leftJoin('identificacion','informacion.id_identificacion','=','identificacion.id_identificacion')
                    ->leftJoin('municipio', 'municipio.id_municipio', '=', 'identificacion.id_municipio')
                    ->leftJoin('tipo_violencia', 'tipo_violencia.id_tipo_violencia', '=', 'informacion.id_tipo_violencia')
                    ->leftJoin('actividad_vs', 'actividad_vs.id_actividad_vs', '=', 'informacion.id_actividad_vs')
                    ->leftJoin('ambito', 'ambito.id_ambito', '=', 'informacion.id_ambito')
                    ->leftJoin('users', 'users.id', '=', 'identificacion.id_lider_seguimiento')
                    ->select(
                    'identificacion.estado_referencia',
                    'users.name',
                    'identificacion.instancia_remite',
                    'municipio.nombre_municipio',
                    'actividad_vs.actividad',
                    'tipo_violencia.violencia',
                    'ambito.ambito',
                    'informacion.fecha_hecho'
                    )
                    ->where('identificacion.estado_referencia','Caso Abierto')
                    ->whereBetween('informacion.fecha_hecho', [$this->inicio, $this->fin])
                    ->get()
                ]);
                break;
            case 2:
                return view('informacion.export', [
                    'informacion' => Informacion::leftJoin('identificacion','informacion.id_identificacion','=','identificacion.id_identificacion')
                    ->leftJoin('municipio', 'municipio.id_municipio', '=', 'identificacion.id_municipio')
                    ->leftJoin('tipo_violencia', 'tipo_violencia.id_tipo_violencia', '=', 'informacion.id_tipo_violencia')
                    ->leftJoin('actividad_vs', 'actividad_vs.id_actividad_vs', '=', 'informacion.id_actividad_vs')
                    ->leftJoin('ambito', 'ambito.id_ambito', '=', 'informacion.id_ambito')
                    ->leftJoin('users', 'users.id', '=', 'identificacion.id_lider_seguimiento')
                    ->select(
                    'identificacion.estado_referencia',
                    'users.name',
                    'identificacion.instancia_remite',
                    'municipio.nombre_municipio',
                    'actividad_vs.actividad',
                    'tipo_violencia.violencia',
                    'ambito.ambito',
                    'informacion.fecha_hecho'
                    )
                    ->where('identificacion.estado_referencia','Caso Cerrado')
                    ->whereBetween('informacion.fecha_hecho', [$this->inicio, $this->fin])
                    ->get()
                ]);
                break;
            case 3:
                return view('informacion.export', [
                    'informacion' => Informacion::leftJoin('identificacion','informacion.id_identificacion','=','identificacion.id_identificacion')
                    ->leftJoin('municipio', 'municipio.id_municipio', '=', 'identificacion.id_municipio')
                    ->leftJoin('tipo_violencia', 'tipo_violencia.id_tipo_violencia', '=', 'informacion.id_tipo_violencia')
                    ->leftJoin('actividad_vs', 'actividad_vs.id_actividad_vs', '=', 'informacion.id_actividad_vs')
                    ->leftJoin('ambito', 'ambito.id_ambito', '=', 'informacion.id_ambito')
                    ->leftJoin('users', 'users.id', '=', 'identificacion.id_lider_seguimiento')
                    ->select(
                    'identificacion.estado_referencia',
                    'users.name',
                    'identificacion.instancia_remite',
                    'municipio.nombre_municipio',
                    'actividad_vs.actividad',
                    'tipo_violencia.violencia',
                    'ambito.ambito',
                    'informacion.fecha_hecho'
                    )
                    ->whereBetween('tipo_violencia.id_tipo_violencia',['5','11'])
                    ->whereBetween('informacion.fecha_hecho', [$this->inicio, $this->fin])
                    ->get()
                ]);
                break;
            case 4:
                return view('informacion.export', [
                    'informacion' => Informacion::leftJoin('identificacion','informacion.id_identificacion','=','identificacion.id_identificacion')
                    ->leftJoin('municipio', 'municipio.id_municipio', '=', 'identificacion.id_municipio')
                    ->leftJoin('tipo_violencia', 'tipo_violencia.id_tipo_violencia', '=', 'informacion.id_tipo_violencia')
                    ->leftJoin('actividad_vs', 'actividad_vs.id_actividad_vs', '=', 'informacion.id_actividad_vs')
                    ->leftJoin('ambito', 'ambito.id_ambito', '=', 'informacion.id_ambito')
                    ->leftJoin('users', 'users.id', '=', 'identificacion.id_lider_seguimiento')
                    ->select(
                    'identificacion.estado_referencia',
                    'users.name',
                    'identificacion.instancia_remite',
                    'municipio.nombre_municipio',
                    'actividad_vs.actividad',
                    'tipo_violencia.violencia',
                    'ambito.ambito',
                    'informacion.fecha_hecho'
                    )
                    ->whereBetween('tipo_violencia.id_tipo_violencia',['1','4'])
                    ->whereBetween('informacion.fecha_hecho', [$this->inicio, $this->fin])
                    ->get()
                ]);
                break;
            case 5:
                return view('informacion.export', [
                    'informacion' => Informacion::leftJoin('identificacion','informacion.id_identificacion','=','identificacion.id_identificacion')
                    ->leftJoin('municipio', 'municipio.id_municipio', '=', 'identificacion.id_municipio')
                    ->leftJoin('tipo_violencia', 'tipo_violencia.id_tipo_violencia', '=', 'informacion.id_tipo_violencia')
                    ->leftJoin('actividad_vs', 'actividad_vs.id_actividad_vs', '=', 'informacion.id_actividad_vs')
                    ->leftJoin('ambito', 'ambito.id_ambito', '=', 'informacion.id_ambito')
                    ->leftJoin('users', 'users.id', '=', 'identificacion.id_lider_seguimiento')
                    ->select(
                    'identificacion.estado_referencia',
                    'users.name',
                    'identificacion.instancia_remite',
                    'municipio.nombre_municipio',
                    'actividad_vs.actividad',
                    'tipo_violencia.violencia',
                    'ambito.ambito',
                    'informacion.fecha_hecho'
                    )
                    ->where('ambito.id_ambito','1')
                    ->whereBetween('informacion.fecha_hecho', [$this->inicio, $this->fin])
                    ->get()
                ]);
                break;
            case 6:
                return view('informacion.export', [
                    'informacion' => Informacion::leftJoin('identificacion','informacion.id_identificacion','=','identificacion.id_identificacion')
                    ->leftJoin('municipio', 'municipio.id_municipio', '=', 'identificacion.id_municipio')
                    ->leftJoin('tipo_violencia', 'tipo_violencia.id_tipo_violencia', '=', 'informacion.id_tipo_violencia')
                    ->leftJoin('actividad_vs', 'actividad_vs.id_actividad_vs', '=', 'informacion.id_actividad_vs')
                    ->leftJoin('ambito', 'ambito.id_ambito', '=', 'informacion.id_ambito')
                    ->leftJoin('users', 'users.id', '=', 'identificacion.id_lider_seguimiento')
                    ->select(
                    'identificacion.estado_referencia',
                    'users.name',
                    'identificacion.instancia_remite',
                    'municipio.nombre_municipio',
                    'actividad_vs.actividad',
                    'tipo_violencia.violencia',
                    'ambito.ambito',
                    'informacion.fecha_hecho'
                    )
                    ->where('ambito.id_ambito','2')
                    ->whereBetween('informacion.fecha_hecho', [$this->inicio, $this->fin])
                    ->get()
                ]);
                break;
            case 7:
                return view('informacion.export', [
                    'informacion' => Informacion::leftJoin('identificacion','informacion.id_identificacion','=','identificacion.id_identificacion')
                    ->leftJoin('municipio', 'municipio.id_municipio', '=', 'identificacion.id_municipio')
                    ->leftJoin('tipo_violencia', 'tipo_violencia.id_tipo_violencia', '=', 'informacion.id_tipo_violencia')
                    ->leftJoin('actividad_vs', 'actividad_vs.id_actividad_vs', '=', 'informacion.id_actividad_vs')
                    ->leftJoin('ambito', 'ambito.id_ambito', '=', 'informacion.id_ambito')
                    ->leftJoin('users', 'users.id', '=', 'identificacion.id_lider_seguimiento')
                    ->select(
                    'identificacion.estado_referencia',
                    'users.name',
                    'identificacion.instancia_remite',
                    'municipio.nombre_municipio',
                    'actividad_vs.actividad',
                    'tipo_violencia.violencia',
                    'ambito.ambito',
                    'informacion.fecha_hecho'
                    )
                    ->where('ambito.id_ambito','3')
                    ->whereBetween('informacion.fecha_hecho', [$this->inicio, $this->fin])
                    ->get()
                ]);
                break;
            case 8:
                return view('informacion.export', [
                    'informacion' => Informacion::leftJoin('identificacion','informacion.id_identificacion','=','identificacion.id_identificacion')
                    ->leftJoin('municipio', 'municipio.id_municipio', '=', 'identificacion.id_municipio')
                    ->leftJoin('tipo_violencia', 'tipo_violencia.id_tipo_violencia', '=', 'informacion.id_tipo_violencia')
                    ->leftJoin('actividad_vs', 'actividad_vs.id_actividad_vs', '=', 'informacion.id_actividad_vs')
                    ->leftJoin('ambito', 'ambito.id_ambito', '=', 'informacion.id_ambito')
                    ->leftJoin('users', 'users.id', '=', 'identificacion.id_lider_seguimiento')
                    ->select(
                    'identificacion.estado_referencia',
                    'users.name',
                    'identificacion.instancia_remite',
                    'municipio.nombre_municipio',
                    'actividad_vs.actividad',
                    'tipo_violencia.violencia',
                    'ambito.ambito',
                    'informacion.fecha_hecho'
                    )
                    ->where('ambito.id_ambito','4')
                    ->whereBetween('informacion.fecha_hecho', [$this->inicio, $this->fin])
                    ->get()
                ]);
                break;
            case 9:
                return view('informacion.export', [
                    'informacion' => Informacion::leftJoin('identificacion','informacion.id_identificacion','=','identificacion.id_identificacion')
                    ->leftJoin('municipio', 'municipio.id_municipio', '=', 'identificacion.id_municipio')
                    ->leftJoin('tipo_violencia', 'tipo_violencia.id_tipo_violencia', '=', 'informacion.id_tipo_violencia')
                    ->leftJoin('actividad_vs', 'actividad_vs.id_actividad_vs', '=', 'informacion.id_actividad_vs')
                    ->leftJoin('ambito', 'ambito.id_ambito', '=', 'informacion.id_ambito')
                    ->leftJoin('users', 'users.id', '=', 'identificacion.id_lider_seguimiento')
                    ->select(
                    'identificacion.estado_referencia',
                    'users.name',
                    'identificacion.instancia_remite',
                    'municipio.nombre_municipio',
                    'actividad_vs.actividad',
                    'tipo_violencia.violencia',
                    'ambito.ambito',
                    'informacion.fecha_hecho'
                    )
                    ->where('ambito.id_ambito','5')
                    ->whereBetween('informacion.fecha_hecho', [$this->inicio, $this->fin])
                    ->get()
                ]);
                break;
            case 10:
                return view('informacion.export', [
                    'informacion' => Informacion::leftJoin('identificacion','informacion.id_identificacion','=','identificacion.id_identificacion')
                    ->leftJoin('municipio', 'municipio.id_municipio', '=', 'identificacion.id_municipio')
                    ->leftJoin('tipo_violencia', 'tipo_violencia.id_tipo_violencia', '=', 'informacion.id_tipo_violencia')
                    ->leftJoin('actividad_vs', 'actividad_vs.id_actividad_vs', '=', 'informacion.id_actividad_vs')
                    ->leftJoin('ambito', 'ambito.id_ambito', '=', 'informacion.id_ambito')
                    ->leftJoin('users', 'users.id', '=', 'identificacion.id_lider_seguimiento')
                    ->select(
                    'identificacion.estado_referencia',
                    'users.name',
                    'identificacion.instancia_remite',
                    'municipio.nombre_municipio',
                    'actividad_vs.actividad',
                    'tipo_violencia.violencia',
                    'ambito.ambito',
                    'informacion.fecha_hecho'
                    )
                    ->where('ambito.id_ambito','6')
                    ->whereBetween('informacion.fecha_hecho', [$this->inicio, $this->fin])
                    ->get()
                ]);
                break;
            case 11:
                return view('informacion.export', [
                    'informacion' => Informacion::leftJoin('identificacion','informacion.id_identificacion','=','identificacion.id_identificacion')
                    ->leftJoin('municipio', 'municipio.id_municipio', '=', 'identificacion.id_municipio')
                    ->leftJoin('tipo_violencia', 'tipo_violencia.id_tipo_violencia', '=', 'informacion.id_tipo_violencia')
                    ->leftJoin('actividad_vs', 'actividad_vs.id_actividad_vs', '=', 'informacion.id_actividad_vs')
                    ->leftJoin('ambito', 'ambito.id_ambito', '=', 'informacion.id_ambito')
                    ->leftJoin('users', 'users.id', '=', 'identificacion.id_lider_seguimiento')
                    ->select(
                    'identificacion.estado_referencia',
                    'users.name',
                    'identificacion.instancia_remite',
                    'municipio.nombre_municipio',
                    'actividad_vs.actividad',
                    'tipo_violencia.violencia',
                    'ambito.ambito',
                    'informacion.fecha_hecho'
                    )
                    ->where('ambito.id_ambito','7')
                    ->whereBetween('informacion.fecha_hecho', [$this->inicio, $this->fin])
                    ->get()
                ]);
                break;
        }
        return view('informacion.export', [
            'products' => Informacion::all()
        ]);
    }
}