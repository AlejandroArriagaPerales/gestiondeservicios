<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tab_productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('precio');
            $table->integer('proveedore_id')->unsigned();
            $table->integer('categoriaProducto_id')->unsigned();
            $table->string('estatus');
            $table->foreign('categoriaProducto_id')->references('id')->on('tab_categoriaproductos');
            $table->foreign('proveedore_id')->references('id')->on('tab_proveedores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tab_productos');
    }
}
