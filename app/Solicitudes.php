<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitudes extends Model
{
    protected $table = 'solicitudes_calculos';

    protected $fillable = [
        'colonia'=>'string' ,'m2_terreno' => 'float','m2_construido'=> 'float','acabados' => 'string','conservacion'=>'string',
    ];
}