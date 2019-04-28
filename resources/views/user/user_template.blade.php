@include('layouts.header')
<link href="{{asset('css/user/user_template.css')}}" rel="stylesheet" type="text/css">
<nav class="navbar navbar-expand-lg navbar-light white double-nav scrolling-navbar">
    <a class="navbar-brand" href="#">
        <img src="/img/logos/fact_out_logo_preto.png" height="30" alt="FactOut Logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navContentUser"
            aria-controls="navContentUser" aria-expanded="false" aria-label="Toggle navbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navContentUser">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-4" data-toggle="dropdown"
                   aria-haspopup="true"
                   aria-expanded="false">
                    <i class="fas fa-user"></i> <span id="username"> Perfil </span> </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-amber"
                     aria-labelledby="navbarDropdownMenuLink-4">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#ModalAlterarDados">Alterar
                        perfil</a>
                    <a class="dropdown-item" href="#" id="btnSair">Sair</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<div class="row">
    <div class="col-1"></div>
    <div class="col-10" id="pageBody">
        @include(Session::get('tipo_usuario').'.main_menu')
    </div>
</div>
@include(Session::get('tipo_usuario').'.modais')
<!-- Modals -->
<!-- Modal Alterar Dados -->
<div class="modal fade mAmber" id="ModalAlterarDados" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">

    <!-- Change class .modal-sm to change the size of the modal -->
    <div class="modal-dialog modal-lg" role="document">


        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100"><i class="fas fa-user-cog"></i>Alterar Dados</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <div class="md-form">
                            <i class="fa fa-envelope prefix grey-text"></i>
                            <input type="text" class="form-control" id="loginAlterarDados" readonly>
                            <label for="loginAlterarDados">Login</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <div class="md-form">
                            <i class="fa fa-lock prefix grey-text"></i>
                            <input type="password" class="form-control" id="passwordAlterarDados">
                            <label for="passwordAlterarDados">Senha</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <div class="md-form">
                            <i class="fa fa-lock prefix grey-text"></i>
                            <input type="password" class="form-control" id="passwordRepeatAlterarDados">
                            <label for="passwordRepeatAlterarDados">Re-digite a Senha</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <div class="md-form">
                            <i class="fas fa-user-alt prefix grey-text"></i>
                            <input type="text" class="form-control" id="nomeAlterarDados">
                            <label for="nomeAlterarDados">Nome</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <div class="md-form">
                            <i class="fas fa-at prefix grey-text"></i>
                            <input type="text" class="form-control" id="emailAlterarDados">
                            <label for="emailAlterarDados">Email</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <div class="md-form toHide" id="areaAluno">
                            <i class="fab fa-readme prefix grey-text"></i>
                            <input type="text" class="form-control" id="cursoAlterarDados">
                            <label for="cursoAlterarDados">Curso</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-amber btn-sm" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-amber btn-sm">Salvar alterações</button>
            </div>
        </div>
    </div>
</div>
<!-- /Modal Alterar Dados -->
<!-- /Modals -->

@include('layouts.footer')
<script type="text/javascript" src="/js/user_template.js"></script>