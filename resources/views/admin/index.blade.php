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
                @if(Session::has('mensaje'))
                <div class="alert alert-info">
                    <p class="mb-0">Información:</p>
                    <ul class="mb-0">
                        {{ Session::get('mensaje') }}
                    </ul>
                </div>
                @endif
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <!-- <h3 class="card-title"><strong>ADMINISTRADORES</strong></h3> -->
                        <a href="{{ route('register') }}" class="btn btn-success">Agregar Administrador</a>
                        <div class="card-tools">
                            {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-center mb-4"><strong>Lista de Administradores</strong></p>
                                <div class="chart">
                                    <table class="table table-striped table-bordered" id="admin">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Nombre y Apellido</th>
                                                <th>Número de Documento</th>
                                                <th>Correo Electrónico</th>
                                                <th>Tipo</th>
                                                <th>Dependencia</th>
                                                <th>Subdependencia</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($admin as $admin)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $admin->name }}</td>
                                                    <td>{{ $admin->document }}</td>
                                                    <td>{{ $admin->email }}</td>
                                                    <td>{{ $admin->tipo }}</td>
                                                    <td>
                                                        @if ($admin->rol_id == 1)
                                                            Acceso a Todas
                                                        @else
                                                            {{ $admin->depe }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($admin->subdepe == null)
                                                            Acceso a Todas
                                                        @else
                                                            {{ $admin->subdepe }}
                                                        @endif
                                                    </td>
                                                    <!-- <td>{{ $admin->depe }}</td>
                                                    <td>{{ $admin->subdepe }}</td> -->
                                                    <td>
                                                        <a href="{{ url('/admin/' . $admin->id . '/edit') }}" class="btn btn-sm btn-primary" title="Modificar">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form method="post" action="{{ url('/admin/' . $admin->id) }}" style="display: inline-block;">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Borrar?');" title="Eliminar">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
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
    <script> $('#admin').DataTable({
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
