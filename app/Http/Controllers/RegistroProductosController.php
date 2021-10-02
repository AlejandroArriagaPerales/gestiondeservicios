<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistroProductosController extends Controller
{
    public function __invoke()
    {
        return view('registroproductos');
    }
}
