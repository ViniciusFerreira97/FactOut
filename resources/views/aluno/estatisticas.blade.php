<section class="view toHide" id="estatisticasView">
    <div class="row underTitle">
        <div class="col-4"></div>
        <div class="col">
            Estatísticas de Respostas<br/>
            <br/>
        </div>
    </div>
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="md-form">
                <select class="form-control" id="estatisticaSlcJF">
                    <option>Selecione JF</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8"><hr></div>
    </div>
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="md-form">
                <select class="form-control" id="fatosCorretosJF">
                    <option>Fatos Corretos</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6"><hr></div>
    </div>
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            <div class="md-form">
                <select class="form-control" id="fatosErradosJF">
                    <option>Fatos Errados</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12"><hr></div>
    </div>
    <div class="row underTitle">
        <div class="col-1"></div>
        <div class="col-2">Acertos/Erros</div>
        <div class="col-2"></div>
        <div class="col-2">Acertos Nominal</div>
        <div class="col-2"></div>
        <div class="col-2">Acertos Real</div>
    </div>
    <div class="row">
        <div class="col-4">
            <canvas id="acertos_erros"></canvas>
        </div>
        <div class="col-4">
            <canvas id="taxaReal"></canvas>
        </div>
        <div class="col-4">
            <canvas id="taxaNominal"></canvas>
        </div>
    </div>
</section>

<script type="text/javascript" src="/js/aluno/estatisticas.js"></script>