<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    //

    protected $table = 'turma';
    protected $primaryKey = 'codigo_turma';

    protected $fillable = [
        'disciplina',
        'curso',
        'unidade_universidade',
        'id_professor',
    ];
}
