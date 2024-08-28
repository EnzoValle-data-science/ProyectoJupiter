<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recetas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nombre');

            $table->string('categoria_receta');

            $table->integer('numero_porciones');
        
            $table->text('unidad_porcion');
         
            $table->integer('cantidad_porcion');
          
            $table->integer('costo_porcion');
          
            $table->integer('costo_receta');
          
            $table->integer('precio_porcion');
        
            $table->integer('utilidad_porcion');
          
            $table->float('margen_utilidad_porcion');
    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recetas');
    }
}
