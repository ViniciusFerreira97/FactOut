@include('layouts.header')
@include('user.modais')
<link href="{{asset('css/user/login.css')}}" rel="stylesheet" type="text/css">
<div class="row" id="LoginBody">
    <div class="col-7">
        <img src="/img/logos/Back_login.png" id="imgLoginBody">
    </div>
    <div class="col-5 loginMenu" id="containerLogar">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-7 loginItens">
                {!! Form::open(['route'=> 'user.login', 'method'=> 'post']) !!}
                <div class="md-form">
                    <i class="fa fa-envelope prefix grey-text"></i>
                    {!! Form::text('login',null,['class' => 'form-control','id' => 'login']) !!}
                    <label for="login">Login</label>
                </div>
                <div class="md-form">
                    <i class="fa fa-lock prefix grey-text"></i>
                    {!! Form::password('password',['class' => 'form-control', 'id' => 'password']) !!}
                    <label for='password' >Senha</label>
                </div>
                <div class="form-row">
                    <div class="md-form">
                        {!! Form::button('Logar',['class'=>'btn btn-deep-orange', 'id' => 'btnLogar']) !!}
                    </div>
                    <div class="col-1"></div>
                    <div class="md-form">
                        <button type="button" id="btnInscrever" class="btn btn-outline-deep-orange">Cadastrar
                        </button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <div class="col-5 loginMenu toHide" id="containerCadastro">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-7 loginItens">
                {!! Form::open() !!}
                <div class="form-row">
                    <div class="custom-control custom-radio">
                        {{ Form::radio('checkTipoUsuario', 'professor' , true, ['class' => 'custom-control-input', 'id' => 'checkProfessor']) }}
                        <label class="custom-control-label" for="checkProfessor">Professor</label>
                    </div>
                    <div class="col-1"></div>
                    <div class="custom-control custom-radio">
                        {{ Form::radio('checkTipoUsuario', 'aluno' , false, ['class' => 'custom-control-input', 'id' => 'checkAluno']) }}
                        <label class="custom-control-label" for="checkAluno">Aluno</label>
                    </div>
                </div>
                <div class="md-form">
                    <i class="fa fa-envelope prefix grey-text"></i>
                    {!! Form::text('loginCadastro',null,['class' => 'form-control','id' => 'loginCadastro']) !!}
                    <label for="loginCadastro">Login</label>
                </div>
                <div class="md-form">
                    <i class="fa fa-lock prefix grey-text"></i>
                    {!! Form::password('passwordCadastro',['class' => 'form-control', 'id' => 'passwordCadastro']) !!}
                    <label for="passwordCadastro">Senha</label>
                </div>
                <div class="md-form">
                    <i class="fa fa-lock prefix grey-text"></i>
                    {!! Form::password('passwordRepeat',['class' => 'form-control', 'id' => 'passwordRepeat']) !!}
                    <label for="passwordRepeat">Re-digite a Senha</label>
                </div>
                <div class="md-form">
                    <i class="fas fa-user-alt prefix grey-text"></i>
                    {!! Form::text('nomeCadastro',null,['class' => 'form-control','id' => 'nomeCadastro']) !!}
                    <label for="nomeCadastro">Nome</label>
                </div>
                <div class="md-form">
                    <i class="fas fa-at prefix grey-text"></i>
                    {!! Form::email('emailCadsatro',null,['class' => 'form-control', 'id' => 'emailCadsatro']) !!}
                    <label for="emailCadsatro">Email</label>
                </div>
                <div class="md-form toHide" id="areaAluno">
                    <i class="fab fa-readme prefix grey-text"></i>
                    {!! Form::text('cursoCadastro',null,['class' => 'form-control', 'id' => 'cursoCadastro']) !!}
                    <label for="cursoCadastro">Curso</label>
                </div>
                <div class="form-row">
                    <div class="md-form">
                        {!! Form::submit('Cadastrar',['class'=>'btn btn-sm btn-deep-orange', 'id' => 'btnCadastrar']) !!}
                    </div>
                    <div class="col-1"></div>
                    <div class="md-form">
                        <button type="button" id="btnVoltarLogin" class="btn btn-sm btn-outline-deep-orange">Já
                            sou
                            cadastrado
                        </button>
                    </div>
                </div>
                {!! Form::close() !!}
                <div class="md-form errorData" id="errorCadastrar">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modals -->

<!-- /Modals -->
@include('layouts.footer')
<script type="text/javascript" src="/js/login.js"></script>