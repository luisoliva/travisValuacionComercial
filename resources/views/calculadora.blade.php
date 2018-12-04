@extends('layouts.app')

@section('content')
<div class="py-4 container">
    <div class="text-center">Calculadora valuadora de propiedades</div>
    <form role="form" method="POST" action="{{route('user.Calculate')}}">
        @CSRF
        <div class="py-1">
            Selecciona una colonia:
            <select name="colonia" class="form-control" required>
                <option disabled selected>Selecciona una colonia</option>
                @foreach($colonias as $colonia)
                    <option value="{{$colonia['nombre_colonia']}}" >
                        {{$colonia['nombre_colonia']}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="py-1 align-self-center">
            Metros cuadrados de terreno:
            <input name="terreno" class="form-control" type="number" placeholder="Ejemplo:1000" required>
        </div>
        <div class="py-1 align-self-center">
            Metros cuadrados construidos:
            <input name="construido" class="form-control" type="number" placeholder="Ejemplo:700" required>
        </div>
        <div class="py-1 align-self-center">
            Calidad de acabados:
            <select name="acabados" class="form-control" required>
                <option disabled selected>Selecciona una opción</option>
                <option value="Muy mala">Muy mala</option>
                <option value="Mala">Mala</option>
                <option value="Normal">Normal</option>
                <option value="Buena">Buena</option>
                <option value="De lujo">De lujo</option>
            </select>
        </div>
        <div class="py-1 align-self-center">
            Conservación del inmueble:
            <select name="conservacion" class="form-control" required>
                <option disabled selected>Selecciona una opción</option>
                <option value="Muy mala">Muy mala</option>
                <option value="Mala">Mala</option>
                <option value="Normal">Normal</option>
                <option value="Buena">Buena</option>
                <option value="Nuevo">Nuevo</option>
            </select>
        </div>
        <div class="py-3 text-center">
            <button class="btn btn-primary" type="submit" >Calcular</button>
        </div>
    </form>
</div>

@endsection