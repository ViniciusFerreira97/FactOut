<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class EquipeController extends Controller
{
    public function Alunos_Minha_Equipe(){
        $retorno['success'] = true;
        $NumEquipe = DB::table('aluno_equipe')->where('id_usuario','=',Session::get('id_usuario'))->pluck('id_equipe')->first();
        $equipe =DB::table('aluno as a')->join('aluno_equipe as aeq','a.id_usuario','=', 'aeq.id_usuario')->where('aeq.id_equipe', '=', $NumEquipe)->get();
        $contador = 0;
        foreach ($equipe as $eq){
            $aluno = DB::table('aluno as a')->join('usuario as usu', 'a.id_usuario', '=', 'usu.id_usuario')->where('a.id_usuario','=', $eq->id_usuario)->pluck('usu.nome')->first();
            $retorno['data'][$contador]['nome'] =$aluno;
            $contador++;
        }
        return $retorno;
    }
}
