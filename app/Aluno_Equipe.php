<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno_Equipe extends Model
{
    protected $table = 'aluno_equipe';
    protected $primaryKey = 'id_aluno_equipe';

    protected $fillable = [
        'id_aluno_equipe',
        'id_usuario',
        'id_equipe',
    ];
}
