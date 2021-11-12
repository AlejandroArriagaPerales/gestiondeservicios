<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapaPrestadoresController extends Controller
{
    public function __invoke()
    {
        return view('mapaprestadores');
    }
}
