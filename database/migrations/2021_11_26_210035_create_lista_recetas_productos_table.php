<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListaRecetasProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lista_recetas_productos', function (Blueprint $table) {       
            $table->id();
            $table->timestamps();
            $table->foreignId('id_receta')->constrained('recetas'); 

            $table->text('nombre_ingrediente');

            $table->foreignId('id_ingrediente')->constrained('productos'); 
            
            $table->integer('cantidad_ingrediente');
            
            $table->text('unidad_medida_ingrediente');
          
            $table->text('unidad_medida_rendimiento');

            $table->float('fu_utilizable');
            
            $table->float('fu_unidad');
       
            $table->integer('costo_receta_producto');
      

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lista_recetas_producto');
    }
}
