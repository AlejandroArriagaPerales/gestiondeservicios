<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTabTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tab_trabajos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('estado_servicio');
            $table->string('fecha_publicacion');
            $table->string('fecha_aceptacion');
            $table->integer('valoracion')->nullable();
            $table->string('resena')->nullable();
            $table->float('costo');
            $table->float('costovisita');
            $table->float('latitud');
            $table->float('longitud');
            $table->string('descripcion');
            $table->integer('prestador_id')->unsigned();
            $table->integer('cliente_id')->unsigned();
            $table->integer('servicio_id')->unsigned();
            $table->foreign('prestador_id')->references('id')->on('tab_prestadores');
            $table->foreign('cliente_id')->references('id')->on('tab_clientes');
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
        Schema::dropIfExists('tab_trabajos');
    }
}
