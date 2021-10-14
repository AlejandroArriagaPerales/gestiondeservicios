<?php

namespace App\Http\Controllers;

use App\Models\tab_categoriaproducto;
use Illuminate\Http\Request;

class CategoriaProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return tab_categoriaproducto::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contacto = new tab_categoriaproducto();
        $contacto->nombre = $request->nombreCategoriaProducto;
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
        $categoriaproducto = tab_categoriaproducto::find($id);
        $categoriaproducto->nombre = $request->nombreActualizar;
        $categoriaproducto->proveedore_id = $request->proveedorSeleccionadoActualizar;

        $categoriaproducto->save();

        return $categoriaproducto;
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
