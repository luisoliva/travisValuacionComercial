<?php
/**
 * Created by PhpStorm.
 * User: luisoliva
 * Date: 18/11/18
 * Time: 2:06 PM
 */

namespace Tests\Unit;


//use App\Http\Controllers\ValuadoraController;
use App\Http\Controllers\ValuadoraController;
use App\Solicitudes;
use App\Solicitud;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use PHPUnit\Framework\TestCase;


final class ValuadoraControllerTest extends TestCase
{
    public $Request ;

    public function testSetZone(){
        $instance = new ValuadoraController();
        $instance->setZone("altabrisa");

        $this->assertEquals($instance->zone,"altabrisa");
    }

    public function testSetmConstruidos()
    {
        $instance = new ValuadoraController();
        $instance->setMetrosContruidos(440);

        $this->assertEquals($instance->mCons,440);

    }

    public function testSetmTerreno()
    {
        $instance = new ValuadoraController();
        $instance->setMetrosTerreno(276);

        $this->assertEquals($instance->mTerr,276);

    }

    public function testSetAcabados()
    {
        $instance = new ValuadoraController();
        $instance->setAcabados("Buena");

        $this->assertEquals($instance->acab,"Buena");

    }

    public function testSetConservacion()
    {
        $instance = new ValuadoraController();
        $instance->setConservacion("Nuevo");

        $this->assertEquals($instance->cons,"Nuevo");

    }

    public function  testFactorAcabados(){
        $instance = new ValuadoraController();
        $instance->Request[0]=new Solicitud();
        $instance->Request[0]->acabados='Buena';
        $this->assertEquals($instance->getFactorAcabados($instance->Request),1.06);

    }

    public function testFactorConservacion(){
        $instance = new ValuadoraController();
        $instance->Request[0]=new Solicitud();
        $instance->Request[0]->conservacion='Muy mala';
        $this->assertEquals($instance->getFactorConservacion($instance->Request),0.92);

    }

    public function testCalculoValorComercial(){
        $instance = new ValuadoraController();
        $instance->Request=new Solicitud();
        $instance->Request->coloniaValue=2615;
        $instance->Request->metrosConstruido=240;
        $instance->Request->metrosTerreno=400;
        $instance->Request->acabados=1;
        $instance->Request->conservacion=1;

        $real=$instance->getCalculoValorComercial($instance->Request);
        $esperado=2928800;
        $this->assertEquals($real,$esperado);

    }
}
