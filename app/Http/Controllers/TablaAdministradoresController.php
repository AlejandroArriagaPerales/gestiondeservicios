<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TablaAdministradoresController extends Controller
{
    public function __invoke()
    {
        return view('tablaadmins');
    }
}
