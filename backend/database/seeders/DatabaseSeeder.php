<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear empleados
        DB::table('empleados')->insert([
            ['nombre' => 'Juan Pérez'],
            ['nombre' => 'Ana García'],
        ]);

        // Crear estados
        DB::table('estados')->insert([
            ['nombre' => 'Pendiente'],
            ['nombre' => 'En Proceso'],
            ['nombre' => 'Terminada'],
            ['nombre' => 'En Impedimento'],
        ]);

        // Crear prioridades
        DB::table('prioridades')->insert([
            ['nombre' => 'Alta'],
            ['nombre' => 'Media'],
            ['nombre' => 'Baja'],
        ]);
    }
}
