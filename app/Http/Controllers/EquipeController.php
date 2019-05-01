<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Jf as Jf;

class EquipeController extends Controller
{
    public function Alunos_Minha_Equipe(){
        $retorno['success'] = true;
        $NumEquipe = DB::table('aluno_equipe')->where('id_usuario','=',Session::get('id_usuario'))->pluck('id_equipe')->first();
        $equipe =DB::table('aluno as a')->join('aluno_equipe as aeq','a.id_usuario','=', 'aeq.id_usuario')->where('aeq.id_equipe', '=', $NumEquipe)->get();
        $contador = 0;
        $retorno['data'] = [];
        foreach ($equipe as $eq){
            $aluno = DB::table('aluno as a')->join('usuario as usu', 'a.id_usuario', '=', 'usu.id_usuario')->where('a.id_usuario','=', $eq->id_usuario)->pluck('usu.nome')->first();
            $retorno['data'][$contador]['nome'] = $aluno;
            $contador++;
        }
        return $retorno;
    }

    public function Excluir_Equipe(resquest $request){
        $retorno['success'] = true;
        $NumEquipe = DB::table('equipe')->where('id_usuario','=',Session::get('id_usuario'))->where('id_jf', '=', $request->id_jf)->count();
        if($NumEquipe >0)
        {
            $equipe = DB::table('equipe')->where('id_usuario','=',Session::get('id_usuario'))->where('id_jf', '=', $request->id_jf)->pluck('id_equipe')->fist();
            App\Equipe::destroy($equipe);
        }
        else{
            $equipe = DB::table('equipe as eq')->where('eq.id_jf', '=', $request->id_jf)->join('aluno_equipe as aeq', 'eq.id_equipe', '=', 'aeq.id_equipe')->where('aeq.id_usuario','=',Session::get('id_usuario'))->pluck('aeq.id_aluno_equipe')->fist();
            App\Aluno_Equipe::destroy($equipe);
        }
        return $retorno;
    }

    public function Get_Alunos_Da_Turma(Request $request)
    {
        $retorno = [];
        $retorno['success'] = true;
        $codTurm = Jf::where('id_jf','=', $request->codigo_JF)->pluck('codigo_turma')->first();
        $alunoEmEquipe = DB::table('aluno_equipe as aeq')->join('equipe as eq','eq.id_equipe','=','aeq.id_equipe')->where('eq.codigo_turma','=',$codTurm)->pluck('aeq.id_usuario');
        $notInEquipe = [];
        foreach($alunoEmEquipe as $ae){
            $notInEquipe[] = $ae;
        }
        $semEquipeDaTurma = DB::table('aluno as a')->join('usuario as u','a.id_usuario','=','u.id_usuario')->where('a.codigo_turma','=',$codTurm)->whereNotIn('a.id_usuario',$notInEquipe)->select('u.nome')->get();
        $cont = 0;
        foreach ($semEquipeDaTurma as $aluno) {
            $retorno['data'][$cont]['nome'] = $aluno->nome;
            $cont++;
        }
        return $retorno;
    }
}
