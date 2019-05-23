<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\aluno;
use DB;
use App\Jf as Jf;
use App\Fato as Fato;
use App\Resposta as Resposta;
use App\Aluno_Equipe as Aluno_Equipe;
use Session;
use App\Equipe as Equipe;
use App\Events\ProximoFato as ProximoFato;
use App\Events\FinalizarJF as FimJF;
use App\Http\Controllers\JFController as JFC;

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

    public function responder_fato(Request $request){
        $retorno['success'] = true;
        $qtdResposta = Resposta::where('id_fato','=',$request->id_fato)->where('id_lider','=',Session::get('id_usuario'))->count();
        if($qtdResposta == 0){
            $resposta = new Resposta();
            $resposta->id_lider = Session::get('id_usuario');
            $resposta->id_fato = $request->id_fato;
            $resposta->resposta = $request->resposta;
            $resposta->save();
            $this->ApurarRespostas($request->id_fato);
            return $retorno;
        }
        $id = Resposta::where('id_fato','=',$request->id_fato)->where('id_lider','=',Session::get('id_usuario'))->pluck('id_resposta')->first();
        $resposta = Resposta::find($id);
        $resposta->resposta = $request->resposta;
        $resposta->save();
        $this->ApurarRespostas($request->id_fato);
        return $retorno;
    }

    protected function ApurarRespostas($id_fato){
        $qtd_respostas = Resposta::where('id_fato','=',$id_fato)->count();
        $id_jf = Fato::where('id_fato','=',$id_fato)->pluck('id_jf')->first();
        $qtd_equipe = Equipe::where('id_jf','=',$id_jf)->count();
        $response = [];
        $response[] = $qtd_respostas;
        $response[] = $qtd_equipe;
        if($qtd_respostas == $qtd_equipe){
            $jf = new JFC();
            $jf->proximoFato($id_jf,$id_fato);
        }
    }

    public function Get_Jfs_Finalizados()
    {
        $retorno = [];
        $finalizados = Jf::where('status_jf', '=', 'Finalizado')->get();
        $contador = 0;
        foreach ($finalizados as $f){
            $retorno[$contador]['id_jf'] = $f->id_jf;
            $retorno[$contador]['nome'] = $f->nome;
            $retorno[$contador]['status_jf'] = $f->status_jf;
            $contador++;
        }
        return $retorno;
    }

    public function VerificaRespostas(Request $request){
        $retorno = [];
        $lider = DB::table('aluno_equipe as ae')->join('equipe as e','e.id_equipe','=','ae.id_equipe')
            ->where('e.id_jf','=',$request->id_jf)->where('ae.id_usuario','=',Session::get('id_usuario'))
            ->pluck('e.lider')->first();
        $fatos = Fato::where('id_jf','=',$request->id_jf)->get();
        $array = [];
        foreach ($fatos as $eq){
            $array_fatos[] = $eq->id_fato;
        }
        $respostasEquipe = Resposta::where('id_lider', '=', $lider)->whereIn('id_fato',$array_fatos)->orderBy('id_fato')->get();
        $respostasCorretas = Fato::where('id_jf', '=', $request->id_jf)->whereIn('id_fato',$array_fatos)->orderBy('id_fato')->get();
        $contadorCertos = 0;
        $contadorErrados = 0;
        $retorno['certos'] = [];
        $retorno['errados'] = [];
        for($i = 0; $i < count($respostasCorretas); $i++) {
            if (isset($respostasEquipe[$i])) {

                if ($respostasEquipe[$i]->id_fato == $respostasCorretas[$i]->id_fato && $respostasEquipe[$i]->resposta == $respostasCorretas[$i]->resposta_fato) {
                    $retorno['certos'][$contadorCertos]['id'] = $respostasEquipe[$i]->id_fato;
                    $retorno['certos'][$contadorCertos]['pergunta'] = $respostasCorretas[$i]->texto_fato;
                    $contadorCertos++;
                } else {
                    $retorno['errados'][$contadorErrados]['id'] = $respostasEquipe[$i]->id_fato;
                    $retorno['errados'][$contadorErrados]['pergunta'] = $respostasCorretas[$i]->texto_fato;
                    $contadorErrados++;
                }
            } else {
                $retorno['errados'][$contadorErrados] = $respostasCorretas[$i]->id_fato;
                $retorno['errados'][$contadorErrados]['pergunta'] = $respostasCorretas[$i]->texto_fato;
                $contadorErrados++;
            }
        }
        return $retorno;
    }

    public function ModalRespondidas(Request $request){
        $retorno = [];
        $fato = Fato::find($request->id_fato);
        $contador = 0;
        $retorno['id'] = $fato->id_fato;
        $retorno['ordem'] = $fato->ordem_fato;
        $retorno['texto'] = $fato->texto_fato;
        $retorno['resposta'] = $fato->resposta_fato;
        return $retorno;
    }

}
