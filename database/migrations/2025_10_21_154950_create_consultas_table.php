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
    Schema::create('consultas', function (Blueprint $table) {
        $table->id();
        $table->string('consulta');
        $table->text('respuesta');
        $table->timestamps(); // guarda fecha y hora
    });
}

};
