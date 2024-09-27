

@extends('adminlte/layout')

@section('links')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" />
@endsection

@section('app')
<form action="{{ route('guardararchivo', $carpeta[0]->id_carpeta) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="col-md-12">
                    @if(Session::has('message'))
                        <div class="alert alert-info">
                            <p>Información:</p>
                            <ul>
                                {{ Session::get('message') }}
                            </ul>
                        </div>
                    @endif
                    @if(Session::has('errors'))
                        <div class="alert alert-danger" role="alert">
                            <p>Información:</p>
                            <ul>
                                {{ Session::get('errors') }}
                            </ul>
                        </div>
                    @endif
                    <div class="callout callout-info" style="background-color: #f0f0f0; border-left: 5px solid #17a2b8; padding: 10px;">
                        <div style="display: flex; align-items: center;">
                            <i class="fas fa-folder" style="font-size: 24px; color: #17a2b8; margin-right: 10px;"></i>
                            <h5 style="margin-bottom: 0;"><strong>Carpeta</strong></h5>
                        </div>
                        <div style="margin-top: 5px;">
                            <p style="font-size: 16px; margin-bottom: 0;"><strong>{{ $carpeta[0]->nombre }}</strong></p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="text-center"><strong>Archivos Cargados</strong></h4>
                                    <div class="chart">
                                        <table class="table table-striped" id="identificacion">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nombre</th>
                                                    <th class="text-center">Fecha de Subida</th>
                                                    <th>Ver</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($archivo as $file)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td class="text-left">{{ $file->nombre }}</td>
                                                        <td class="text-center">{{ $file->fecha_subida }}</td>
                                                        <td>
                                                            <a class="far fa-eye" style="color:black" target="_blank" href="{{ asset('Archivos/'.$file->nombre) }}" enctype="multipart/form-data"></a>
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

                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title" style="text-align: center"><strong>Cargar Archivo</strong></h1>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div role="form">
                                        <div class="row">
                                            <input type="hidden" name="id_carpeta" id="id_carpeta" value="{{ $carpeta[0]->id_carpeta }}" >
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="document">Archivo</label>
                                                    <input type="file" name="document" id="document" class="form-control" accept="application/pdf, image/jpeg, image/jpg, image/png, video/*, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, text/plain, application/octet-stream, application/x-rar-compressed, application/zip" required>
                                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                                    <script>
                                                        $(document).ready(function() {
                                                            $('#document').on('change', function() {
                                                                var file = this.files[0];
                                                                var maxSizeInBytes = 10485760; // 10MB

                                                                if (file.size > maxSizeInBytes) {
                                                                    alert('El tamaño del archivo excede el límite máximo de 10MB.');
                                                                    // Restablecer el valor del campo de archivo
                                                                    $(this).val('');
                                                                }
                                                            });
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success">Cargar</button>
                                <a href="javascript:history.back()" class="btn btn-danger btn-sm ml-2">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</form>

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
