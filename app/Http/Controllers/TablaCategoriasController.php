<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TablaCategoriasController extends Controller
{
    public function __invoke()
    {
        return view('tablacategorias');
    }
}
