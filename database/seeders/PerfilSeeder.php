<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = base_path("database/data/perfiles_data.csv");
        $data = array_map('str_getcsv', file($file));
        foreach ($data as $row) {
            DB::table('perfils')->insert([
                'detalle_perfil_id' => $row[0],
                'estudio_id' => $row[1],
            
                // Añade más columnas según sea necesario
            ]);
        }
    }
}
