<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClienteUsuario extends Model
{
    use HasFactory;
    protected $table = 'cliente_usuarios';
    protected $guarded = [];
}
