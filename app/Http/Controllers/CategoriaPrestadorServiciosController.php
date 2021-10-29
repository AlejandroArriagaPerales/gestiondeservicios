<?php

namespace App\Http\Controllers;

use App\Models\tab_categoriaprestadorservicio;
use Illuminate\Http\Request;

class CategoriaPrestadorServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return tab_categoriaprestadorservicio::all();
         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ServiciosRecibidos = $request->serviciosAgregados;
        $CategoriasRecibidas = $request->categoriasAgregadas;
        $idPrestadorRecibido = $request->idPrestadorAgregar;
        $CantidadServicios = sizeof($ServiciosRecibidos);

        for ($i=0; $i < $CantidadServicios; $i++) {
            $categoriaprestadorservicio = new tab_categoriaprestadorservicio();
            $categoriaprestadorservicio -> prestador_id = $idPrestadorRecibido;
            $categoriaprestadorservicio -> categoria_id = $CategoriasRecibidas[$i];
            $categoriaprestadorservicio -> servicio_id = $ServiciosRecibidos[$i];
            $categoriaprestadorservicio -> save();
        }
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
        $categoriaprestadorservicio = tab_categoriaprestadorservicio::destroy($id);
        return $categoriaprestadorservicio;
    }
}
