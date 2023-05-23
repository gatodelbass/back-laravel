<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AnexoTipo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SolicitudAnexo extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'solicitud_anexos';
   
    protected $guarded = [];

    public function anexoTipo()
    { 
        return $this->belongsTo(AnexoTipo::class, 'solanexo_tipo', 'id');
    }

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];
}
