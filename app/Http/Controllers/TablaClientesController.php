<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TablaClientesController extends Controller
{
    public function __invoke()
    {
        return view('tablaclientes');
    }
}
