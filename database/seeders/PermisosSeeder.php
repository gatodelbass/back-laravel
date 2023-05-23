<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rol;
use App\Models\Permiso;
use App\Models\RolPermiso;


class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create permisos
        Permiso::create(['per_nombre' => 'clientes ver', 'per_grupo' => 'Clientes']);
        Permiso::create(['per_nombre' => 'clientes crear', 'per_grupo' => 'Clientes']);
        Permiso::create(['per_nombre' => 'clientes eliminar', 'per_grupo' => 'Clientes']);
        Permiso::create(['per_nombre' => 'clientes usuarios', 'per_grupo' => 'Clientes']);

        Permiso::create(['per_nombre' => 'solicitudes ver', 'per_grupo' => 'Solicitudes']);
        Permiso::create(['per_nombre' => 'solicitudes crear', 'per_grupo' => 'Solicitudes']);
        Permiso::create(['per_nombre' => 'solicitudes eliminar', 'per_grupo' => 'Solicitudes']);

        Permiso::create(['per_nombre' => 'tipos solicitudes ver', 'per_grupo' => 'Tipos solicitudes']);
        Permiso::create(['per_nombre' => 'tipos solicitudes crear', 'per_grupo' => 'Tipos solicitudes']);
        Permiso::create(['per_nombre' => 'tipos solicitudes eliminar', 'per_grupo' => 'Tipos solicitudes']);

        Permiso::create(['per_nombre' => 'tipos anexos ver', 'per_grupo' => 'Tipos anexos']);
        Permiso::create(['per_nombre' => 'tipos anexos crear', 'per_grupo' => 'Tipos anexos']);
        Permiso::create(['per_nombre' => 'tipos anexos eliminar', 'per_grupo' => 'Tipos anexos']);

        Permiso::create(['per_nombre' => 'roles ver', 'per_grupo' => 'Roles']);
        Permiso::create(['per_nombre' => 'roles crear', 'per_grupo' => 'Roles']);
        Permiso::create(['per_nombre' => 'roles eliminar', 'per_grupo' => 'Roles']);

        Permiso::create(['per_nombre' => 'usuarios ver', 'per_grupo' => 'Usuarios']);
        Permiso::create(['per_nombre' => 'usuarios crear', 'per_grupo' => 'Usuarios']);
        Permiso::create(['per_nombre' => 'usuarios eliminar', 'per_grupo' => 'Usuarios']);

        // create roles
        $rol1 = Rol::create(['rol_nombre' => 'admin']);
        $rol2 = Rol::create(['rol_nombre' => 'usuario']);

        //set admin rol with all permisos
        $permisos = Permiso::all();

        foreach ($permisos as $permiso) {
            RolPermiso::create(['rol_id' => $rol1->id, 'permiso_id' => $permiso->id]);
        }
    }
}
