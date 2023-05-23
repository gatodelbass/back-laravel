<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SolicitudNota extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'solicitud_notas';
   
    protected $guarded = [];

    /*
    public function usuario()
    { 
        return $this->belongsTo(Usuario::class, 'solnota_usuario', 'id');
    }
    */


    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
    ];
}
