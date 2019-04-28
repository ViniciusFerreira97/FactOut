<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jf extends Model
{
    protected $table = 'julgamento_fatos';

    protected $fillable = [
        'id_jf',
        'codigo_turma',
        'tamanho_equipe',
        'tempo_fato',
        'status_jf',
    ];
}
