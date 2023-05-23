<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;
use App\Notifications\UsuarioNuevoNotification;
use App\Notifications\OlvidoPasswordNotification;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Request;
use stdClass;

class UsuarioController extends Controller
{

    public function obtenerUsuarioLogin(Request $request)
    {

        $user = User::find($request->user()->id);

        $usuario = new stdClass();
        $usuario->name = $user->name;
        $usuario->status = $user->status;
        $usuario->email = $user->email;
        $usuario->rol = $user->rol;
        $usuario->permisos = $user->usuarioPermisos();

        return $usuario;
    }

    public function index()
    {
        $usuarios = User::all();
        return $usuarios->load("rol");
    }

    public function store(UserRequest $request)
    {
        $usuario = User::create($request->validated() + [
            'password' => Hash::make($request->get('email')),
            'token' => strtoupper(Str::random(24)),
        ]);

        $user = User::find($usuario->id);
        $user->notify(new UsuarioNuevoNotification($user));
        return response()->json(200);
    }

    public function update($usuarioId, UserUpdateRequest $request)
    {
        $usuario = User::find($usuarioId);
        $usuario->update($request->validated());
        return response()->json(200);
    }

    public function detail($usuarioId)
    {
        $usuario = User::find($usuarioId);
        return $usuario;
    }

    public function obtenerUsuario($usuarioId)
    {
        $usuario = User::find($usuarioId);
        return $usuario;
    }

    public function usuariosDelete($usuarioId)
    {
        $usuario = User::find($usuarioId);
        $usuario->delete();
        return response()->noContent();
    }

    public function activarUsuario($usuarioId, $token)
    {
        $usuario = User::find($usuarioId);

        if ($usuario->token == $token) {
            $usuario->status = "cambiar_password";
            $usuario->token = strtoupper(Str::random(6));
            $usuario->save();
        }
        return $usuario;
    }

    public function cambiarPassword(Request $request)
    {
        $usuario = User::find($request->usuarioId);

        if ($request->password1 !== $request->password2) {
            return response()->json("Las contraseñas no coinciden", 422);
        }

        if (strlen($request->password1) < 8 || strlen($request->password2) < 8) {
            return response()->json("La contraseña debe tener minimo 8 caracteres", 422);
        }

        $usuario->password = Hash::make($request->password1);
        $usuario->status = "activo";
        $usuario->token = strtoupper(Str::random(6));
        $usuario->save();
        return response()->noContent();
    }

    public function olvidoEmailEnviar(Request $request)
    {

        $usuario = User::where("email", $request->email)->first();
        if ($usuario == null) {
            return response()->json("El email no esta registrado", 422);
        }
        $usuario->notify(new OlvidoPasswordNotification($usuario));
    }

    public function olvidoEmailEnviarToken(Request $request)
    {
        $usuario = User::where("email", $request->email)->first();
        if ($usuario == null) {
            return response()->json("El email no esta registrado", 422);
        }
        if ($usuario->token != $request->token) {
            return response()->json("El codigo enviado no es valido", 422);
        }

        $usuario->password = Hash::make($usuario->email);
        $usuario->status = "cambiar_password";
        $usuario->save();
        return response()->noContent();
    }
}
