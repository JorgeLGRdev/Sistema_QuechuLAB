<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('perfils', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('detalle_perfil_id');
            $table->unsignedBigInteger('estudio_id');
               //Foreign Keys
            $table->foreign('detalle_perfil_id')->references('id')->on('detalle__perfils')->onDelete('cascade');
            $table->foreign('estudio_id')->references('id')->on('estudios')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfils');
    }
};
