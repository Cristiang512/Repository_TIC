



<form action="{{url('/identificacion')}}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
@include('identificacion.form',['modo'=>'crear'])



</form>
