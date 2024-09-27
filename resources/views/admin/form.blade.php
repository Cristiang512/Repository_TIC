
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
@if (count($errors)>0)
   <div class="alert alert-danger" role="alert">
     <ul>
        @foreach ($errors->all() as $error)
         <li>
         {{ $error}}
         </li>
        @endforeach
     </ul>
   </div>
@endif

<!-- right column -->
<!--/.col (left) -->
<div class="col-md-12">
   <!-- general form elements -->
   <div class="card card-primary">
      <div class="card-header">
         <h3 class="card-title">Administrador</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <div role="form">
         <div class="card-body">
         <div class="row">
            <div class="col-md-4">
               <div class="form-group">
                  <label for="name">Nombre y Apellido</label>
                  <input type="text" name="name" id="name" class="form-control {{$errors->has('name')?'is-invalid' : ''}}"
                  value="{{ isset($admin->name)?$admin->name:old('name')}}">
                  {!! $errors->first('name','<div class="invalid-feedback">:message</div>')!!}
               </div>
            </div>

            <div class="col-md-4">
               <div class="form-group">
                  <label for="document">Número de Documento</label>
                  <input type="number" name="document" id="document" class="form-control {{$errors->has('document')?'is-invalid' : ''}}"
                  value="{{ isset($admin->document)?$admin->document:old('document')}}">
                  {!! $errors->first('document','<div class="invalid-feedback">:message</div>')!!}
               </div>
            </div>

            <div class="col-md-4">
                  <div class="form-group">
                     <label for="tipo">Tipo</label>
                     <!-- <label for="phone">Cédula</label> -->
                     <select name="tipo" id="tipo" class="form-control {{$errors->has('tipo')?'is-invalid' : ''}}">
                        <option
                        value="" > Seleccione...
                        </option>
                        <option value="Administrador" {{ $modo == 'crear' ? 'Administrador' : ($admin->tipo == 'Administrador' ? 'selected' : '' ) }}>Administrador</option>
                        <option value="Funcionario" {{ $modo == 'crear' ? 'Funcionario' : ($admin->tipo == 'Funcionario' ? 'selected' : '' ) }}>Funcionario</option>
                     </select>
                  </div>
            </div>
         </div>

         <div class="row">
            <div class="col-md-5">
               <div class="form-group">
                  <label for="email">Correo Electrónico</label>
                  <input type="email" name="email" id="email" class="form-control {{$errors->has('email')?'is-invalid' : ''}}"
                  value="{{ isset($admin->email)?$admin->email:old('email')}}">
                  {!! $errors->first('email','<div class="invalid-feedback">:message</div>')!!}
               </div>
            </div>

            <div class="col-md-7">
               <div class="form-group">
                  <label for="password" name="password" id="password" class="col-md-2">¿Reestablecer contraseña?</label>
                  <input type="checkbox" class="largerCheckbox" id="cbox" name="password" value="1">
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-6">
               <button type="submit" class="btn btn-block btn-warning">{{ $modo == 'crear' ? 'Agregar Paciente' : 'Modificar Administrador'}}</button>
            </div>
            <div class="col-md-6">
               <a href="{{url('admin')}}" class="btn btn-block btn-danger">Regresar</a>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
