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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();


            // $table->unsignedBigInteger('id_detalle_pedidos');
            // $table->foreign('id_detalle_pedidos')->references('id')->on('detalle_pedidos');

            $table->unsignedBigInteger('id_users');
            $table->foreign('id_users')->references('id')->on('users');

            $table->string('Descripcion','200')->nullable();
            $table->string('motivoCancelacion','200')->nullable();

            
            $table->string('Direcion','500')->nullable();
            $table->string('Telefono','15')->nullable();
            $table->string('Estado')->nullable();
            // $table->date('Fecha');
            $table->dateTime('Fecha')->default(now());
            $table->integer('Total');

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
        Schema::dropIfExists('pedidos');
    }
};
