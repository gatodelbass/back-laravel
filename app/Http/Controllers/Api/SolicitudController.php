<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Http\Requests\SolicitudRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class SolicitudController extends Controller
{

    public function index($clienteId)
    {
        $solicitudes = Solicitud::where("sol_cliente", $clienteId)->orderBy("created_at", "DESC")->get();
        return $solicitudes->load("solicitudtipo");
    }

    public function store(SolicitudRequest $request)
    {
        Solicitud::create($request->validated());
        return response()->json(200);
    }

    public function update($solicitudId, SolicitudRequest $request)
    {
        $solicitud = Solicitud::find($solicitudId);
        $solicitud->update($request->validated());
        return response()->json(200);
    }


    public function detail($solicitudId)
    {
        $solicitud = Solicitud::find($solicitudId);
        return $solicitud->load("solicitudTipo", "anexos.anexoTipo", "notas");
    }

    public function show($clientepath, $solicitudId)
    {
        $this->setCliente($clientepath);
        $solicitud = Solicitud::find($solicitudId);
        return $solicitud;
    }


    public function reporte(Request $request)
    {
        $arraySolicitudes = [];
        foreach ($request->arrayClientes as $clientepath) {

            try {
                $this->setCliente($clientepath);
                $solicitudes = Solicitud::whereBetween('solv_fechasolicitud', [$request->fechainicial . " 00:00:00", $request->fechafinal . " 23:59:59"])->get();
                array_push($arraySolicitudes, $solicitudes->load("tiposolicitud"));
            } catch (\Throwable $th) {
                //Log::debug("ERROR " . $th);
            }
        }

        return $arraySolicitudes;
    }


    public function reporteEstadistico(Request $request)
    {
        $arraySolicitudes = array();

        $arraySolicitudes["Solicitado"] = 0;
        $arraySolicitudes["Enviado"] = 0;
        $arraySolicitudes["Devuelto"] = 0;

        foreach ($request->arrayClientes as $clientepath) {

            try {
                $this->setCliente($clientepath);

                $estadoSolicitado = Solicitud::whereBetween('solv_fechasolicitud', [$request->fechainicial . " 00:00:00", $request->fechafinal . " 23:59:59"])->where("solv_estado", "Solicitado")->get()->count();
                $estadoEnviado = Solicitud::whereBetween('solv_fechasolicitud', [$request->fechainicial . " 00:00:00", $request->fechafinal . " 23:59:59"])->where("solv_estado", "Enviado")->get()->count();
                $estadoDevuelto = Solicitud::whereBetween('solv_fechasolicitud', [$request->fechainicial . " 00:00:00", $request->fechafinal . " 23:59:59"])->where("solv_estado", "Devuelto")->get()->count();

                $arraySolicitudes["Solicitado"] = $arraySolicitudes["Solicitado"] + $estadoSolicitado;
                $arraySolicitudes["Enviado"] = $arraySolicitudes["Enviado"] + $estadoEnviado;
                $arraySolicitudes["Devuelto"] = $arraySolicitudes["Devuelto"] + $estadoDevuelto;
            } catch (\Throwable $th) {
                //Log::debug("ERROR " . $th);
            }
        }
        return $arraySolicitudes;
    }

    public function solicitudesDelete($solicitudId)
    {
        $solicitud = Solicitud::find($solicitudId);
        $solicitud->delete();
        return response()->noContent();
    }


    public function testApi()
    {
        return "API ok ok";
    }
}
