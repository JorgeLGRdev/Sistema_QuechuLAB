<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DetallePerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = base_path("database/data/detalle_perfiles_data.csv");
        $data = array_map('str_getcsv', file($file));
        foreach ($data as $row) {
            DB::table('detalle__perfils')->insert([
                'nombre' => $row[0],
                'metodo' => $row[1],
                'tipo_muestra' => $row[2],
                // Añade más columnas según sea necesario
            ]);
        }
    }
}
