<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolPermiso extends Model
{
    protected $table = 'rol_permisos';
    use HasFactory;

    protected $guarded = [];

    public function permiso()
    {
        return $this->belongsTo(Permiso::class); 
    }

}
