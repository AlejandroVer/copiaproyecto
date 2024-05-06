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
        Schema::create('agendas', function (Blueprint $table) {
            $table->id();
            $table->text('name', 45);
            $table->string('direccion', 45);
            $table->text('barrio');
            $table->text('ciudad', 45);
            $table->string('telefono', 55);
            $table->date('fecha_cita', 45);
            $table->time('hora_cita', 6);
            $table->text('objetivo_visita', 1000);
            $table->text('estado', 45);
            $table->dateTime('agendada_el');

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agendas');
    }
};
