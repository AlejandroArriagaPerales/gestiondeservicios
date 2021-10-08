<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabCategoriaprestadorserviciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tab_categoriaprestadorservicios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prestador_id')->unsigned();
            $table->integer('categoria_id')->unsigned();
            $table->integer('servicio_id')->unsigned();
            $table->foreign('prestador_id')->references('id')->on('tab_prestadores');
            $table->foreign('categoria_id')->references('id')->on('tab_categorias');
            $table->foreign('servicio_id')->references('id')->on('tab_servicios');
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
        Schema::dropIfExists('tab_categoriaprestadorservicios');
    }
}
