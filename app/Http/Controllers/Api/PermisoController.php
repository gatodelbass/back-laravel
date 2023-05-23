<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Permiso;
use App\Http\Requests\PermisoRequest;
use Illuminate\Support\Facades\DB;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permisos = DB::table('permisos')
        ->select('id', 'per_nombre', 'per_grupo')
        ->get()->groupBy('per_grupo');
        return $permisos;
    }


    public function store(PermisoRequest $request)
    {
        Permiso::create($request->validated());
        return response()->json(200);
    }


    public function detail($rolId)
    {
        $rol = Permiso::find($rolId);
        return $rol;
    }
}
