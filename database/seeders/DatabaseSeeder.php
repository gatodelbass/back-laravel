<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SolicitudTiposSeeder::class,           
            PermisosSeeder::class,
            AdminSeeder::class,
        ]);
    }
}
