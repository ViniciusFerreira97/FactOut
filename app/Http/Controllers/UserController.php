<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public  function getHome(){
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        return view('user.user_template',[
            'title' => 'Home - FactOut',
        ]);
    }

    public  function getLogin(){
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        return view('user.login',[
            'title' => 'Login - FactOut'
        ]);
    }

    public function logarUsuario(Request $request)
    {
        $verificaLogin = \App\usuario::where('login','=',$request->login)->where('senha','=',$request->senha);
        $return = array();

        if($verificaLogin->count() > 0)
        {
            $return['success'] = true;
            $return['data'][] = 'Login Efetuado';

            $tipo_usuario = DB::table('usuario')->where('login',$request->login )->pluck('tipo_usuario')->first();
            Session::put('tipo_usuario',$tipo_usuario);
            $id_usuario = DB::table('usuario')->where('login',$request->login )->pluck('id_usuario')->first();
            Session::put('id_usuario',$id_usuario);

            return $return;
        }
        else{
            $return['success'] = false;
            $return['data'][] = 'Usuário ou senha incorretos';
            return $return;
        }
    }

    public function registrarUsuario(Request $request){
        $user_type = $request->tipo_usuario;

        $return = array();

        $rules = array(
            'login'    => 'required|min:5|max:10',
            'senha' => 'required|alphaNum|min:6',
            'nome' => 'required',
            'email' => 'required|email',
            'tipo_usuario' => 'required'
        );

        if($user_type == 'aluno')
            $rules['curso'] = 'required';

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $return['success'] = false;
            $return['data'] = $validator->errors()->all();
            return $return;
        }


        $login = $request->login;
        $existenciaLogin = \App\usuario::where('login','=',$request->login)->get();
        $existenciaEmail = \App\usuario::where('email','=',$request->email)->get();

        if($existenciaEmail->count() < 1 && $existenciaLogin->count() < 1){
            $usuario = new usuario;
            $usuario->nome = $request->nome;
            $usuario->login = $request->login;
            $usuario->email = $request->email;
            $usuario->senha = $request->senha;
            $usuario->tipo_usuario = $request->tipo_usuario;
            $usuario->save();

            if($user_type == 'aluno'){
                $aluno = new AlunoController();
                $id = DB::table('usuario')->where('login',$request->login )->pluck('id_usuario')->first();
                $aluno->registrarAluno($id,$request->curso);
            }

            $tipo_usuario = DB::table('usuario')->where('login',$request->login )->pluck('tipo_usuario')->first();
            Session::put('tipo_usuario',$tipo_usuario);

            $return['success'] = true;
            $return['data'] = $user_type;
            return $return;
        }else{
            $return['success'] = false;
            if($existenciaLogin->count() > 0)
                $return['data'][] = 'Login já em uso.';
            if($existenciaEmail->count() > 0)
                $return['data'][] = 'Email já em uso.';

            return $return;
        }
    }

    public function getName(){
        return \App\usuario::where('id_usuario','=',\Illuminate\Support\Facades\Session::get('id_usuario'))->pluck('login')->first();
    }
}
