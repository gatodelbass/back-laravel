<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Models\SolicitudValps;
use App\Models\SolicitudValpsNota;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Traits\SetClient;

class SolicitudValpsNotasController extends Controller
{
    use SetClient;   

    public function store($clientepath, Request $request)
    {

        $this->setCliente($clientepath);

        $solicitudValpsNota = new SolicitudValpsNota();
        $solicitudValpsNota->solvnotas_solicitud = $request->datosForm["solvnotas_solicitud"];
        $solicitudValpsNota->solvnotas_usuario = $request->datosForm["solvnotas_usuario"];
        $solicitudValpsNota->solvnotas_nota = $request->datosForm["solvnotas_nota"];
        //$solicitudValpsNota->solvnotas_adjunto = $request->datosForm["solvnotas_adjunto"];     
        $solicitudValpsNota->save();
    }


    public function update($clientepath, Request $request)
    {

        $this->setCliente($clientepath);
        $solicitudvalps = Solicitudvalps::find($request->datosForm["solv_id"]);

        if ($solicitudvalps != null) {
            $solicitudvalps->solv_tipo = $request->datosForm["solv_tipo"];
            $solicitudvalps->solv_estado = $request->datosForm["solv_estado"];
            $solicitudvalps->solv_email = $request->datosForm["solv_email"];
            $solicitudvalps->solv_nombresolicitante = $request->datosForm["solv_nombresolicitante"];
            $solicitudvalps->solv_texto = $request->datosForm["solv_texto"];
            $solicitudvalps->save();
        }
    }
}
