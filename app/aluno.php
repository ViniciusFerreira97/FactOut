<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class aluno extends Model
{
    //
    protected $primaryKey = 'id_usuario';
    protected $table = 'aluno';

    protected $fillable = [
        'id_aluno',
        'curso',
        'codigo_turma',
    ];
}
