<?php

namespace App\Http\Controllers;

use App\Models\tab_producto;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return tab_producto::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $proveedor = new tab_producto();
        $proveedor->nombre = $request->nombreProducto;
        $proveedor->precio = $request->precioProducto;
        $proveedor->categoriaProducto_id = $request->categoriaProductoSeleccionada;
        $proveedor->estatus = '1';
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
        $producto = tab_producto::find($id);
        $producto->nombre = $request->nombreActualizar;
        $producto->precio = $request->precioActualizar;
        $producto->categoriaProducto_id = $request->categoriaProductoActualizar;

        $producto->save();

        return $producto;
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
