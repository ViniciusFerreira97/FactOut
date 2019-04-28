<section class="view toHide" id="cadastrarfatoView">
    <div class="row underTitle">
        <div class="col-5"></div>
        <div class="col">
            Cadastrar Fato
        </div>
    </div>
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <div class="md-form">
                <select class="form-control" id="slcJF">
                    <option>Selecione JF</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <div class="md-form">
                <i class="fas fa-list-ol prefix"></i>
                <input type="number" class="form-control" id="ordemCadastrarFato">
                <label for="ordemCadastrarFato">Ordem do fato</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <div class="md-form">
                <i class="far fa-edit prefix"></i>
                <textarea id="form7" class="md-textarea form-control" rows="3"></textarea>
                <label for="form7">Descrição Fato</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4">
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="rbnVerdadeiro" name="inlineDefaultRadiosExample"
                       checked>
                <label class="custom-control-label" for="rbnVerdadeiro">Verdadeiro</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" class="custom-control-input" id="rbnFalso" name="inlineDefaultRadiosExample">
                <label class="custom-control-label" for="rbnFalso">Falso</label>
            </div>
        </div>
    </div>
    <div class="row buttonControl">
        <div class="col-6"></div>
        <div class="col">
            <button type="button" class="btn btn-amber btn-sm" id="btnCadastrarFato">Cadastrar Fato</button>
        </div>
    </div>
    <script type="text/javascript" src="/js/professor/cadastrar_fato.js"></script>
</section>