<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'login',
        'nome',
        'email',
        'senha',
        'tipo_usuario'
    ];
}
