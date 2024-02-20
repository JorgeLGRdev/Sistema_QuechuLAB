<?php

namespace Database\Seeders;

use App\Models\Estudio;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class EstudioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $file = base_path("database/data/estudios_data.csv");
            $data = array_map('str_getcsv', file($file));
            foreach ($data as $row) {
                DB::table('estudios')->insert([
                    'nombre' => $row[0],
                    'precio' => $row[1],
                    'contenedor' => $row[2],
                    'metodo' => $row[3],
                    'abreviatura' => $row[4],
                    'area_id' => $row[5],
                    'es_perfil' => $row[6]
                    // Añade más columnas según sea necesario
                ]);
            }
    }
}
