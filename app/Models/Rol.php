<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rol extends Model
{
    protected $table = 'roles';
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    public function permisos()
    {
        return $this->hasMany(RolPermiso::class,   "rol_id");
    }

   
}
