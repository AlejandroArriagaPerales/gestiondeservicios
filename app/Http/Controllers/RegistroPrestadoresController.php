<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistroPrestadoresController extends Controller
{
    public function __invoke()
    {
        return view('registroprestadores');
    }
}
