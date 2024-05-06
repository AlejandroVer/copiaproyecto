<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sedes_nmvclientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_sede', 45)->unique();
            $table->string('direccion');
            $table->string('barrio', 45);
            $table->string('ciudad', 45);
            $table->string('telefono');

            $table->unsignedBigInteger('nmv_cliente_id');
            $table->foreign('nmv_cliente_id')->references('id')->on('nmv_clientes')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sedes_nmvclientes');
    }
};
