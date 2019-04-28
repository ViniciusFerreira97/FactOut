<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Fato extends Model
{
    protected $table = 'fato';

    protected $fillable = [
        'id_fato',
        'orderm_fato',
        'texto_fato',
        'resposta_fato',
        'id_jf',
    ];

}