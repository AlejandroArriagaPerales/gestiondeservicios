<?php

namespace App\Http\Controllers;

use App\Models\tab_categoria;
use App\Models\tab_categoriaprestadorservicio;
use App\Models\tab_prestadore;
use App\Models\tab_servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
        $prestador->telefono = $request->telefonoPrestador;
        $prestador->disponibilidad = $request->disponibilidadSeleccionada;
        $prestador->imagen = '0';
        $prestador->estatus = '1';
        $prestador->contrasena = $request->contrasenaPrestador;
        $prestador->save();

        $ServiciosRecibidos = $request->serviciosAgregados;
        $CategoriasRecibidas = $request->categoriasAgregadas;
        $CantidadServicios = sizeof($ServiciosRecibidos);

        for ($i=0; $i < $CantidadServicios; $i++) {
            $categoriaprestadorservicio = new tab_categoriaprestadorservicio();
            $categoriaprestadorservicio -> prestador_id = tab_prestadore::latest('id')->first('id')->id;
            $categoriaprestadorservicio -> categoria_id = $CategoriasRecibidas[$i];
            $categoriaprestadorservicio -> servicio_id = $ServiciosRecibidos[$i];
            $categoriaprestadorservicio -> save();
        }

    
        


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
        $prestador = tab_prestadore::find($id);
        $prestador->nombre = $request->nombreActualizar;
        $prestador->apellido = $request->apellidoActualizar;
        $prestador->correo = $request->correoActualizar;
        $prestador->telefono = $request->telefonoActualizar;
        $prestador->estatus = $request->estatusActualizar;
        

        $prestador->save();

        return $prestador;
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
