<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jf as JF;
use App\Turma as Turma;
use App\aluno as aluno;
use DB;
use Session;
use App\Events\ExecutarJF as ExecJF;
use App\Events\FinalizarJF as FimJF;

class JFController extends Controller
{
    public function getJFProfessor(){
        $jfs = DB::table('julgamento_fatos as jf')->join('turma as t','jf.codigo_turma','=','t.codigo_turma')
            ->join('usuario as u','t.id_professor','=','u.id_usuario')->select('jf.id_jf','t.disciplina','jf.status_jf','jf.nome')
                ->whereIn('jf.status_jf',['Em preparação','Em execução'])
                    ->where('u.id_usuario','=',Session::get('id_usuario'))->get();
        $retorno = [];
        $cont = 0;
        foreach ($jfs as $j){
            $retorno['data'][$cont]['id_jf'] = $j->id_jf;
            $retorno['data'][$cont]['status_jf'] = $j->status_jf;
            $retorno['data'][$cont]['disciplina'] = $j->disciplina;
            $retorno['data'][$cont]['nome'] = $j->nome;
            $cont++;
        }
        return $retorno;
    }
    public function getJFAluno(){
        $jfs = DB::table('aluno as a')->where('a.id_usuario', '=', Session::get('id_usuario'))->join('turma as t','a.codigo_turma','=','t.codigo_turma')
            ->join('julgamento_fatos as jf','t.codigo_turma','=','jf.codigo_turma')->select('jf.id_jf','t.disciplina','jf.status_jf','jf.nome')
                ->whereIn('jf.status_jf',['Em preparação','Em execução', 'Finalizado'])->get();
        $retorno = [];
        $cont = 0;
        foreach ($jfs as $j){
            $retorno['data'][$cont]['codigo'] = $j->id_jf;
            $retorno['data'][$cont]['status_jf'] = $j->status_jf;
            $retorno['data'][$cont]['disciplina'] = $j->disciplina;
            $retorno['data'][$cont]['nome'] = $j->nome;
            $cont++;
        }
        return $retorno;
    }

    public function getTurmaJf(Request $request){
        $id_jf = $request->id_jf;
        $query = JF::where('id_jf','=',$id_jf)->pluck('codigo_turma')->first();
        return $query;
    }

    public function getStatusJF(Request $request){
        $id_jf = $request->id_jf;
        $query = JF::where('id_jf','=',$id_jf)->pluck('status_jf')->first();
        return $query;
    }

    public function setStatus(Request $request){
        $retorno['sucess'] = true;
        $status = $this->getStatusJF($request);
        $turma = $this->getTurmaJf($request);
        if($status == 'Em preparação'){
            $jf = JF::find($request->id_jf);
            $jf->status_jf = 'Em execução';
            $jf->save();
            ExecJF::broadcast($turma);
            $retorno['data'][] = 'JF iniciado com sucesso !';
        }else{
            $jf = JF::find($request->id_jf);
            $jf->status_jf = 'Finalizado';
            $jf->save();
            FimJF::broadcast($turma);
            $retorno['data'][] = 'JF finalizado com sucesso !';
        }
        return $retorno; 
    }

    public function getJfExecucaoAluno(){
        $retorno['success'] = true;
        $turma = aluno::where('id_usuario','=',Session::get('id_usuario'))->pluck('codigo_turma')->first();
        $jfs = JF::where('codigo_turma','=',$turma)->where('status_jf','=','Em execução')->get();
        $cont = 0;
        foreach ($jfs as $j){
            $retorno['data'][$cont]['turma'] = Turma::where('codigo_turma','=',$j->codigo_turma)->pluck('disciplina')->first();
            $retorno['data'][$cont]['nome'] = $j->nome;
            $retorno['data'][$cont]['id'] = $j->id_jf;
            $cont++;
        }
        return $retorno;
    }

    public function getJfPrepExec(){
        $turma = aluno::where('id_usuario','=',Session::get('id_usuario'))->pluck('codigo_turma')->first();
        $jfs = JF::whereIn('status_jf',['Em execução','Em preparação'])->where('codigo_turma','=',$turma)->get();
        $cont = 0;
        $retorno=[];
        foreach ($jfs as $j){
            $retorno[$cont]['turma'] = Turma::where('codigo_turma','=',$j->codigo_turma)->pluck('disciplina')->first();
            $retorno[$cont]['nome'] = $j->nome;
            $retorno[$cont]['status'] = $j->status_jf;
            $retorno[$cont]['id'] = $j->id_jf;
            $cont++;
        }
        return $retorno;
    }
}
