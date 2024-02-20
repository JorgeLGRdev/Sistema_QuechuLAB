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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('apellido_paterno');//must be 45
            $table->string('apellido_materno')->nullable();//must be 45
            $table->string('nombre');//must be 45
            $table->enum('sexo', ['M', 'F']);
            $table->date('fecha_nacimiento');
           // $table->string('unidad_edad'); // Unidad de medida de la edad (días, meses, años)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
