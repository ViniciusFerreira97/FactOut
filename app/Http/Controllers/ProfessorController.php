<?php

namespace App\Http\Controllers;

use App\Jf as JF;
use App\Fato as Fato;
use BeyondCode\LaravelWebSockets\Apps\App;
use Illuminate\Http\Request;
use App\Turma;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Session;

class ProfessorController extends Controller
{
    public function Cadastrar_turma(Request $request){
        $rules = array(
            'unidade'    => 'required',
            'disciplina' => 'required',
            'curso' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $return['success'] = false;
            $return['data'] = $validator->errors()->all();
            return $return;
        }
        $id_professor = Session::get('id_usuario');

        $verificaLogin = \App\Turma::where('unidade_universidade','=',$request->unidade)->where('disciplina','=',$request->disciplina)->where('curso','=',$request->curso);
        if($verificaLogin->count() > 0){
            $return['success'] = false;
            $return['data'][] = 'Turma já cadastrada.';
            return $return;
        }
        $turma = new Turma;
        $turma->disciplina = $request->disciplina;
        $turma->curso = $request->curso;
        $turma->unidade_universidade = $request->unidade;
        $turma->id_professor = $id_professor;
        $turma->save();
    }


    public function Cadastrar_JF(Request $request){
        $rules = array(
            'codigo_turma' => 'required',
            'tamanho_equipe' => 'required',
            'tempo_fato' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $return['success'] = false;
            $return['data'] = $validator->errors()->all();
            return $return;
        }

        $jf = new jf;
        $jf->codigo_turma = $request->codigo_turma;
        $jf->tamanho_equipe = $request->tamanho_equipe;
        $jf->tempo_fato = $request->tempo_fato*100;
        $jf->status_jf = 'Em criação';
        $jf -> save();

    }


    public function Cadastrar_Fato(Request $request){
        $rules = array(
            'orderm_fato' => 'required',
            'texto_fato' => 'required',
            'resposta_fato' => 'required',
            'id_jf' => 'required',
        );

        $verificaOrdem = \App\Fato::where('orderm_fato','=',$request->orderm_fato)->where('id_jf','=',$request->id_jf);
        if($verificaOrdem->count() > 0){
            $return['success'] = false;
            $return['data'][] = 'Já existe fato cadastrado para essa posição';
            return $return;
        }

        if(strlen($request->texto_fato)>50){
            $return['success'] = false;
            $return['data'][] = 'Descrição de no máximo 50 caracteres';
            return $return;
        }

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $return['success'] = false;
            $return['data'] = $validator->errors()->all();
            return $return;
        }

        $fato = new Fato;
        $fato->orderm_fato = $request->orderm_fato;
        $fato->texto_fato = $request->texto_fato;
        $fato->resposta_fato = $request->resposta_fato;
        $fato->id_jf = $request->id_jf;
        $fato -> save();

        $return['success'] = true;
        $return['data'][] = 'Fato cadastrado com sucesso';
        return $return;


    }


}
