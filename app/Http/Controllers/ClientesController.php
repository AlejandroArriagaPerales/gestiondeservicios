<?php

namespace App\Http\Controllers;

use App\Models\tab_cliente;
use App\Models\tab_contacto;
use App\Models\tab_metodocliente;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return tab_cliente::all();
        
        /*return cliente :: where('') */
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = new tab_cliente();
        $cliente->nombre = $request->nombreCliente;
        $cliente->apellido = $request->apellidoCliente;
        $cliente->rfc = $request->rfcCliente;
        $cliente->direccion = $request->direccionCliente;
        $cliente->contrasena = $request->contrasenaCliente;
        
        
        $cliente->save();

       

        
        /*
        $variable = new ClientesController();  
        $variable -> tab_cliente::latest('id')->first('id');
        
        

        

        
        */


        /*
        $PagosRecibidos = $request->PagosAgregados;
        $CantidadPagos = sizeof($PagosRecibidos);
        $clientemetodopago = new tab_metodocliente(array($CantidadPagos));
        for ($i=0; $i < $CantidadPagos; $i++) {
            $clientemetodopago -> cliente_id = tab_cliente::latest('id')->first('id')->id;
            $clientemetodopago -> metodopago_id = $PagosRecibidos[$i];
            $clientemetodopago -> save();
            sleep(1);
        }

        
        

        

        
        */
       
        $PagosRecibidos = $request->PagosAgregados;
        $CantidadPagos = sizeof($PagosRecibidos);
        
    
        for ($i=0; $i < $CantidadPagos; $i++) {
            $clientemetodopago = new tab_metodocliente;
            $clientemetodopago -> cliente_id = tab_cliente::latest('id')->first('id')->id;
            $clientemetodopago -> metodopago_id = $PagosRecibidos[$i];
            $clientemetodopago -> save();
        }

      
        return $PagosRecibidos;
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
