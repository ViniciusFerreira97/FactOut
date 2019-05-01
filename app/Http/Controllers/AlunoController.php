<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\aluno;
use DB;
use App\Jf as Jf;

class AlunoController extends Controller
{
    //

    public function registrarAluno($id_aluno,$curso,$codigo_turma = null){
        $aluno = new aluno();
        $aluno->id_usuario = $id_aluno;
        $aluno->curso = $curso;
        $aluno->codigo_turma = $codigo_turma;
        $aluno->save();
    }

    public function Set_Alunos_Turma(resquest $request){
        $rules = array(
            'id_turma'    => 'required',
            'a_alunos' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $return['success'] = false;
            $return['data'] = $validator->errors()->all();
            return $return;
        }

        foreach ($request->a_alunos as $aluno) {
            App\aluno::where('id_usuario', $aluno)
                ->update(['codigo_turma' => $request->id_turma]);
        }
    }

    public function Get_Alunos_Sem_Turma()
    {
        $retorno = [];
        $alunos = DB::table('aluno')->where('codigo_turma',null)->get();
        $contador = 0;
        foreach ($alunos as $t){
            $retorno[$contador]['id_usuario'] = $t->id_usuario;
            $retorno[$contador]['curso'] = $t->curso;
            $alunosSemTurma = DB::table('usuario')->where('id_usuario',$t->id_usuario)->get();
            $retorno[$contador]['nome'] = $alunosSemTurma[0]->nome;
            $retorno[$contador]['login'] = $alunosSemTurma[0]->login;
            $contador++;
        }
        return $retorno;
    }

    public function Get_Alunos_Da_Turma(Request $request)
    {
        $retorno = [];
        $retorno['success'] = true;
        $codTurm = Jf::where('id_jf','=', $request->codigo_JF)->pluck('codigo_turma')->first();
        $alunoEmEquipe = DB::table('aluno_equipe')->join('equipe as e', 'e.codigo_turma', '=', $codTurm)->get();
        $contador=0;
        $alunosSemEquipe=[];
        if($alunoEmEquipe.count()>0)
        {
            foreach($alunoEmEquipe as $al)
            {
                $equipe = DB::table('aluno as a')->where('a.codigo_turma','=', Session::get('codigo_turma'))->join('turma as t','t.codigo_turma','=','a.codigo_turma')->whereNotIn('a.id_usuario','=',$al->id_usuario)->join('usuario as usu', 'usu.id_usuario', '=', 'a.id_usuario')->pluck('usu.nome')->first();
                if($equipe.length() >0)
                {
                    $alunosSemEquipe[$contador]= $equipe;
                    $contador++;
                }
            
            }
            $contador = 0;
            foreach ($alunosSemEquipe as $e){
                $retorno[$contador]['nome'] = $e->nome;
                $contador++;
            }
        }
        return $retorno;
    }
}
