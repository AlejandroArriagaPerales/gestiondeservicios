<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistroMetodoPagoController extends Controller
{
    public function __invoke()
    {
        return view('registrometodopago');
    }
}
