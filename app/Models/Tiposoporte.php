<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tiposoporte extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'sfet_tiposoporte';
    protected $primaryKey = 'tiposoporte_id';
    public $timestamps = false;
}
