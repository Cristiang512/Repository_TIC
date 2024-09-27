



<form action="{{url('/informacion/' . $informacion->id_informacion)}}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
{{method_field('PATCH')}}
@include('informacion.form',['modo'=>'editar'])

</form>




