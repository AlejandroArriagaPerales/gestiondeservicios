<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\tab_categoria;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /*
    public function __construct()
    {
        $this->middleware('auth');
    }*/


    public function index()
    {
        //Mostrar

        return tab_categoria::all();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
    {
        //Registrar
        $categoria = new tab_categoria();
        $categoria->nombre = $request->nombreCategoria;
        $categoria->costovisita = $request->costoVisitaCategoria;        
        $categoria->icono = '0';
        $categoria->save();

        return $categoria;


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

/*
    public function show($id)
    {
        //
    }
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
        $categoria = tab_categoria::find($id);
        $categoria->nombre = $request->nombreActualizar;
        $categoria->save();

        return $categoria;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    {
        // Eliminar


    }
}
