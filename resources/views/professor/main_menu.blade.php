<div id="main_menu_aluno" class="main">
    <div class="row subTitle">
        <div class="col-4">
            <a href="#">
                Lista de Opções <i class="fas fa-angle-down"></i>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <hr>
        </div>
    </div>
    <div class="menuOptions">
        <div class="row">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="card-deck">
                    <div class="col-3">
                        <div class="card">
                            <a href="#" id="cadastrarTurma" class="active changeView">
                                <div class="view overlay">
                                    <i class="fas fa-users fa-2x"></i>
                                </div>
                                <div class="card-body">
                                    Cadastrar Turma
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-3 left-less">
                        <div class="card">
                            <a href="#" id="cadastrarJf" class="changeView">
                                <div class="view overlay">
                                    <i class="fas fa-clipboard-list fa-2x"></i>
                                </div>
                                <div class="card-body">
                                    Cadastrar JF
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-3 left-less">
                        <div class="card">
                            <a href="#" id="cadastrarFato" class="changeView">
                                <div class="view overlay">
                                    <i class="fas fa-edit fa-2x"></i>
                                </div>
                                <div class="card-body">
                                    Cadastrar Fato
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-3 left-less">
                        <div class="card">
                            <a href="#" id="alterarJf" class="changeView">
                                <div class="view overlay">
                                    <i class="fas fa-sliders-h fa-2x"></i>
                                </div>
                                <div class="card-body">
                                    Alterar Status JF
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
    <div class="main_conteudo">
        @include('professor.cadastrar_fato')
        @include('professor.cadastrar_JF')
        @include('professor.mudar_statusJF')
        @include('professor.cadastrar_turma')
    </div>
</div>