<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SolicitudTipo;

class SolicitudTiposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SolicitudTipo::updateOrCreate(
            ['id' => 1],
            [
                'id' => 1,
                'soltipo_tipo' => 'Ingreso', 
                'soltipo_estado' => 1,
            ]
        );

        SolicitudTipo::updateOrCreate(
            ['id' => 2],
            [
                'id' => 2,
                'soltipo_tipo' => 'Retiro', 
                'soltipo_estado' => 1,
            ]
        );   
    }
}
