



<form action="{{url('/informacion')}}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
@include('informacion.form',['modo'=>'crear'])



</form>
