<?php

namespace App\Http\Livewire;

use App\Models\Propuesta;
use App\Models\User;
use Livewire\Component;

class PropuestaParaCancelacionConDescuentoSinPoliticas extends Component
{
    //Variables de livewire principal
    public $operacion;
    //Variables a guardar
    public $monto_ofrecido;
    public $cantidad_de_cuotas_uno;
    public $total_acp;
    public $honorarios;
    public $porcentaje_quita;
    public $monto_de_cuotas_uno;
    public $accion;
    public $observaciones;
    public $fecha_pago_cuota;
    public $usuario_ultima_modificacion_id;
    //Ventanas emergentes
    public $formulario = true;
    public $negociacionPermitida;
    public $propuesta;

    protected $rules = [
        'monto_ofrecido'=> 'required|numeric',
        'cantidad_de_cuotas_uno'=> 'required|numeric'
    ];

    public function calcularCuotasConDescuento()
    {
        $datos = $this->validate();
        //Obtengo la deuda capital
        $deudaCapital = $this->operacion->deuda_capital;        
        //Calculo al ACP de acuerdo al monto a pagar
        $this->total_acp = $this->monto_ofrecido / (1 + ($this->operacion->productoId->honorarios / 100));
        //Calculo los honorarios de acuerdo al monto a pagar
        $this->honorarios = $this->monto_ofrecido - $this->total_acp;
        //Calculo el porcentaje de la quita
        $this->porcentaje_quita = (($deudaCapital - $this->total_acp) * 100) / $deudaCapital;
        //Obtengo el monto de la cuota descontando el anticipo
        $this->monto_de_cuotas_uno = $this->monto_ofrecido / $this->cantidad_de_cuotas_uno;

        $this->formulario = false;
        $this->negociacionPermitida = true;
    }

    public function cancelarPropuesta()
    {
        $this->monto_ofrecido = null;
        $this->cantidad_de_cuotas_uno = null;
        $this->negociacionPermitida = false;
        $this->propuesta = false;
        $this->formulario = true;
    }

    public function propuesta()
    {
        $this->propuesta = true;
    }

    public function guardarPropuesta()
    {
        $reglasSegundoFormulario = [
            'accion' => 'required',
            'fecha_pago_cuota' => 'required|date',
            'usuario_ultima_modificacion_id' => 'required',
            'observaciones' => 'required|max:255'
        ];
        $this->validate($reglasSegundoFormulario);
        $propuesta = new Propuesta();
        $propuesta->deudor_id = $this->operacion->deudor_id;
        $propuesta->operacion_id = $this->operacion->id;
        $propuesta->monto_ofrecido = $this->monto_ofrecido;
        $propuesta->tipo_de_propuesta = 3;
        if($this->porcentaje_quita > 0) {
            $propuesta->porcentaje_quita = $this->porcentaje_quita;
        } else {
            $propuesta->porcentaje_quita = '';
        }
        $propuesta->cantidad_de_cuotas_uno = $this->cantidad_de_cuotas_uno;
        $propuesta->monto_de_cuotas_uno = $this->monto_de_cuotas_uno;
        $propuesta->fecha_pago_cuota = $this->fecha_pago_cuota;
        $propuesta->total_acp = $this->total_acp;
        $propuesta->honorarios = $this->honorarios;
        $propuesta->accion = $this->accion;
        $propuesta->estado = 'Propuesta de Pago';
        $propuesta->observaciones = $this->observaciones;
        $propuesta->usuario_ultima_modificacion_id = $this->usuario_ultima_modificacion_id;
        $propuesta->save();
        return redirect()->route('propuesta', ['operacion' => $this->operacion->id])->with('message', 'Gestión generada correctamente');  
    }

    public function render()
    {
        $usuarios = User::all();

        return view('livewire.propuesta-para-cancelacion-con-descuento-sin-politicas',[
            'usuarios'=>$usuarios
        ]);
    }
}
