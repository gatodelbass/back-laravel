<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AnexoTipo;
use App\Models\SolicitudAnexo;
use App\Models\SolicitudValps;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Traits\SetClient;
use App\Http\Requests\SolicitudAnexoRequest;
use App\Http\Requests\SolicitudAnexoUpdateRequest;


class SolicitudAnexosController extends Controller
{

    use SetClient;

    public function index($clientepath)
    {
        $this->setCliente($clientepath);
        $solicitudes = Solicitudvalps::all();
        return $solicitudes->load('tiposolicitud');
    }


    public function obtenerAnexoTipos()
    {

        $anexoTipos = AnexoTipo::all();
        return $anexoTipos;
    }

    public function store(SolicitudAnexoRequest $request)
    {
        if ($request->hasFile('solanexo_anexo')) {
            $anexo = SolicitudAnexo::create($request->validated());
            $path = Storage::disk("public")->put("solicitudes/" . $request["solanexo_solicitud"] . "/anexos", $request->solanexo_anexo);
            $anexo->solanexo_anexo = $path;
            $anexo->solanexo_nombrearchivo = $request->solanexo_anexo->getClientOriginalName();
            $anexo->save();
            return response()->json(200);
        } else {
            return response()->json("Debe adjuntar el anexo", 422);
        }
    }


    public function update($anexoId, SolicitudAnexoUpdateRequest $request)
    {         
        
        $anexo = SolicitudAnexo::find($anexoId);

       // Log::debug($anexo);    

        $anexo->update($request->validated());

        if ($request->hasFile('solanexo_anexo')) {   
            $archivoAnterior =   $anexo->solanexo_anexo;      
            $path = Storage::disk("public")->put("solicitudes/" . $request["solanexo_solicitud"] . "/anexos", $request->solanexo_anexo);
            $anexo->solanexo_anexo = $path;
            $anexo->solanexo_nombrearchivo = $request->solanexo_anexo->getClientOriginalName();
            $anexo->save();           

            if (!is_null($archivoAnterior)) {
                Storage::disk('public')->delete($archivoAnterior);
            }
        } 

        return response()->json(200);
       
    }


    public function show($clientepath, $solicitudAnexoId)
    {
        $this->setCliente($clientepath);
        $solicitud = SolicitudAnexo::find($solicitudAnexoId);
        return $solicitud->load('tiposoporte');
    }

    public function solicitudAnexosDownload($anexoId)
    {
        $anexo = SolicitudAnexo::find($anexoId);
        Log::debug($anexo);
        return response()->download(public_path(Storage::url($anexo->solanexo_anexo)));
    }
}
