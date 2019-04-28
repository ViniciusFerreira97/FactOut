<section class="view toHide" id="alterarjfView">
    <div class="row underTitle">
        <div class="col-5"></div>
        <div class="col">
            Alterar Status JF
        </div>
    </div>
    <div class="row text">
        <div class="col-2"></div>
        <div class="col">
            <span> Julgamentos de Fatos:</span>
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="md-form">
                <select class="form-control" id="slcJFStatus">
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-6">
            <hr>
        </div>
    </div>
    <div class="row text">
        <div class="col-2"></div>
        <div class="col">
            <span> Status disponíveis</span>
        </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-6">
            <div class="md-form">
                <!--<select class="form-control" id="slcStatusDisponiveisAlterar">
                    <option disabled>Selecione Status:</option>
                    <option value="Em preparação">Em preparação</option>
                    <option value="Em execução">Em execução</option>
                    <option value="Finalizado">Finalizado</option>
                </select>-->
                <div class="row text-center statusDiv">
                    <div class="col-2 text-primary">
                        <i class="fas fa-box-open fa-3x"></i>
                        Preparação
                    </div>
                    <div class="col-2">
                        <i class="fas fa-grip-lines fa-2x"></i>
                    </div>
                    <div class="col-2">
                        <i class="fas fa-chalkboard-teacher fa-3x"></i>
                        Execução
                    </div>
                    <div class="col-2">
                        <i class="fas fa-grip-lines fa-2x"></i>
                    </div>
                    <div class="col-2">
                        <i class="fas fa-calendar-check fa-3x"></i>
                        Finalizado
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-8"></div>
        <div class="col">
            <button type="button" class="btn btn-amber btn-sm" id="btnAvançarStatusAlterar">Avançar Status</button>
        </div>
    </div>
</section>
<script type="text/javascript" src="/js/professor/alterar_status.js"></script>