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

    <section id="estatisticasPosSelecao">
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
    <div class="row">
        <div class="col-2"></div>
        <div class="col-4 text-center">
            <span class="underTitle">Acertos/Erros</span>
            <canvas id="acertos_erros"></canvas>
        </div>
        <div class="col-4">
            <span class="underTitle">Acertos Totais:</span>
            <span class="text-success" id="acertosTotais"></span>
            <br> <hr> 
            <span class="underTitle">Erros Totais:</span>
            <span class="text-danger" id="errosTotais"></span>
            <br> <hr>
            <span class="underTitle">Taxa Acerto Nominal:</span>
            <span class="text-default" id="acertosNominal"></span>
            <br> <hr> 
            <span class="underTitle">Taxa Acerto Real:</span>
            <span class="text-primary" id="acertosReal"></span>
        </div>
    </div>
    </section>
</section>

<script type="text/javascript" src="/js/aluno/estatisticas.js"></script>