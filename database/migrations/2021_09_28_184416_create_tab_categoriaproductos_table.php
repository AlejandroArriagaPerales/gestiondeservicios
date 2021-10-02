<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabCategoriaproductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tab_categoriaproductos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('proveedore_id')->unsigned();
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
        Schema::dropIfExists('tab_categoriaproductos');
    }
}
