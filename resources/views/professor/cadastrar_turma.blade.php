<section class="view" id="cadastrarturmaView">
<div class="row underTitle">
    <div class="col-5"></div>
    <div class="col">
        Cadastrar Turma
    </div>
</div>
<div class="cadastrar-turma-form">
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <div class="md-form">
                <i class="fas fa-book prefix"></i>
                <input type="text" class="form-control" id="disciplinaCadastrarTurma">
                <label for="disciplinaCadastrarTurma">Nome Disciplina</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <div class="md-form">
                <i class="fas fa-book-open prefix"></i>
                <input type="text" class="form-control" id="cursoCadastrarTurma">
                <label for="cursoCadastrarTurma">Curso</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <div class="md-form">
                <i class="fas fa-university prefix"></i>
                <input type="text" class="form-control" id="unidadeCadastrarTurma">
                <label for="unidadeCadastrarTurma">Unidade</label>
            </div>
        </div>
    </div>
    <div class="row buttonControl">
        <div class="col-5"></div>
        <div class="col">
            <button type="button" class="btn btn-amber btn-sm" id="btnCadastrarTurma">Cadastrar Turma</button>
            <button type="button" class="btn btn-deep-orange btn-sm" data-toggle="modal"
                    data-target="#ModalInserirAluno">Inserir Alunos
            </button>
        </div>
    </div>
</div>
<script type="text/javascript" src="/js/professor/cadastrar_turma.js"></script>
</section>