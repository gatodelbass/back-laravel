<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use App\Models\ClienteUsuario;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{

    public function index()
    {
        $clientes = Cliente::all();
        return $clientes;
    }

    public function store(ClienteRequest $request)
    {
        Cliente::create($request->validated());
        return response()->json(200);
    }

    public function update($usuarioId, ClienteRequest $request)
    {
        $usuario = Cliente::find($usuarioId);
        $usuario->update($request->validated());
        return response()->json(200);
    }

    public function detail($usuarioId)
    {
        $usuario = Cliente::find($usuarioId);
        return $usuario;
    }

    public function obtenerClientesActivos()
    {
        $usuarioClientespermitidos = ClienteUsuario::select("cliusu_cliente")->where("cliusu_usuario", Auth::user()->id)->pluck("cliusu_cliente");
        $clientesActivos = Cliente::whereIn('id', $usuarioClientespermitidos)->get();
        return $clientesActivos;
    }

    public function obtenerClientePorId($clienteId)
    {
        $cliente = Cliente::find($clienteId);
        return $cliente;
    }

    public function obtenerUsuariosHabilitados($clienteId)
    {
        $usuariosHabilitados = ClienteUsuario::select("cliusu_usuario")->where("cliusu_cliente", $clienteId)->pluck("cliusu_usuario");
        return $usuariosHabilitados;
    }

    public function habilitarUsuario($clienteId, $usuarioId)
    {

        $clienteUsuario = ClienteUsuario::where("cliusu_cliente", $clienteId)->where("cliusu_usuario", $usuarioId)->first();

        if ($clienteUsuario == null) {
            $clienteUsuario =  new ClienteUsuario();
            $clienteUsuario->cliusu_cliente = $clienteId;
            $clienteUsuario->cliusu_usuario = $usuarioId;
            $clienteUsuario->save();
        } else {
            $clienteUsuario->delete();
        }
    }

    public function clientesDelete($clienteId)
    {
        $cliente = Cliente::find($clienteId);
        $cliente->delete();
        return response()->noContent();
    }
}
