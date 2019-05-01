<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jf extends Model
{
    protected $table = 'julgamento_fatos';
    protected $primaryKey = 'id_jf';

    protected $fillable = [
        'id_jf',
        'nome',
        'codigo_turma',
        'tamanho_equipe',
        'tempo_fato',
        'status_jf',
    ];
}
