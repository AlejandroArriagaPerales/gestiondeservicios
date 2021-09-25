<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistroAdministradoresController extends Controller
{
    public function __invoke()
    {
        return view('registroadmins');
    }
}
