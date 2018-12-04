<html>
<head></head>
<body>
    <div class="py-3">
        Informe de cálculo: <br />
    </div>
    <div>
        Colonia: {{$info['colonia']}} <br />
        Metros cuadrados de terreno: {{$info['terreno']}} <br />
        Metros cuadrados construidos: {{$info['construido']}} <br />

        <br />

        La propiedad tiene acabados catalogados como {{$info['acabados']}}. <br />
        El estado de conservación de la propiedad es: {{$info['conservacion']}}  <br />

        <br />

        Precio estimado: <br/>
        ${{$info['calculo']}} MXN
    </div>
</body>
</html>