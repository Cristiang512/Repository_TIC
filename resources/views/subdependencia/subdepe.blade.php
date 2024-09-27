

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
                    <p><strong>Información:</strong></p>
                    <ul>
                        {{ Session::get('message') }}
                    </ul>
                </div>
                @endif
                @if(Session::has('errors'))
                <div class="alert alert-danger" role="alert">
                    <p><strong>Información:</strong></p>
                    <ul>
                        {{ Session::get('errors') }}
                    </ul>
                </div>
                @endif
                <div class="callout callout-info" style="background-color: #f0f0f0; border-left: 5px solid #17a2b8;">
                    <h5 style="margin-bottom: 10px;"><i class="fas fa-info-circle" style="color: #17a2b8; margin-right: 5px;"></i> Subdependencias Responsable</h5>
                    <strong style="font-size: 18px; color: #333;">{{ $subdependencia[0]->nombre }}</strong>
                </div>

                <!-- <a href="javascript:history.back()" class="btn btn-secondary mb-3"><i class="fas fa-chevron-left"></i> Regresar</a> -->


                <form action="{{ route('guardarcarpeta', $subdependencia[0]->id_subdependencia) }}" method="POST" enctype="multipart/form-data">
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
                            <input type="hidden" name="id_dependencia" id="id_dependencia" value="{{ 0 }}" >
                            <input type="hidden" name="id_subdependencia" id="id_subdependencia" value="{{ $subdependencia[0]->id_subdependencia }}" >
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
                                                <td classclass="project-actions text-center">
                                                    <a class="btn btn-info btn-sm" href="{{ url('/archivo/' . $carp->id_carpeta . '/index') }}">
                                                        <i class="fas fa-folder"></i> Archivos
                                                    </a>
                                                    <a class="btn btn-danger btn-sm" onclick="return confirm('¿Borrar?');" href="{{ url('/carpeta/' . $carp->id_carpeta . '/destroy') }}">
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
            </div>
        </div>
    </section>
</div>

@endsection

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
