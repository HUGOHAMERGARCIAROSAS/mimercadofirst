<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\src\Repositories\ShippingCostRepository;

class FooterController extends Controller
{
    private $shippingCostRepository;

    public function __construct(ShippingCostRepository $ubanizationRepository)
    {
        $this->shippingCostRepository = $ubanizationRepository;
    }

    public function welcome()
    {
        return view('web.pages.footer.bienvenido');
    }

    public function queEsMiMercado()
    {
        return view('web.pages.footer.ques-mimercado');
    }

    public function beneficios()
    {
        return view('web.pages.footer.beneficios');
    }

    public function comoComprar()
    {
        return view('web.pages.footer.como_comprar');
    }

    public function costoDeEnvio()
    {
        return view('web.pages.footer.costo_envio')->with([
            'shippingCost' => $this->shippingCostRepository->listShippingCostWithOrder(),
        ]);
    }

    public function mediosDePago()
    {
        return view('web.pages.footer.medios_pago');
    }

    public function servicioDeEntrega()
    {
        return view('web.pages.footer.servicios_entrega');
    }

    public function terminosYCondiciones()
    {
        return view('web.pages.footer.terminos_condiciones');
    }

    public function preguntasFrecuentes()
    {
        return view('web.pages.footer.preguntas_frecuentes');
    }

    public function politicasDePrivacidad()
    {
        return view('web.pages.footer.politicas.politicas_privacidad');
    }

    public function politicasDeCookies()
    {
        return view('web.pages.footer.politicas.politicas_cookies');
    }

    public function protecciónDatosPersonales()
    {
        return view('web.pages.footer.politicas.proteccion_datos');
    }

}
