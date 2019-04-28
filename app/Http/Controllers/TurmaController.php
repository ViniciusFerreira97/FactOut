<?php

namespace App\Http\Controllers;
use App\Turma;
use Illuminate\Support\Facades\App;
use Session;
use DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\aluno as aluno;
use App\Jf as jf;

class TurmaController extends Controller
{
    //

    public function Turmas_cadastradas(){
        $retorno['success'] = true;
        $turmas = DB::table('turma')->get();
        $contador = 0;
        foreach ($turmas as $t){
            $retorno['data'][$contador]['codigo'] = $t->codigo_turma;
            $retorno['data'][$contador]['disciplina'] = $t->disciplina;
            $retorno['data'][$contador]['curso'] =$t->curso;
            $retorno['data'][$contador]['unidade'] = $t->unidade_universidade;
            $contador++;
        }
        return $retorno;
    }

    public function Alunos_da_Turma(Request $request){
        $retorno['success'] = true;
        $rules = [
            'id_turma' => 'required',
        ];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $return['success'] = false;
            $return['data'] = $validator->errors()->all();
            return $return;
        }

        $id_turma = $request->id_turma;
        $alunos = DB::table('aluno')->where('codigo_turma','=',$id_turma)->get();
        $contador = 0;
        $retorno['data'] = [];
        foreach ($alunos as $a){
            $retorno['data'][$contador]['id_usuario'] = $a->id_usuario;
            $retorno['data'][$contador]['curso'] = $a->curso;
            $usuario = DB::table('usuario')->where('id_usuario','=',$a->id_usuario)->get();
            foreach ($usuario as $u) {
                $retorno['data'][$contador]['login'] = $u->login;
                $retorno['data'][$contador]['nome'] = $u->nome;
            }
        }

        return $retorno;
    }

    public function salvar_alunos(Request $request){
        $retorno['success'] = true;
        \App\aluno::where('codigo_turma',$request->id_turma)->update(['codigo_turma' => null]);
        foreach ($request->alunos as $aluno){
            \App\aluno::where('id_usuario',$aluno)->update(['codigo_turma' => $request->id_turma]);
        }
        return $retorno;
    }

    public function verifica_usuario_em_turma(Request $request){
        $retorno['success'] = true;
        $id_turma = $request->id_turma;
        $cont = \App\aluno::where('id_usuario','=',Session::get('id_usuario'))->where('codigo_turma','=',$id_turma)->count();
        if($cont > 0){
            return $retorno;
        }
        $retorno['success'] = false;
        return $retorno;
    }

    public function get_jf_execucao(){
        $turma = aluno::where('id_usuario','=',Session::get('id_usuario'))->pluck('codigo_turma')->first();
        return jf::where('codigo_turma','=',$turma)->where('status_jf','=','Em execução')->count();
    }
}
