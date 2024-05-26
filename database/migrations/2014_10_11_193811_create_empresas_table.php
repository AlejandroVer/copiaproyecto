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
        Schema::create('empresas', function (Blueprint $table) {
            
            $table->id();
            $table->string('name');
            $table->bigInteger('nit');
            $table->string('rep_legal',45);
            $table->string('cargo_rep_legal',45);
            $table->string('cel_rep_legal',);
            $table->string('email_rep_legal',)->unique();
            $table->string('jefe_th', 45);
            $table->string('cargo_jefe_th', 45);
            $table->string('cel_jefe_th', 45);
            $table->string('email_jefe_th')->unique();
            $table->string('contacto_th');
            $table->string('cargo_contacto_th', 45);
            $table->string('cel_contacto_th');
            $table->string('email_contacto_th')->unique();
            $table->string('numero_trabajadores');
            $table->string('estado_empresa');
            
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};