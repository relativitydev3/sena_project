<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('insumos', function (Blueprint $table) {
        $table->id();
        $table->string('imagen')->nullable(); // Añadir ->nullable() al campo 'imagen'
        $table->string('nombre');
        $table->boolean('activo')->default(true);
        $table->float('cantidad_disponible');
        $table->string('unidad_medida');
        $table->float('precio_unitario');
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
        Schema::dropIfExists('insumos');
    }
};
