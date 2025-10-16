<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta la migración: crea la tabla enfermedades.
     */
    public function up(): void
    {
        Schema::create('enfermedades', function (Blueprint $table) {
            $table->id(); // Clave primaria autoincremental
            $table->string('nombre'); // Nombre de la enfermedad
            $table->text('descripcion'); // Descripción detallada
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Revierte la migración: elimina la tabla enfermedades.
     */
    public function down(): void
    {
        Schema::dropIfExists('enfermedades');
    }
};
