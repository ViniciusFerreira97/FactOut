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
                            <span class="grey-text">
                                Selecione a Turma
                            </span>
                            <select class="form-control" id="slcTurma">
                                <option disabled> Selecione a Turma</option>
                            </select>
                        </div>
                    </div>
                </div>
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
                            <option disabled>Alunos Sem Turma</option>
                        </select>
                    </div>
                </div>
                <div class="row top-more-4">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <select id="slcInserir" class="custom-select" multiple>
                            <option disabled>Alunos da turma</option>
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