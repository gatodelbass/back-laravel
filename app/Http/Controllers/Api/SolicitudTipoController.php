<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SolicitudValps;
use App\Models\SolicitudValpsNota;
use App\Models\SolicitudTipo;
use Illuminate\Support\Facades\Log;
use App\Traits\SetClient;

class SolicitudTipoController extends Controller
{
    use SetClient;

    public function obtenerSolicitudTipos(){

       // $this->setCliente($clientepath);


        $tiposSolicitud = SolicitudTipo::all();
        return $tiposSolicitud;
    }

   
}
