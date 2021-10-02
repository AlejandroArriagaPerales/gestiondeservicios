<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistroContactoProveedoresController extends Controller
{
    public function __invoke()
    {
        return view('registrocontactoproveedores');
    }
}
