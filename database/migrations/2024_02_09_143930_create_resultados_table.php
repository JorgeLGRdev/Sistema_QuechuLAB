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
        Schema::create('resultados', function (Blueprint $table) {
            $table->id();
            $table->string('resultado',45);
            $table->string('nota',100)->nullable();
            $table->string('parametro',50)->nullable();
            $table->string('unidades',20)->nullable();
            $table->string('val_ref_texto',45)->nullable();
            $table->string('val_ref_inicial',20)->nullable();
            $table->string('val_ref_final',20)->nullable();

            $table->unsignedBigInteger('estudio_id');
            $table->unsignedBigInteger('detalle_orden_id');
            //Foreign Keys
            $table->foreign('estudio_id')->references('id')->on('estudios')->onDelete('cascade');
            $table->foreign('detalle_orden_id')->references('id')->on('detalle__ordens')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultados');
    }
};
