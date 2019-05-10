<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jf as JF;
use App\Turma as Turma;
use App\aluno as aluno;
use App\Fato as Fato;
use DB;
use Session;
use App\Events\ExecutarJF as ExecJF;
use App\Events\FinalizarJF as FimJF;
use App\Events\ProximoFato as ProximoFato;

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
    public function getJfPreparacaoAluno(){
        $jfs = DB::table('julgamento_fatos as jf')->join('turma as t','jf.codigo_turma','=','t.codigo_turma')
            ->join('aluno as u','t.codigo_turma','=','u.codigo_turma')->select('jf.id_jf','t.disciplina','jf.status_jf','jf.nome','t.disciplina')
            ->whereIn('jf.status_jf',['Em preparação'])
            ->where('u.id_usuario','=',Session::get('id_usuario'))->get();
        $retorno = [];
        $cont = 0;
        foreach ($jfs as $j){
            $retorno['data'][$cont]['id'] = $j->id_jf;
            $retorno['data'][$cont]['status'] = $j->status_jf;
            $retorno['data'][$cont]['turma'] = $j->disciplina;
            $retorno['data'][$cont]['nome'] = $j->nome;
            $cont++;
        }
        return $retorno;
    }
    public function getJFPreparacaoProfessor(){
        $jfs = DB::table('julgamento_fatos as jf')->join('turma as t','jf.codigo_turma','=','t.codigo_turma')
            ->join('usuario as u','t.id_professor','=','u.id_usuario')->select('jf.id_jf','t.disciplina','jf.status_jf','jf.nome')
            ->whereIn('jf.status_jf',['Em preparação'])
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
        $retorno['success'] = true;
        $status = $this->getStatusJF($request);
        $turma = $this->getTurmaJf($request);
        if($status == 'Em preparação'){
            $qtdFatos = DB::table('julgamento_fatos as jf')->join('fato as f','jf.id_jf','=','f.id_jf')->where('jf.id_jf','=',$request->id_jf)->count();
            if($qtdFatos < 1){
                $retorno['success'] = false;
                $retorno['data'][] = 'Julgamento sem fatos não pode ser iniciado.';
                return $retorno;
            }
            $retorno['success'] = true;
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

    public function getFatoAtual(Request $request){
        $atual = JF::where('id_jf','=',$request->id_jf)->pluck('fato_atual')->first();
        $nome = JF::where('id_jf','=',$request->id_jf)->pluck('nome')->first();
        $data = JF::where('id_jf','=',$request->id_jf)->pluck('updated_at')->first();
        $tempo = JF::where('id_jf','=',$request->id_jf)->pluck('tempo_fato')->first();
        $fato  = Fato::where('id_jf','=',$request->id_jf)->where('ordem_fato','=',$atual)->select('texto_fato','id_fato')->first();
        $retorno['texto'] = $fato->texto_fato;
        $retorno['id'] = $fato->id_fato;
        $retorno['ordem'] = $atual;
        $retorno['nome'] = $nome;
        $retorno['lider'] = false;
        $retorno['inicio'] = date('M j, o G:i:s',strtotime($data));
        $retorno['fim'] = date('M j, o G:i:s', strtotime('+'.$tempo.' minutes', strtotime($data)));
        $lider = DB::table('julgamento_fatos as jf')->join('equipe as e','e.id_jf','=','jf.id_jf')->where('e.lider','=',Session::get('id_usuario'))->count();
        if($lider > 0)
            $retorno['lider'] = true;
        return $retorno;
    }

    public function proximoFato($id_jf,$id_fato = null){
        if($id_fato == null){
            $ordemFatoAtual = JF::where('id_jf','=',$id_jf)->pluck('fato_atual')->first();
            $id_fato = Fato::where('id_jf','=',$id_jf)->where('ordem_fato','=',$ordemFatoAtual)->pluck('id_fato')->first();

        }
        $turma = JF::where('id_jf','=',$id_jf)->pluck('codigo_turma')->first();
        $ordemFatoAtual = Fato::where('id_fato','=',$id_fato)->pluck('ordem_fato')->first();
        $proximaOrdem = Fato::where('ordem_fato','>',$ordemFatoAtual)->where('id_jf','=',$id_jf)->orderBy('ordem_fato', 'asc')->pluck('ordem_fato')->first();
        if(is_null($proximaOrdem) || $proximaOrdem == '') {
            FimJF::broadcast($turma);
            $fato = JF::find($id_jf);
            $fato->status_jf = 'Finalizado';
            $fato->save();
            return;
        }
        $jf = JF::find($id_jf);
        $jf->fato_atual = $proximaOrdem;
        $jf->save();
        ProximoFato::broadcast($turma);
    }

    public function verificaJfs(){
        $jfs = JF::where('status_jf','=','Em execução')->select('*')->get();
        foreach ($jfs as $jf){
            $now = Now();
            $timeExec = $jf->updated_at->diffInSeconds($now);
            $seconds = $timeExec % 60;
            $minutes = round($timeExec/60);
            $timePerJf = $jf->tempo_fato;
            if($minutes >= $timePerJf)
                self::proximoFato($jf->id_jf);
            $array = [$minutes,$timePerJf];
            return $array;
        }
        return 'a';
    }
}
