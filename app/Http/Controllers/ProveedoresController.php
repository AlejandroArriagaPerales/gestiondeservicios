<?php

namespace App\Http\Controllers;

use App\Models\tab_prestadore;
use App\Models\tab_proveedore;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return tab_proveedore::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proveedor = new tab_proveedore();
        $proveedor->nombre = $request->nombreProveedor;
        $proveedor->direccion = $request->direccionProveedor;
        $proveedor->rfc = $request->rfcProveedor;
        $proveedor->telefono = $request->telefonoProveedor;
        $proveedor->correo = $request->correoProveedor;
        $proveedor->estatus = '1';
        $proveedor->logo = $request->logoProveedor;
        $proveedor->save();

        return $proveedor;

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
        $proveedor = tab_proveedore::find($id);
        $proveedor->nombre = $request->nombreActualizar;
        $proveedor->direccion = $request->direccionActualizar;
        $proveedor->rfc = $request->rfcActualizar;
        $proveedor->telefono = $request->telefonoActualizar;
        $proveedor->correo = $request->correoActualizar;
        $proveedor->estatus = $request->estatusActualizar;

        $proveedor->save();

        return $proveedor;
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
