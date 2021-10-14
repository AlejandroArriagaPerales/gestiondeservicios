<?php

namespace App\Http\Controllers;

use App\Models\tab_contacto;
use Illuminate\Http\Request;

class ContactosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return tab_contacto::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contacto = new tab_contacto();
        $contacto->nombre = $request->nombreContactoProveedor;
        $contacto->correo = $request->correoContactoProveedor;
        $contacto->telefono = $request->telefonoContactoProveedor;
        $contacto->proveedore_id = $request->proveedorSeleccionado;
        
        $contacto->save();

        return $contacto;
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
        $contacto = tab_contacto::find($id);
        $contacto->nombre = $request->nombreActualizar;
        $contacto->correo = $request->correoActualizar;
        $contacto->telefono = $request->telefonoActualizar;
        $contacto->proveedore_id = $request->proveedorSeleccionadoActualizar;

        $contacto->save();

        return $contacto;
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
