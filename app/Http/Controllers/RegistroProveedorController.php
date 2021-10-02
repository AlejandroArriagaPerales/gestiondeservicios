<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistroProveedorController extends Controller
{
    public function __invoke()
    {
        return view('registroproveedor');
    }
}
