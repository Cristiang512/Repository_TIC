



<form action="{{url('/identificacion/' . $identificacion->id_identificacion)}}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
{{method_field('PATCH')}}
@include('identificacion.form',['modo'=>'editar'])

</form>




