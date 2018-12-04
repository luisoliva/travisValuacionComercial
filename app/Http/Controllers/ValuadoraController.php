<?php

namespace App\Http\Controllers;

use App\Valuadora;
use App\Solicitudes;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PhpParser\Node\Scalar\String_;

class ValuadoraController extends Controller
{
    public $zone;
    public $zoneValue;
    public $mTerr;
    public $mCons;
    public $acab;
    public $cons;
    public $Request;


    public function Calculadora(){
        $colonias = Valuadora::all();
        return view('calculadora')->with(['colonias' => $colonias]);
    }


    public function setZone($zone){
        $this->zone=$zone;
    }

    public function setMetrosContruidos($num){
        $this->mCons=$num;
    }

    public function setMetrosTerreno($num){
        $this->mTerr=$num;
    }

    public function setAcabados($type){
        $this->acab=$type;
    }

    public function setConservacion($type){
        $this->cons=$type;
    }

    public function setZoneValue($num){
        $this->zoneValue=$num;
    }

    public function getCalculoValorComercial($solicitud){

        $calculo = $solicitud->metrosTerreno * $solicitud->coloniaValue;
        $calculo += 3*$solicitud->metrosConstruido * $solicitud->coloniaValue * $solicitud->conservacion * $solicitud->acabados;


        return $calculo;
    }

    public function getTextPDF(){

    }


    public function getFactorAcabados($solicitud2){
        if ($solicitud2[0]->acabados == 'Muy mala') {
            $factor_1 = 0.86;
        } else if ($solicitud2[0]->acabados == 'Mala') {
            $factor_1 = 0.96;
        } else if ($solicitud2[0]->acabados == 'Normal') {
            $factor_1 = 1;
        } else if ($solicitud2[0]->acabados == 'Buena') {
            $factor_1 = 1.06;
        } else if ($solicitud2[0]->acabados == 'De lujo') {
            $factor_1 = 1.12;
        }

        return $factor_1;

    }

    public function getFactorConservacion($solicitud2){
        if ($solicitud2[0]->conservacion == 'Muy mala') {
            $factor_2 = 0.92;
        } else if ($solicitud2[0]->conservacion == 'Mala') {
            $factor_2 = 0.96;
        } else if ($solicitud2[0]->conservacion == 'Normal') {
            $factor_2 = 1;
        } else if ($solicitud2[0]->conservacion == 'Buena') {
            $factor_2 = 1.02;
        } else if ($solicitud2[0]->conservacion == 'De lujo') {
            $factor_2 = 1.04;
        }
        return $factor_2;
    }

    public function Calculate(Request $request)
    {
        $user = Auth::user();
        if($user) {
            $solicitud = new Solicitudes();
            $solicitud->colonia = $request->colonia;
            $solicitud->m2_terreno = $request->terreno;
            $solicitud->m2_construido = $request->construido;
            $solicitud->acabados = $request->acabados;
            $solicitud->conservacion = $request->conservacion;
            $solicitud->saveOrFail();
            $solicitud2 = Solicitudes::latest()->take(1)->get();

            $factor_1=$this->getFactorAcabados($solicitud2);
            $factor_2=$this->getFactorConservacion($solicitud2);

            $valorm2 = Valuadora::select('valor_metro2')->where('nombre_colonia', '=', $request->colonia)->get();
            $calculo = $solicitud2[0]->m2_terreno * $valorm2[0]->valor_metro2;
            $calculo += 3*$solicitud2[0]->m2_construido * $valorm2[0]->valor_metro2 * $factor_2 * $factor_1;
            return view('Calculado')->with(['calculo' => $calculo]);
        }
    }

    public function GenerarPDF(){
        $solicitud2 = Solicitudes::latest()->take(1)->get();
        if ($solicitud2[0]->acabados == 'Muy mala') {
            $factor_1 = 0.86;
        } else if ($solicitud2[0]->acabados == 'Mala') {
            $factor_1 = 0.96;
        } else if ($solicitud2[0]->acabados == 'Normal') {
            $factor_1 = 1;
        } else if ($solicitud2[0]->acabados == 'Buena') {
            $factor_1 = 1.06;
        } else if ($solicitud2[0]->acabados == 'De lujo') {
            $factor_1 = 1.12;
        }
        if ($solicitud2[0]->conservacion == 'Muy mala') {
            $factor_2 = 0.92;
        } else if ($solicitud2[0]->conservacion == 'Mala') {
            $factor_2 = 0.96;
        } else if ($solicitud2[0]->conservacion == 'Normal') {
            $factor_2 = 1;
        } else if ($solicitud2[0]->conservacion == 'Buena') {
            $factor_2 = 1.02;
        } else if ($solicitud2[0]->conservacion == 'De lujo') {
            $factor_2 = 1.04;
        }
        $valorm2 = Valuadora::select('valor_metro2')->where('nombre_colonia', '=', $solicitud2[0]->colonia)->get();
        $calculo = $solicitud2[0]->m2_terreno * $valorm2[0]->valor_metro2;
        $calculo += 3*$solicitud2[0]->m2_construido * $valorm2[0]->valor_metro2 * $factor_2 * $factor_1;
        $info = array('colonia'=>$solicitud2[0]->colonia,'terreno'=>$solicitud2[0]->m2_terreno,'construido'=>$solicitud2[0]->m2_construido,'acabados'=>$solicitud2[0]->acabados,'conservacion'=>$solicitud2[0]->conservacion,'calculo'=>$calculo);
        $pdf = PDF::loadView('textDoc',compact('info'));
        return $pdf->download('calculo.pdf');
    }

}