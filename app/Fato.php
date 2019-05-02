<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Fato extends Model
{
    protected $table = 'fato';
    protected $primaryKey = 'id_fato';

    protected $fillable = [
        'id_fato',
        'ordem_fato',
        'texto_fato',
        'resposta_fato',
        'id_jf',
    ];

}