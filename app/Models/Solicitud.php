<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Solicitud extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'solicitudes';

    protected $guarded = [];

    public function solicitudTipo()
    { 
        return $this->belongsTo(SolicitudTipo::class, 'sol_tipo', 'id');
    }

    public function anexos()
    {
        return $this->hasMany(SolicitudAnexo::class,   "solanexo_solicitud");
    }

    public function notas()
    {
        return $this->hasMany(SolicitudNota::class, 'solnota_solicitud')->orderBy('created_at', "DESC");
    }

    
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];
}
