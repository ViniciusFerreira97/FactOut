<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resposta extends Model
{
    //
    protected $table = 'resposta';
    protected $primaryKey = 'id_resposta';

    protected $fillable = [
        'id_lider',
        'id_fato',
        'resposta',
    ];
}
