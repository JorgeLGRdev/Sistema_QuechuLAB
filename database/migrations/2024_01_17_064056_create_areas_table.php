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
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
        });

        //Inserción de datos
        DB::table('areas')->insert([
            ['nombre' => 'Hematología'],
            ['nombre' => 'Inmunología'],
            ['nombre' => 'Química clínica'],
            ['nombre' => 'Hormonales'],
            ['nombre' => 'Parasitología'],
            ['nombre' => 'Microbiología'],
            ['nombre' => 'Uroanálisis']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('areas');
    }
};
