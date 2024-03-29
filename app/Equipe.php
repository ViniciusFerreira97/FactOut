<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    protected $table = 'equipe';
    protected $primaryKey = 'id_equipe';

    protected $fillable = [
        'id_equipe',
        'codigo_turma',
        'lider',
        'id_jf',
    ];
}
