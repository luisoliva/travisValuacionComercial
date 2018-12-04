<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Valuadora extends Model
{
    protected $table = 'valuation_info';
    protected $primaryKey = 'colonia_id';
    public $timestamps = false;

    protected $fillable = [
        'nombre_colonia','valor_metro2',
    ];
}