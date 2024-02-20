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
        Schema::create('valor_referencias', function (Blueprint $table) {
            $table->id();
            $table->enum('sexo',['M', 'F', 'G']);
            $table->tinyInteger('edad_inicial');
            $table->string('periodo_inicial',10);
            $table->tinyInteger('edad_final');
            $table->string('periodo_final',10);
            $table->string('valor_texto',45)->nullable();
            $table->string('valor_inicial',45)->nullable();
            $table->string('valor_final',45)->nullable();
            $table->string('nota_predefinida',100)->nullable();
            $table->string('altura_inicial',45)->nullable();
            $table->string('altura_final',45)->nullable();
            $table->unsignedBigInteger('estudio_id');
            //FK
            $table->foreign('estudio_id')->references('id')->on('estudios')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('valor_referencias');
    }
};
