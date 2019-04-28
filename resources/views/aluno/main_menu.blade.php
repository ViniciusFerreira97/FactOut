<div id="main_menu_aluno" class="main">
    <div class="row subTitle">
        <div class="col-4">
            <a href="#">
                Lista de Opções <i class="fas fa-angle-right"></i>
            </a>
            <button class="btn btn-deep-orange btn-sm toHide" id="btnFixedFatos" data-toggle="tooltip" title="Existem Fatos em Execução">
                <i class="far fa-envelope"></i>
            </button>
        </div>
        <div class="col">
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
                            <a href="#" id="listaDeJfs">
                                <div class="view overlay">
                                    <i class="fas fa-tasks fa-2x"></i>
                                </div>
                                <div class="card-body">
                                    Lista de JFs
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-3 left-less">
                        <div class="card">
                            <a href="#">
                                <div class="view overlay">
                                    <i class="far fa-chart-bar fa-2x"></i>
                                </div>
                                <div class="card-body">
                                    Estatística de respostas
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-3 left-less">
                        <div class="card">
                            <a href="#">
                                <div class="view overlay">
                                    <i class="fas fa-clipboard-list fa-2x"></i>
                                </div>
                                <div class="card-body">
                                    Recomendação de tópicos
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
        @include('aluno.visualizar_JF')
    </div>
</div>
