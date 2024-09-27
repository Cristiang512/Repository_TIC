
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
                        Indentificación de la Víctima / Sobreviviente
                      </h1>
                    </div>
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('identificacion')}}">Atrás</a></li>
                        <li class="breadcrumb-item active">Indentificación de la Víctima / Sobreviviente</li>
                      </ol>
                    </div>
                  </div>
                </div>
              </section>
              <div class="col-md-12">
                  <div class="card">
                      <div class="card-body">
                          <div class="row">
                              <!-- <div class="col-md-12"> -->
                                  <!-- <div class="chart"> -->
                                  <!-- <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="lider_seguimiento">Líder de Seguimiento*</label>
                                      <input type="text" name="lider_seguimiento" id="lider_seguimiento" class="form-control {{$errors->has('lider_seguimiento')?'is-invalid' : ''}}"
                                       value="{{ isset($identificacion->lider_seguimiento)?$identificacion->lider_seguimiento:old('lider_seguimiento')}}" required>
                                       {!! $errors->first('lider_seguimiento','<div class="invalid-feedback">:message</div>')!!}
                                    </div>
                                  </div> -->
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="id_lider_seguimiento">Líder de Seguimiento*</label>
                                      <select name="id_lider_seguimiento" id="id_lider_seguimiento" class="form-control {{$errors->has('id_lider_seguimiento')?'is-invalid' : ''}}" required>
                                          <option
                                          value="" > Seleccione...
                                          </option>
                                          @foreach ($user as $us)
                                              <option <?php if(isset($identificacion) && $us->id==$identificacion->id_lider_seguimiento){ echo "selected"; }?>
                                              value="{{ $us ['id']}}" > {{ $us ['name']}}
                                              </option>
                                          @endforeach
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="id_municipio">Municipio Donde se Ecuentra el Caso*</label>
                                      <select name="id_municipio" id="id_municipio" class="form-control {{$errors->has('id_municipio')?'is-invalid' : ''}}" required>
                                          <option
                                          value="" > Seleccione...
                                          </option>
                                          @foreach ($municipio as $muni)
                                              <option <?php if(isset($identificacion) && $muni->id_municipio==$identificacion->id_municipio){ echo "selected"; }?>
                                              value="{{ $muni ['id_municipio']}}" > {{ $muni ['nombre_municipio']}}
                                              </option>
                                          @endforeach
                                      </select>
                                    </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label for="instancia_remite">Instancia que Remite*</label>
                                      <input type="text" name="instancia_remite" id="instancia_remite" class="form-control {{$errors->has('instancia_remite')?'is-invalid' : ''}}"
                                      value="{{ isset($identificacion->instancia_remite)?$identificacion->instancia_remite:old('instancia_remite')}}" required>
                                      {!! $errors->first('instancia_remite','<div class="invalid-feedback">:message</div>')!!}
                                    </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="estado_referencia">Estado de Referencia*</label>
                                        <select name="estado_referencia" id="estado_referencia" class="form-control {{$errors->has('estado_referencia')?'is-invalid' : ''}}" required>
                                            <option
                                            value="" > Seleccione...
                                            </option>
                                            <option value="Caso Abierto" {{ $modo == 'crear' ? 'Caso Abierto' : ($identificacion->estado_referencia == 'Caso Abierto' ? 'selected' : '' ) }}>Caso Abierto</option>
                                            <option value="Caso Cerrado" {{ $modo == 'crear' ? 'Caso Cerrado' : ($identificacion->estado_referencia == 'Caso Cerrado' ? 'selected' : '' ) }}>Caso Cerrado</option>
                                        </select>
                                    </div>
                                  </div>
                                  <!-- </div> -->
                                <br>
                              <!-- </div> -->
                          </div>
                      </div>
                      <div class="card-footer">
                        <!-- <input type="submit" class="btn btn-success btn-sm float-right" value="{{ $modo=='crear' ? 'Agregar Paciente':'Modificar Paciente'}}">
                        <a href="{{url('identificacion')}}" class="btn btn-danger btn-sm float-left">Cancelar</a>
                    </div> -->
                  </div>

                  <div class="card card-info card-outline">
                    <div class="card-header">
                      <h3 class="card-title">
                      <i class="fas fa-user"></i>
                        Datos de la Persona Atendida
                      </h3>
                    </div>
                    <br/>
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="nombres">Nombres*</label>
                              <input type="text" name="nombres" id="nombres" class="form-control {{$errors->has('nombres')?'is-invalid' : ''}}"
                                value="{{ isset($identificacion->nombres)?$identificacion->nombres:old('nombres')}}" required>
                                {!! $errors->first('nombres','<div class="invalid-feedback">:message</div>')!!}
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="apellidos">Apellidos*</label>
                              <input type="text" name="apellidos" id="apellidos" class="form-control {{$errors->has('apellidos')?'is-invalid' : ''}}"
                                value="{{ isset($identificacion->apellidos)?$identificacion->apellidos:old('apellidos')}}" required>
                                {!! $errors->first('apellidos','<div class="invalid-feedback">:message</div>')!!}
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="id_tipo_documento">Tipo de Documento*</label>
                              <select name="id_tipo_documento" id="id_tipo_documento" class="form-control {{$errors->has('id_tipo_documento')?'is-invalid' : ''}}" required>
                                  <option
                                  value="" > Seleccione...
                                  </option>
                                  @foreach ($documento as $doc)
                                      <option <?php if(isset($identificacion) && $doc->id_tipo_documento==$identificacion->id_tipo_documento){ echo "selected"; }?>
                                      value="{{ $doc ['id_tipo_documento']}}" > {{ $doc ['tipo']}}
                                      </option>
                                  @endforeach
                              </select>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="doc_numero">Número*</label>
                              <input type="number" name="doc_numero" id="doc_numero" class="form-control {{$errors->has('doc_numero')?'is-invalid' : ''}}"
                                value="{{ isset($identificacion->doc_numero)?$identificacion->doc_numero:old('doc_numero')}}" required>
                                {!! $errors->first('doc_numero','<div class="invalid-feedback">:message</div>')!!}
                            </div>
                          </div>
                        </div>

                        <hr/>

                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="fecha_nacimiento">Fecha de Nacimiento*</label>
                              <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control {{$errors->has('fecha_nacimiento')?'is-invalid' : ''}}"
                                value="{{ isset($identificacion->fecha_nacimiento)?$identificacion->fecha_nacimiento:old('fecha_nacimiento')}}" required>
                                {!! $errors->first('fecha_nacimiento','<div class="invalid-feedback">:message</div>')!!}
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="edad">Edad al Momento del Registro*</label>
                              <input type="number" name="edad" id="edad" class="form-control {{$errors->has('edad')?'is-invalid' : ''}}"
                                value="{{ isset($identificacion->edad)?$identificacion->edad:old('edad')}}" required>
                                {!! $errors->first('edad','<div class="invalid-feedback">:message</div>')!!}
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="telefono">Teléfono*</label>
                              <input type="number" name="telefono" id="telefono" class="form-control {{$errors->has('telefono')?'is-invalid' : ''}}"
                                value="{{ isset($identificacion->telefono)?$identificacion->telefono:old('telefono')}}" required>
                                {!! $errors->first('telefono','<div class="invalid-feedback">:message</div>')!!}
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="direccion">Dirección*</label>
                              <input type="text" name="direccion" id="direccion" class="form-control {{$errors->has('direccion')?'is-invalid' : ''}}"
                                value="{{ isset($identificacion->direccion)?$identificacion->direccion:old('direccion')}}" required>
                                {!! $errors->first('direccion','<div class="invalid-feedback">:message</div>')!!}
                            </div>
                          </div>
                        </div>

                        <hr/>

                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="barrio">Barrio</label>
                              <input type="text" name="barrio" id="barrio" class="form-control {{$errors->has('barrio')?'is-invalid' : ''}}"
                                value="{{ isset($identificacion->barrio)?$identificacion->barrio:old('barrio')}}" >
                                {!! $errors->first('barrio','<div class="invalid-feedback">:message</div>')!!}
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="correo">Correo Electrónico</label>
                              <input type="email" name="correo" id="correo" class="form-control {{$errors->has('correo')?'is-invalid' : ''}}"
                                value="{{ isset($identificacion->correo)?$identificacion->correo:old('correo')}}" >
                                {!! $errors->first('correo','<div class="invalid-feedback">:message</div>')!!}
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                                <label for="sexo">Sexo</label>
                                <select name="sexo" id="sexo" class="form-control {{$errors->has('sexo')?'is-invalid' : ''}}">
                                    <option
                                    value="" > Seleccione...
                                    </option>
                                    <option value="Masculino" {{ $modo == 'crear' ? 'Masculino' : ($identificacion->sexo == 'Masculino' ? 'selected' : '' ) }}>Masculino</option>
                                    <option value="Femenino" {{ $modo == 'crear' ? 'Femenino' : ($identificacion->sexo == 'Femenino' ? 'selected' : '' ) }}>Femenino</option>
                                    <option value="Intersexual" {{ $modo == 'crear' ? 'Intersexual' : ($identificacion->sexo == 'Intersexual' ? 'selected' : '' ) }}>Intersexual</option>
                                </select>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="id_orientacion">Orientación Sexual</label>
                              <select name="id_orientacion" id="id_orientacion" class="form-control {{$errors->has('id_orientacion')?'is-invalid' : ''}}" >
                                  <option
                                  value="" > Seleccione...
                                  </option>
                                  @foreach ($orientacion as $ori)
                                      <option <?php if(isset($identificacion) && $ori->id_orientacion==$identificacion->id_orientacion){ echo "selected"; }?>
                                      value="{{ $ori ['id_orientacion']}}" > {{ $ori ['orientacion']}}
                                      </option>
                                  @endforeach
                              </select>
                            </div>
                          </div>
                        </div>

                        <hr/>

                        <div class="row">

                          <div class="col-md-3">
                              <div class="form-group">
                                <label for="id_identidad">Identidad de Género</label>
                                <select name="id_identidad" id="id_identidad" class="form-control {{$errors->has('id_identidad')?'is-invalid' : ''}}" >
                                    <option
                                    value="" > Seleccione...
                                    </option>
                                    @foreach ($identidad as $ide)
                                        <option <?php if(isset($identificacion) && $ide->id_identidad==$identificacion->id_identidad){ echo "selected"; }?>
                                        value="{{ $ide ['id_identidad']}}" > {{ $ide ['identidad']}}
                                        </option>
                                    @endforeach
                                </select>
                              </div>
                          </div>

                          <div class="col-md-3">
                              <div class="form-group">
                                <label for="id_curso">Curso de Vida</label>
                                <select name="id_curso" id="id_curso" class="form-control {{$errors->has('id_curso')?'is-invalid' : ''}}" >
                                    <option
                                    value="" > Seleccione...
                                    </option>
                                    @foreach ($curso as $cur)
                                        <option <?php if(isset($identificacion) && $cur->id_curso==$identificacion->id_curso){ echo "selected"; }?>
                                        value="{{ $cur ['id_curso']}}" > {{ $cur ['curso_vida']}}
                                        </option>
                                    @endforeach
                                </select>
                              </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="personas_vive">Número de Personas con las que Vive</label>
                              <input type="number" name="personas_vive" id="personas_vive" class="form-control {{$errors->has('personas_vive')?'is-invalid' : ''}}"
                                value="{{ isset($identificacion->personas_vive)?$identificacion->personas_vive:old('personas_vive')}}">
                                {!! $errors->first('personas_vive','<div class="invalid-feedback">:message</div>')!!}
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                                <label for="area_ocurrencia">Área de Ocurrencia</label>
                                <select name="area_ocurrencia" id="area_ocurrencia" class="form-control {{$errors->has('area_ocurrencia')?'is-invalid' : ''}}">
                                    <option
                                    value="" > Seleccione...
                                    </option>
                                    <option value="Cabecera municipal" {{ $modo == 'crear' ? 'Cabecera municipal' : ($identificacion->area_ocurrencia == 'Cabecera municipal' ? 'selected' : '' ) }}>Cabecera municipal</option>
                                    <option value="Centro poblado" {{ $modo == 'crear' ? 'Centro poblado' : ($identificacion->area_ocurrencia == 'Centro poblado' ? 'selected' : '' ) }}>Centro poblado</option>
                                    <option value="Rural disperso" {{ $modo == 'crear' ? 'Rural disperso' : ($identificacion->area_ocurrencia == 'Rural disperso' ? 'selected' : '' ) }}>Rural disperso</option>
                                </select>
                            </div>
                          </div>
                        </div>

                        <hr/>

                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                                <label for="regimen_salud">Tipo Régimen Salud</label>
                                <select name="regimen_salud" id="regimen_salud" class="form-control {{$errors->has('regimen_salud')?'is-invalid' : ''}}">
                                    <option
                                    value="" > Seleccione...
                                    </option>
                                    <option value="Excepción" {{ $modo == 'crear' ? 'Excepción' : ($identificacion->regimen_salud == 'Excepción' ? 'selected' : '' ) }}>Excepción</option>
                                    <option value="Especial" {{ $modo == 'crear' ? 'Especial' : ($identificacion->regimen_salud == 'Especial' ? 'selected' : '' ) }}>Especial</option>
                                    <option value="Contributivo" {{ $modo == 'crear' ? 'Contributivo' : ($identificacion->regimen_salud == 'Contributivo' ? 'selected' : '' ) }}>Contributivo</option>
                                    <option value="Subsidiado" {{ $modo == 'crear' ? 'Subsidiado' : ($identificacion->regimen_salud == 'Subsidiado' ? 'selected' : '' ) }}>Subsidiado</option>
                                    <option value="No asegurado" {{ $modo == 'crear' ? 'No asegurado' : ($identificacion->regimen_salud == 'No asegurado' ? 'selected' : '' ) }}>No asegurado</option>
                                    <option value="Pendiente" {{ $modo == 'crear' ? 'Pendiente' : ($identificacion->regimen_salud == 'Pendiente' ? 'selected' : '' ) }}>Pendiente</option>
                                </select>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="eapb">EAPB</label>
                              <input type="text" name="eapb" id="eapb" class="form-control {{$errors->has('eapb')?'is-invalid' : ''}}"
                                value="{{ isset($identificacion->eapb)?$identificacion->eapb:old('eapb')}}">
                                {!! $errors->first('eapb','<div class="invalid-feedback">:message</div>')!!}
                            </div>
                          </div>

                          <div class="col-md-3">
                              <div class="form-group">
                                <label for="id_grupo_poblacional">Grupo Poblacional</label>
                                <select name="id_grupo_poblacional" id="id_grupo_poblacional" class="form-control {{$errors->has('id_grupo_poblacional')?'is-invalid' : ''}}" >
                                    <option
                                    value="" > Seleccione...
                                    </option>
                                    @foreach ($grupo as $grup)
                                        <option <?php if(isset($identificacion) && $grup->id_grupo_poblacional==$identificacion->id_grupo_poblacional){ echo "selected"; }?>
                                        value="{{ $grup ['id_grupo_poblacional']}}" > {{ $grup ['grupo_poblacional']}}
                                        </option>
                                    @endforeach
                                </select>
                              </div>
                          </div>

                          <div class="col-md-3">
                              <div class="form-group">
                                <label for="id_discapacidad">Discapacidad</label>
                                <select name="id_discapacidad" id="id_discapacidad" class="form-control {{$errors->has('id_discapacidad')?'is-invalid' : ''}}" >
                                    <option
                                    value="" > Seleccione...
                                    </option>
                                    @foreach ($discapacidad as $disc)
                                        <option <?php if(isset($identificacion) && $disc->id_discapacidad==$identificacion->id_discapacidad){ echo "selected"; }?>
                                        value="{{ $disc ['id_discapacidad']}}" > {{ $disc ['discapacidad']}}
                                        </option>
                                    @endforeach
                                </select>
                              </div>
                          </div>
                        </div>

                        <hr/>

                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="semanas_gestacion">Semanas de Gestación</label>
                              <input type="number" name="semanas_gestacion" placeholder="0" id="semanas_gestacion" class="form-control {{$errors->has('semanas_gestacion')?'is-invalid' : ''}}"
                                value="{{ isset($identificacion->semanas_gestacion)?$identificacion->semanas_gestacion:old('semanas_gestacion')}}">
                                {!! $errors->first('semanas_gestacion','<div class="invalid-feedback">:message</div>')!!}
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                                <label for="lactante">Lactante</label>
                                <select name="lactante" id="lactante" class="form-control {{$errors->has('lactante')?'is-invalid' : ''}}" >
                                    <option
                                    value="" > Seleccione...
                                    </option>
                                    <option value="Si" {{ $modo == 'crear' ? 'Si' : ($identificacion->lactante == 'Si' ? 'selected' : '' ) }}>Si</option>
                                    <option value="No" {{ $modo == 'crear' ? 'No' : ($identificacion->lactante == 'No' ? 'selected' : '' ) }}>No</option>
                                    <option value="No aplica" {{ $modo == 'crear' ? 'No aplica' : ($identificacion->lactante == 'No aplica' ? 'selected' : '' ) }}>No aplica</option>
                                </select>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                                <label for="nacionalidad">Nacionalidad</label>
                                <select name="nacionalidad" id="nacionalidad" class="form-control {{$errors->has('nacionalidad')?'is-invalid' : ''}} select2 select2-hidden-accessible" >
                                    <option
                                    value="" > Seleccione...
                                    </option>
                                    <option value="Colombiana" {{ $modo == 'crear' ? 'Colombiana' : ($identificacion->nacionalidad == 'Colombiana' ? 'selected' : '' ) }}>Colombiana</option>
                                    <option value="Venezolana" {{ $modo == 'crear' ? 'Venezolana' : ($identificacion->nacionalidad == 'Venezolana' ? 'selected' : '' ) }}>Venezolana</option>
                                    <option value="Ecuatoriano" {{ $modo == 'crear' ? 'Ecuatoriano' : ($identificacion->nacionalidad == 'Ecuatoriano' ? 'selEted' : '' ) }}>Ecuatoriano</option>
                                    <option value="Peruano" {{ $modo == 'crear' ? 'Peruano' : ($identificacion->nacionalidad == 'Peruano' ? 'selected' : '' ) }}>Peruano</option>
                                    <option value="Boliviano" {{ $modo == 'crear' ? 'Boliviano' : ($identificacion->nacionalidad == 'Boliviano' ? 'selected' : '' ) }}>Boliviano</option>
                                    <option value="Chileno" {{ $modo == 'crear' ? 'Chileno' : ($identificacion->nacionalidad == 'Chileno' ? 'selected' : '' ) }}>Chileno</option>
                                    <option value="Argentino" {{ $modo == 'crear' ? 'Argentino' : ($identificacion->nacionalidad == 'Argentino' ? 'selected' : '' ) }}>Argentino</option>
                                    <option value="Otra" {{ $modo == 'crear' ? 'Otra' : ($identificacion->nacionalidad == 'Otra' ? 'selected' : '' ) }}>Otra</option>
                                </select>
                            </div>
                          </div>

                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="entrada_pais">Fecha de Entrada al País</label>
                              <input type="date" name="entrada_pais" id="entrada_pais" class="form-control {{$errors->has('entrada_pais')?'is-invalid' : ''}}"
                                value="{{ isset($identificacion->entrada_pais)?$identificacion->entrada_pais:old('entrada_pais')}}">
                                {!! $errors->first('entrada_pais','<div class="invalid-feedback">:message</div>')!!}
                            </div>
                          </div>
                        </div>

                        <hr/>

                        <div class="row">
                          <div class="col-md-3">
                              <div class="form-group">
                                <label for="id_estatus_migratorio">Estatus Migratorio</label>
                                <select name="id_estatus_migratorio" id="id_estatus_migratorio" class="form-control {{$errors->has('id_estatus_migratorio')?'is-invalid' : ''}}" >
                                    <option
                                    value="" > Seleccione...
                                    </option>
                                    @foreach ($estatus as $esta)
                                        <option <?php if(isset($identificacion) && $esta->id_estatus_migratorio==$identificacion->id_estatus_migratorio){ echo "selected"; }?>
                                        value="{{ $esta ['id_estatus_migratorio']}}" > {{ $esta ['estatus']}}
                                        </option>
                                    @endforeach
                                </select>
                              </div>
                          </div>

                          <div class="col-md-3">
                              <div class="form-group">
                                <label for="id_etnia">ETNIA</label>
                                <select name="id_etnia" id="id_etnia" class="form-control {{$errors->has('id_etnia')?'is-invalid' : ''}}" >
                                    <option
                                    value="" > Seleccione...
                                    </option>
                                    @foreach ($etnia as $etn)
                                        <option <?php if(isset($identificacion) && $etn->id_etnia==$identificacion->id_etnia){ echo "selected"; }?>
                                        value="{{ $etn ['id_etnia']}}" > {{ $etn ['etnia']}}
                                        </option>
                                    @endforeach
                                </select>
                              </div>
                          </div>
                        
                        </div>

                        <?php if($modo != 'crear'): ?>
                          <hr/>
                            <div class="col-md-12">
                              <div class="form-group">
                                <label for="password" class="col-md-2">¿Reestablecer contraseña?</label>
                                <input type="checkbox" class="largerCheckbox" id="cbox" name="password" value="yes">
                              </div>
                            </div>
                        <?php endif; ?>

                      </div>


                    <div class="text-muted mt-3">
                    </div>
                  </div>

                  <div class="card-footer">
                      <input type="submit" class="btn btn-success btn-sm float-right" value="{{ $modo=='crear' ? 'Agregar Víctima / Sobreviviente':'Modificar Víctima / Sobreviviente'}}">
                      <a href="{{url('identificacion')}}" class="btn btn-danger btn-sm float-left">Cancelar</a>
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

@section('javascript')
<script 
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"
  ></script>
  <script>
      $(document).ready(function () {
        $('#nacionalidad').change(function (e) {
          if ($(this).val() != 'Colombiana') {
            $('#id_estatus_migratorio').prop("disabled", false);
            $('#entrada_pais').prop("disabled", false);
          } else {
            $('#id_estatus_migratorio').prop("disabled", true);
            $('#entrada_pais').prop("disabled", true);
          }
        })
      });
  </script>
@endsection