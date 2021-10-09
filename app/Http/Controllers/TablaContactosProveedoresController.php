<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TablaContactosProveedoresController extends Controller
{
    public function __invoke()
    {
        return view('tablacontactosproveedores');
    }
}
