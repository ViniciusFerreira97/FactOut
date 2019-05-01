<!-- Modal Responder fato -->
<div class="modal fade mAmber" id="ModalResponderFato" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100">Responder Fato</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <span class="numFato">Numero/Titulo: </span>
                    </div>
                    <div class="col-2"></div>
                    <div class="col">
                        <span class="tempoFato">Tempo: </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <span class="nomeFato">Fato: </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-1">
                        <button type="button" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="bottom" title="Verdadeiro"> <i class="fas fa-check"></i> </button>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-1">
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="bottom" title="Falso"><i class="fas fa-times"></i></button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-amber btn-sm fechar" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!-- /Modal Responder fato -->

<!-- Modal Ver Equipe -->
<div class="modal fade mAmber" id="ModalVerEquipe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100">Minha Equipe</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-5">
                        <div class="md-form">
                            <span>Julgamento de Fatos: </span>
                            <br>
                            <span id="nomeJF"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <select id="slcEquipe" class="custom-select" multiple>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-5">
                        <button type="button" class="btn btn-amber btn-sm">Sair da Equipe</button>
                    </div>
                    <div class="col">
                        <button id="btnCriarEquipe" type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ModalInserirAluno">Criar Equipe</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-amber btn-sm fechar" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!-- /Modal Ver Equipe -->


<!-- Modal Inserir Aluno -->
<div class="modal fade mAmber" id="ModalInserirAluno" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100">Inserir Alunos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <div class="md-form">
                            <i class="fas fa-user-alt prefix"></i>
                            <input type="text" id="nomeInserirAluno" class="form-control">
                            <label for="nomeInserirAluno">Nome</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <select id="slcAluno" class="custom-select" multiple>
                            <option disabled>Alunos Sem Equipe</option>
                        </select>
                    </div>
                </div>
                <div class="row top-more-4">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <select id="slcInserir" class="custom-select" multiple>
                            <option disabled>Alunos Na Equipe</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-5">
                        <button type="button" class="btn btn-amber btn-sm" id="btnSalvarTurma">Salvar Alterações</button>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-danger btn-sm" id="btnRemoverTodosTurma">Remover Todos</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-amber btn-sm fechar" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!-- /Modal Inserir Aluno -->

<!-- Modal JF em Execuçao -->
<div class="modal fade mAmber" id="modalJFExecucao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100">Julgamentos de Fato em Execução</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <div class="md-form">
                            <select class="form-control" id="slcVisualizarFatoModalJFExec">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2"></div>
                    <div class="col-5">
                        <button type="button" class="btn btn-amber btn-sm">Visualizar Fato</button>
                        <button type="button" class="btn btn-deep-orange btn-sm" data-toggle="modal" data-target="#ModalVerEquipe">Ver Equipe</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-amber btn-sm fechar" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<!-- /Modal JF em Execuçao -->