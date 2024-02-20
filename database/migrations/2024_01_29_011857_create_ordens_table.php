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
        Schema::create('ordens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('detalle_orden_id');
            $table->unsignedBigInteger('estudio_id');
           // $table->enum('es_perfil', ['S', 'N'])->nullable(); //ojoaqui
            //Foreign Keys
            $table->foreign('detalle_orden_id')->references('id')->on('detalle__ordens')->onDelete('cascade');
            $table->foreign('estudio_id')->references('id')->on('estudios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordens');
    }
};
