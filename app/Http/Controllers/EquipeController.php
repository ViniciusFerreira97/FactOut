<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Equipe as Equipe;
use App\Jf as Jf;
use App\Aluno_Equipe as Aluno_Equipe;
use App\Turma;
use App\aluno as aluno;
use Illuminate\Support\Facades\App;
use Session;
use DB;

class EquipeController extends Controller
{
    public function Alunos_Minha_Equipe(Request $request){
        $retorno['success'] = true;
        $retorno['data'] = [];
        $equipesJF = DB::table('julgamento_fatos as jf')->join('equipe as e','e.id_jf','=','jf.id_jf')->where('jf.id_jf','=',$request->id_jf)->pluck('e.id_equipe');
        if(count($equipesJF) < 1)
            return $retorno;
        $NumEquipe = DB::table('aluno_equipe')->where('id_usuario','=',Session::get('id_usuario'))->whereIn('id_equipe',$equipesJF)->pluck('id_equipe')->first();
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

    public function Excluir_Equipe(Request $request){
        $retorno['success'] = true;
        $NumEquipe = DB::table('equipe as e')->join('aluno_equipe as aeq', 'e.id_equipe', '=', 'aeq.id_equipe')->where('aeq.id_usuario','=',Session::get('id_usuario'))->where('e.id_jf', '=', $request->id_jf)->count();
        if($NumEquipe >0)
        {
            $equipe = DB::table('equipe as e')->join('aluno_equipe as aeq', 'e.id_equipe', '=', 'aeq.id_equipe')->where('aeq.id_usuario','=',Session::get('id_usuario'))->where('e.id_jf', '=', $request->id_jf)->pluck('e.id_equipe')->first();
            Equipe::destroy($equipe);
            //DB::table('equipe')->where('id_equipe', '=', $equipe);

        }
        else{
            $equipe = DB::table('equipe as eq')->where('eq.id_jf', '=', $request->id_jf)->join('aluno_equipe as aeq', 'eq.id_equipe', '=', 'aeq.id_equipe')->where('aeq.id_usuario','=',Session::get('id_usuario'))->pluck('aeq.id_aluno_equipe')->first();
            Aluno_Equipe::destroy($equipe);
            //DB::table('aluno_equipe')->where('id_aluno_equipe', '=', $equipe);
        }
        return $retorno;
    }

    public function Get_alunos_sem_equipe(Request $request)
    {
        $retorno = [];
        $retorno['success'] = true;
        $codTurm = Jf::where('id_jf','=', $request->codigo_JF)->pluck('codigo_turma')->first();
        $alunoEmEquipe = DB::table('aluno_equipe as aeq')->join('equipe as eq','eq.id_equipe','=','aeq.id_equipe')->where('eq.codigo_turma','=',$codTurm)->pluck('aeq.id_usuario');
        $semEquipeDaTurma = DB::table('aluno as a')->join('usuario as u','a.id_usuario','=','u.id_usuario')->where('a.codigo_turma','=',$codTurm)->whereNotIn('a.id_usuario',$alunoEmEquipe)->where('a.id_usuario', '!=', Session::get('id_usuario'))->select('u.nome', 'u.id_usuario')->get();
        $cont = 0;
        $retorno['data'] = [];
        foreach ($semEquipeDaTurma as $aluno) {
            $retorno['data'][$cont]['id_usuario'] = $aluno->id_usuario;
            $retorno['data'][$cont]['nome'] = $aluno->nome;
            $cont++;
        }
        return $retorno;
    }

    public function criar_equipe($id_jf)
    {
        $rules = array(
            'id_jf' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $return['success'] = false;
            $return['data'] = $validator->errors()->all();
            return $return;
        }

        $turma = DB::table('julgamento_fatos')->where('id_jf','=', $id_jf)->pluck('codigo_turma')->first();
        $return['success'] = true;
        $equipe = new Equipe;
        $equipe->codigo_turma = $turma;
        $equipe->lider = Session::get('id_usuario');
        $equipe->id_jf = $id_jf;
        $equipe -> save();
        $aluno_equipe = new Aluno_Equipe;
        $id_equipe = DB::table('equipe')->where('lider','=', Session::get('id_usuario'))->pluck('id_equipe')->first();
        $aluno_equipe->id_usuario = Session::get('id_usuario');
        $aluno_equipe->id_equipe = $id_equipe;
        $aluno_equipe -> save();

        return($return);
    }
    public function salvar_alunos(Request $request){
        $retorno = [];
        $tamEquipe = Jf::where('id_jf', '=', $request->id_jf)->pluck('tamanho_equipe')->first();
        if(isset($request->alunos) && count($request->alunos) > $tamEquipe-1)
        {
            $retorno['success'] = false;
            $retorno['data'] = 'O número máximo de alunos por equipe neste JF é '.$tamEquipe;
            return($retorno);
        }
        $aux = $this->criar_equipe($request->id_jf);
        $id_equipe = DB::table('equipe')->where('lider','=', Session::get('id_usuario'))->pluck('id_equipe')->first();
        $retorno['success'] = true;
        if(isset($request->alunos))
        {
            foreach ($request->alunos as $aluno){
                $aluno_equipe = new Aluno_Equipe;
                $aluno_equipe->id_usuario = $aluno;
                $aluno_equipe->id_equipe = $id_equipe;
                $aluno_equipe -> save();
            }
        }
        return $retorno;
    }
}
