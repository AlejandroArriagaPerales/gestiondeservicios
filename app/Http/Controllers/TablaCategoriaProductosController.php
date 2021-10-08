<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TablaCategoriaProductosController extends Controller
{
    public function __invoke()
    {
        return view('tablacategoriaproductos');
    }
}
