@extends('layouts.app')

@section('content')
    <div class=" py-4 container">
        <div class="text-center">
            Precio estimado de la propiedad: ${{$calculo}} MXN
        </div>
        <div class="text-center">
            <form role="form" method="GET" action="{{route('user.Descargar')}}">
                @CSRF
                <button class="btn btn-primary" type="submit" >Descargar informe</button>
            </form>
        </div>
    </div>
@endsection