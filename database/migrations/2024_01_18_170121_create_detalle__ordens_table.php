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
        Schema::create('detalle__ordens', function (Blueprint $table) {
            $table->id();
            $table->float('total');
            $table->string('doctor',45);
            $table->string('estado',20);
            $table->unsignedBigInteger('paciente_id');
            //Foreign Keys
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle__ordens');
    }
};
