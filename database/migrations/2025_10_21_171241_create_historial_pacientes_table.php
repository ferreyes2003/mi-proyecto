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
    Schema::create('historial_pacientes', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->integer('edad')->nullable();
        $table->string('sintomas')->nullable();
        $table->text('diagnostico')->nullable();
        $table->timestamps();
    });
}

};
