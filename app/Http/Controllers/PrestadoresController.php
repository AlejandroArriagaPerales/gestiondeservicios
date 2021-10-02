<?php

namespace App\Http\Controllers;

use App\Models\tab_prestadore;
use Illuminate\Http\Request;

class PrestadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return tab_prestadore::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prestador = new tab_prestadore();
        $prestador->nombre = $request->nombrePrestador;
        $prestador->apellido = $request->apellidoPrestador;
        $prestador->correo = $request->correoPrestador;
        $prestador->ubicacion = $request->ubicacionPrestador;
        $prestador->telefono = $request->telefonoPrestador;
        $prestador->disponibilidad = $request->disponibilidadSeleccionada;
        $prestador->imagen=0;
        $prestador->contrasena = $request->contrasenaPrestador;
        $prestador->save();

        return $prestador;
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
