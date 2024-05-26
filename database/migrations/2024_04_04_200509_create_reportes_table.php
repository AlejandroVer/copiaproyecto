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
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();
            $table->point('ubicacion')->nullable();
            $table->text('razon');
            $table->string('direccion', 45);
            $table->text('ciudad', 45);
            $table->string('objetivo_visita', 55);
            $table->text('informe');
            $table->datetime('fecha_reporte');

            $table->foreignId('area_id')->constrained('area_user')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};
