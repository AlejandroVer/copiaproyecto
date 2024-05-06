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
        Schema::create('nmv_clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nit')->unique();
            $table->string('nombre_empresa', 45)->unique();
            $table->string('direccion');
            $table->string('barrio', 45);
            $table->string('ciudad', 45);
            $table->string('email', 255)->unique;
            $table->string('telefono');
            $table->string('imagen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nmv_clientes');
    }
};
