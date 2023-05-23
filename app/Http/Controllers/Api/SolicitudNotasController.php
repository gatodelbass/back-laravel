<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NotaTipo;
use App\Models\SolicitudNota;
use Illuminate\Http\Request;
use App\Models\SolicitudValps;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SolicitudNotaRequest;


class SolicitudNotasController extends Controller
{
    public function index()
    {
    }


    public function store(SolicitudNotaRequest $request)
    {
        $nota = SolicitudNota::create($request->validated());
        return response()->json(200);
    }


    public function update($notaId, SolicitudNotaRequest $request)
    {
        $nota = SolicitudNota::find($notaId);
        $nota->update($request->validated());
        return response()->json(200);
    }
}