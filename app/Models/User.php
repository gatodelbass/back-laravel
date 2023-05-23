<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * 
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol_id',
        'status',
        'token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function obtenerToken()
    {
        return $this->token;
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    public function usuarioPermisos()
    {
        $userPermisos = DB::table('permisos')
            ->join('rol_permisos', 'rol_permisos.permiso_id', '=', 'permisos.id')
            ->join('roles', 'roles.id', '=', 'rol_permisos.rol_id')
            ->where('roles.id', '=', $this->rol_id)
            ->where('roles.deleted_at', '=', null)
            ->pluck('permisos.per_nombre')->toArray();
        return $userPermisos;
    }
}
