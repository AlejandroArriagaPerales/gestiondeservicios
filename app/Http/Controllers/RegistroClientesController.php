<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistroClientesController extends Controller
{
    public function __invoke()
    {
        return view('registroclientes');
    }
}
