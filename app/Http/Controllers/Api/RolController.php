<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

use App\Models\Rol;
use App\Models\Permiso;
use App\Models\RolPermiso;

use Illuminate\Support\Facades\Redirect;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RolRequest;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Rol::all();
        return $roles;
    }


    public function store(RolRequest $request)
    {
        Rol::create($request->validated());
        return response()->json(200);
    }


    public function detail($rolId)
    {
        $rol = Rol::find($rolId);
        return $rol;
    }

    public function obtenerPermisosRol($rolId)
    {

        $rolePermissions = DB::table('permisos')
            ->join('rol_permisos', 'rol_permisos.permiso_id', '=', 'permisos.id')
            ->join('roles', 'roles.id', '=', 'rol_permisos.rol_id')
            ->where('roles.id', '=', $rolId)
            ->where('roles.deleted_at', '=', null)
            ->pluck('permisos.per_nombre');

        return $rolePermissions;
    }

    public function habilitarPermiso($rolId, $permisoId)
    {
        $rolPermiso = RolPermiso::where("rol_id", $rolId)->where("permiso_id", $permisoId)->first();

        if ($rolPermiso == null) {
            $rolPermiso =  new RolPermiso();
            $rolPermiso->rol_id = $rolId;
            $rolPermiso->permiso_id = $permisoId;
            $rolPermiso->save();
        } else {
            $rolPermiso->delete();
        }
    }

    public function rolesDelete($rolId)
    {
        $rol = Rol::find($rolId);
        $rol->delete();
        return response()->noContent();
    }
}
