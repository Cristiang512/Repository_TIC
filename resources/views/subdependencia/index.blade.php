

@extends('adminlte/layout')

@section('links')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" />
@endsection
@section('app')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- Código omitido -->
                <div class="callout callout-info" style="background-color: #D0E9F9; border-color: #96D0F9; color: #036D9C; padding: 15px;">
                    <h5><i class="fas fa-info"></i> Dependencia Responsable</h5>
                    <strong>{{$dependencia[0]->nombre}}</strong>
                </div>

                <div class="col-md-12">
                @if(Session::has('message'))
                <div class="alert alert-info">
                    <p>Información:</p>
                    <ul>
                    {{Session::get('message')}}
                    </ul>
                </div>
                @endif
                @if(Session::has('errors'))
                        <div class="alert alert-danger" role="alert">
                            <p>Información:</p>
                            <ul>
                            {{Session::get('errors')}}
                            </ul>
                        </div>
                @endif
                <form action="{{ route('guardarcarpeta', $dependencia[0]->id_dependencia) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Crear Carpeta</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nombre">Nombre*</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="desc">Descripción*</label>
                                <input type="text" name="desc" id="desc" class="form-control" required>
                            </div>

                            <input type="hidden" name="id_dependencia" id="id_dependencia" value="{{ $dependencia[0]->id_dependencia }}" >
                            <input type="hidden" name="id_subdependencia" id="id_subdependencia" value="{{0}}" >

                            <button type="submit" class="btn btn-success float-left">Crear</button>
                        </div>
                    </div>
                </form>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-center"><strong>Carpetas</strong></h4>
                                <div class="chart">
                                    <table class="table table-striped" id="identificacion">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th class="text-center">Descripción</th>
                                                <th class="text-center">Fecha Creación</th>
                                                <th class="text-center">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($carpeta as $carp)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="text-left">{{ $carp->nombre }}</td>
                                                <td class="text-center">{{ $carp->descripcion }}</td>
                                                <td class="text-center">{{ $carp->fecha_creacion }}</td>
                                                <td class="project-actions text-center">
                                                    <a class="btn btn-info btn-sm" style="background-color: #23831E;" href="{{ url('/archivo/' . $carp->id_carpeta . '/index') }}">
                                                        <i class="fas fa-folder"></i>
                                                        <span class="icon-arrow-right"></span>
                                                        <i class="fas fa-folder-open"></i>
                                                        Archivos
                                                    </a>
                                                    <a class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta carpeta?');" href="{{ url('/carpeta/' . $carp->id_carpeta . '/destroy') }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $subdependenciaData = json_decode($subdependencia, true); ?>
                @if (!empty($subdependenciaData))
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="text-center"><strong>Subdependencias</strong></h4>
                                <div class="chart">
                                    <table class="table table-striped" id="identificacion">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre</th>
                                                <th class="text-center">Archivos</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($subdependencia as $subdep)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="text-left">{{ $subdep->nombre }}</td>
                                                <td class="project-actions text-center">
                                                    <a class="btn btn-primary btn-sm" style="background-color: #23831E;" href="{{ url('/subdepe/'. $subdep->id_subdependencia.'/index') }}">
                                                        <i class="fas fa-folder"></i>
                                                        <span class="icon-arrow-right"></span>
                                                        <i class="fas fa-folder-open"></i>
                                                        <!-- Información del Caso -->
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
</div>

@endsection

<html>
    <style>
        .icon-arrow-right {
            display: inline-block;
            width: 0;
            height: 0;
            border-top: 5px solid transparent;
            border-bottom: 5px solid transparent;
            border-left: 5px solid #fff; /* Color de fondo del botón */
            margin: 0 5px; /* Espacio entre los iconos */
            animation: arrow-fade-in 1s infinite;
        }

        @keyframes arrow-fade-in {
            0% { opacity: 0; }
            50% { opacity: 1; }
            100% { opacity: 0; }
        }
    </style>
</html>

@section('javascript')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script> $('#identificacion').DataTable({
        reponsive: true,
        autoWidth: false,
        "language": {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }


    }); </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous"></script>
    @if (Session::has('info'))
        <script>
            toastr.success("{!! Session::get('info') !!}");
        </script>
    @endif
@endsection
