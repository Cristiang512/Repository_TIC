
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
        <section class="content-header">
          <div class="container-fluid">
              <section class="content-header">
                <div class="container-fluid">
                  <div class="row mb-2">
                    <div class="col-sm-6">
                      <h1>
                        Información del Caso
                      </h1>
                    </div>
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="javascript:history.back(-1);">Atrás</a></li>
                        <li class="breadcrumb-item active">Información del Caso</li>
                      </ol>
                    </div>
                  </div>
                </div>
              </section>
              <div class="col-md-12">
                  <div class="card">
                      <div class="card-body">
                          <div class="row">	
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="id_actividad_vs">Actividad de la Víctima / Sobreviviente*</label>
                                      <select name="id_actividad_vs" id="id_actividad_vs" class="form-control {{$errors->has('id_actividad_vs')?'is-invalid' : ''}}" required>
                                          <option
                                          value="" > Seleccione...
                                          </option>
                                          @foreach ($actividad as $act)
                                              <option <?php if(isset($informacion) && $act->id_actividad_vs==$informacion->id_actividad_vs){ echo "selected"; }?>
                                              value="{{ $act ['id_actividad_vs']}}" > {{ $act ['actividad']}}
                                              </option>
                                          @endforeach
                                      </select>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="id_tipo_violencia">Tipo de Violencia*</label>
                                      <select name="id_tipo_violencia" id="id_tipo_violencia" class="form-control {{$errors->has('id_tipo_violencia')?'is-invalid' : ''}}" required>
                                          <option
                                          value="" > Seleccione...
                                          </option>
                                          @foreach ($violencia as $vio)
                                              <option <?php if(isset($informacion) && $vio->id_tipo_violencia==$informacion->id_tipo_violencia){ echo "selected"; }?>
                                              value="{{ $vio ['id_tipo_violencia']}}" > {{ $vio ['violencia']}}
                                              </option>
                                          @endforeach
                                      </select>
                                    </div>
                                  </div>

                                <br>
                              <!-- </div> -->
                          </div>
                      </div>
                      <div class="card-footer">
                  </div>

                  <div class="card card-danger card-outline">
                    <div class="card-header" >
                      <h3 class="card-title">
                      <i class="fas fa-user-slash"></i>
                        Datos del Agresor
                      </h3>
                    </div>
                    <br/>
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                                <label for="sexo">Sexo*</label>
                                <select name="sexo" id="sexo" class="form-control {{$errors->has('sexo')?'is-invalid' : ''}}" required>
                                    <option
                                    value="" > Seleccione...
                                    </option>
                                    <option value="Masculino" {{ $modo == 'crear' ? 'Masculino' : ($informacion->sexo == 'Masculino' ? 'selected' : '' ) }}>Masculino</option>
                                    <option value="Femenino" {{ $modo == 'crear' ? 'Femenino' : ($informacion->sexo == 'Femenino' ? 'selected' : '' ) }}>Femenino</option>
                                    <option value="Intersexual" {{ $modo == 'crear' ? 'Intersexual' : ($informacion->sexo == 'Intersexual' ? 'selected' : '' ) }}>Intersexual</option>
                                </select>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="id_parentesco">Parentesco con la Víctima / Sobreviente*</label>
                              <select name="id_parentesco" id="id_parentesco" class="form-control {{$errors->has('id_parentesco')?'is-invalid' : ''}}" required>
                                  <option
                                  value="" > Seleccione...
                                  </option>
                                  @foreach ($parentesco as $pare)
                                      <option <?php if(isset($informacion) && $pare->id_parentesco==$informacion->id_parentesco){ echo "selected"; }?>
                                      value="{{ $pare ['id_parentesco']}}" > {{ $pare ['parentesco']}}
                                      </option>
                                  @endforeach
                              </select>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                                <label for="convive">Vive con el Agresor*</label>
                                <select name="convive" id="convive" class="form-control {{$errors->has('convive')?'is-invalid' : ''}}" required>
                                    <option
                                    value="" > Seleccione...
                                    </option>
                                    <option value="Si" {{ $modo == 'crear' ? 'Si' : ($informacion->convive == 'Si' ? 'selected' : '' ) }}>Si</option>
                                    <option value="No" {{ $modo == 'crear' ? 'No' : ($informacion->convive == 'No' ? 'selected' : '' ) }}>No</option>
                                </select>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="id_no_familiar">Agresor No Familiar*</label>
                              <select name="id_no_familiar" id="id_no_familiar" class="form-control {{$errors->has('id_no_familiar')?'is-invalid' : ''}}" required>
                                  <option
                                  value="" > Seleccione...
                                  </option>
                                  @foreach ($noFamiliar as $no)
                                      <option <?php if(isset($informacion) && $no->id_no_familiar==$informacion->id_no_familiar){ echo "selected"; }?>
                                      value="{{ $no ['id_no_familiar']}}" > {{ $no ['no_familiar']}}
                                      </option>
                                  @endforeach
                              </select>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>

                  <div class="card card-primary card-outline">
                    <div class="card-header" >
                      <h3 class="card-title">
                      <i class="fas fa-list-alt"></i>
                        Datos del Hecho
                      </h3>
                    </div>
                    <br/>
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-5">
                            <div class="form-group">
                              <label for="id_mecanismo_agresion">Mecanismo Utilizado para la Agresión*</label>
                              <select name="id_mecanismo_agresion" id="id_mecanismo_agresion" class="form-control {{$errors->has('id_mecanismo_agresion')?'is-invalid' : ''}}" required>
                                  <option
                                  value="" > Seleccione...
                                  </option>
                                  @foreach ($mecanismo as $mec)
                                      <option <?php if(isset($informacion) && $mec->id_mecanismo_agresion==$informacion->id_mecanismo_agresion){ echo "selected"; }?>
                                      value="{{ $mec ['id_mecanismo_agresion']}}" > {{ $mec ['mecanismo']}}
                                      </option>
                                  @endforeach
                              </select>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="id_sitio_comprometido">Sitio Anatómico Comprometido en Quemadura*</label>
                              <select name="id_sitio_comprometido" id="id_sitio_comprometido" class="form-control {{$errors->has('id_sitio_comprometido')?'is-invalid' : ''}}" required>
                                  <option
                                  value="" > Seleccione...
                                  </option>
                                  @foreach ($sitio as $sit)
                                      <option <?php if(isset($informacion) && $sit->id_sitio_comprometido==$informacion->id_sitio_comprometido){ echo "selected"; }?>
                                      value="{{ $sit ['id_sitio_comprometido']}}" > {{ $sit ['sitio_comprometido']}}
                                      </option>
                                  @endforeach
                              </select>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                                <label for="grado">Grado*</label>
                                <select name="grado" id="grado" class="form-control {{$errors->has('grado')?'is-invalid' : ''}}" required>
                                    <option
                                    value="" > Seleccione...
                                    </option>
                                    <option value="Primer grado" {{ $modo == 'crear' ? 'Primer grado' : ($informacion->grado == 'Primer grado' ? 'selected' : '' ) }}>Primer grado</option>
                                    <option value="Segundo grado" {{ $modo == 'crear' ? 'Segundo grado' : ($informacion->grado == 'Segundo grado' ? 'selected' : '' ) }}>Segundo grado</option>
                                    <option value="Tercer grado" {{ $modo == 'crear' ? 'Tercer grado' : ($informacion->grado == 'Tercer grado' ? 'selected' : '' ) }}>Tercer grado</option>
                                </select>
                            </div>
                          </div>
                        </div>

                        <hr>

                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                                <label for="extension">Extensión*</label>
                                <select name="extension" id="extension" class="form-control {{$errors->has('extension')?'is-invalid' : ''}}" required>
                                    <option
                                    value="" > Seleccione...
                                    </option>
                                    <option value="Menor o igual al 5%" {{ $modo == 'crear' ? 'Menor o igual al 5%' : ($informacion->extension == 'Menor o igual al 5%' ? 'selected' : '' ) }}>Menor o igual al 5%</option>
                                    <option value="Del 6% al 14%" {{ $modo == 'crear' ? 'Del 6% al 14%' : ($informacion->extension == 'Del 6% al 14%' ? 'selected' : '' ) }}>Del 6% al 14%</option>
                                    <option value="Mayor o igual al 15%" {{ $modo == 'crear' ? 'Mayor o igual al 15%' : ($informacion->extension == 'Mayor o igual al 15%' ? 'selected' : '' ) }}>Mayor o igual al 15%</option>
                                </select>
                            </div>
                          </div>

                          <div class="col-md-5">
                            <div class="form-group">
                              <label for="id_escenario">Escenario*</label>
                              <select name="id_escenario" id="id_escenario" class="form-control {{$errors->has('id_escenario')?'is-invalid' : ''}}" required>
                                  <option
                                  value="" > Seleccione...
                                  </option>
                                  @foreach ($escenario as $esc)
                                      <option <?php if(isset($informacion) && $esc->id_escenario==$informacion->id_escenario){ echo "selected"; }?>
                                      value="{{ $esc ['id_escenario']}}" > {{ $esc ['escenario']}}
                                      </option>
                                  @endforeach
                              </select>
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <label for="id_ambito">Ámbito de la Violencia Según Lugar de Ocurrencia*</label>
                              <select name="id_ambito" id="id_ambito" class="form-control {{$errors->has('id_ambito')?'is-invalid' : ''}}" required>
                                  <option
                                  value="" > Seleccione...
                                  </option>
                                  @foreach ($ambito as $amb)
                                      <option <?php if(isset($informacion) && $amb->id_ambito==$informacion->id_ambito){ echo "selected"; }?>
                                      value="{{ $amb ['id_ambito']}}" > {{ $amb ['ambito']}}
                                      </option>
                                  @endforeach
                              </select>
                            </div>
                          </div>
                        </div>

                        <hr>

                        <div class="row">
                          <div class="col-md-2">
                            <div class="form-group">
                              <label for="fecha_hecho">Fecha del Hecho*</label>
                              <input type="date" name="fecha_hecho" id="fecha_hecho" class="form-control {{$errors->has('fecha_hecho')?'is-invalid' : ''}}"
                                value="{{ isset($informacion->fecha_hecho)?$informacion->fecha_hecho:old('fecha_hecho')}}" required>
                                {!! $errors->first('fecha_hecho','<div class="invalid-feedback">:message</div>')!!}
                            </div>
                          </div>

                          <div class="col-md-10">
                            <div class="form-group">
                              <label for="contextualizacion">Contextualización del Caso*</label>
                              <input type="text" name="contextualizacion" id="contextualizacion" class="form-control {{$errors->has('contextualizacion')?'is-invalid' : ''}}"
                                value="{{ isset($informacion->contextualizacion)?$informacion->contextualizacion:old('contextualizacion')}}" required>
                                {!! $errors->first('contextualizacion','<div class="invalid-feedback">:message</div>')!!}
                            </div>
                          </div>

                          <input type="hidden" id="id_identificacion" name="id_identificacion" value="{{ $modo=='crear' ? $id_identificacion:$informacion->id_identificacion}}">
                        </div>
                      </div>
                  </div>

                  <div class="card-footer">
                      <input type="submit" class="btn btn-success btn-sm float-right" value="{{ $modo=='crear' ? 'Agregar Información del Caso':'Modificar Información del Caso'}}">
                      <a href="javascript:history.back(-1);" class="btn btn-danger btn-sm float-left">Cancelar</a>
                  </div>
              </div>
      </section>
  </div>        
@endsection

<style>
input.largerCheckbox {
        transform : scale(2);
    }
    body {
        text-align:center;
        margin-top:10px;
    }

.linea {
  border-top: 1px solid black;
  height: 2px;
  max-width: 200px;
  padding: 0;
  margin: 20px auto 0 auto;
}
</style>