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
        Schema::create('estudios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre',100);
            $table->float('precio');
            $table->string('contenedor',45);
            $table->string('metodo',50);
            $table->string('abreviatura',20); 

            $table->string('unidades',20)->nullable();
            $table->string('tipo_muestra',45)->nullable();
            $table->enum('sexo', ['M', 'F', 'G'])->nullable(); //ojoaqui
            $table->tinyInteger('horas_proceso')->nullable();
            $table->tinyInteger('dias_entrega')->nullable();
            $table->enum('reporte_especial', ['S', 'N'])->nullable(); //ojoaqui
            $table->enum('es_perfil', ['s', 'n'])->nullable(); //ojoaqui


            $table->unsignedBigInteger('area_id');
            $table->timestamps();

            //Foreign Keys
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudios');
    }
};
