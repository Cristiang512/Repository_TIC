

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
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="text-center" style="color: #23831E; font-weight: bold;">
                                    Dependencias de la Alcaldía Municipal San José de Cúcuta
                                </h2>
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
                                            @foreach ($dependencia as $dependencia)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$dependencia->nombre}}</td>
                                                <td class="project-actions text-center">
                                                    <a class="btn btn-primary btn-sm" style="background-color: #23831E;" href="{{ url('/subdependencia/'. $dependencia->id_dependencia.'/index') }}" >
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

