<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',function(){
    if(\Illuminate\Support\Facades\Session::has('tipo_usuario')){
        return redirect('/home');
    }
    $usuario = new \App\Http\Controllers\UserController();
    return $usuario->getLogin();
});
Route::get('/home',function(){
    if(!Session::has('tipo_usuario')){
        return redirect('/');
    }
    $usuario = new \App\Http\Controllers\UserController();
    return $usuario->getHome();
});


Route::post('/login', ['as'=> 'user.login', 'uses' => 'Controller@fazerLogin']);


Route::post('/usuario/cadastrar','UserController@registrarUsuario');
Route::post('/usuario/login','UserController@logarUsuario');
Route::get('/usuario/sair',function(){
    \Illuminate\Support\Facades\Session::flush();
});
Route::get('/usuario/getName','UserController@getName');


Route::post('/professor/cadastrar_turma','ProfessorController@Cadastrar_turma');
Route::get('/professor/getJfs','JFController@getJFProfessor');
Route::post('/professor/setStatusJF','JFController@setStatus');

Route::post('/professor/getJfs','JFController@getJFProfessor');
Route::post('/professor/cadastrar_fato','ProfessorController@Cadastrar_Fato');
Route::post('/professor/cadastrar_jf','ProfessorController@Cadastrar_JF');

Route::post("/aluno/alunos_sem_turma",'AlunoController@Get_Alunos_Sem_Turma');

Route::post("/turma/alunos_da_turma",'TurmaController@Alunos_da_Turma');
Route::post("/turma/salvar_alunos",'TurmaController@salvar_alunos');
Route::post("/turma/usuario_em_turma",'TurmaController@verifica_usuario_em_turma');
Route::get("/turma/jf_exec_turma",'TurmaController@get_jf_execucao');
Route::post('/turma/turmas_cadastradas','TurmaController@Turmas_cadastradas');


Route::get("/Jf/get_jf_exec_aluno",'JFController@getJfExecucaoAluno');
Route::get("/Jf/get_jf_exec_prep",'JFController@getJfPrepExec');
Route::post('/JF/get_jf_Aluno','JFController@getJFAluno');

Route::post("/equipe/alunos_da_equipe",'EquipeController@Alunos_Minha_Equipe');
Route::post("/equipe/alunos_da_turma",'EquipeController@Get_Alunos_Da_Turma');