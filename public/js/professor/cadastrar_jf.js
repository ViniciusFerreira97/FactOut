$(document).ready(function (){

    $('#cadastrarJf').on('click',function(){
        $.ajax({
            url: "/professor/turmas_cadastradas",
            type: "POST",
            data: {

            },
            success: function (result) {
                $('#slcTurmaJF').empty();
                for(var i = 0; i < result['data'].length; i++){
                    let option = '<option value="'+result['data'][i]['codigo']+'">'+result['data'][i]['codigo']+' - '+result['data'][i]['disciplina']+' - ' + result['data'][i]['curso']+' - '+result['data'][i]['unidade']+ '</option>';
                    $('#slcTurmaJF').append(option);
                }
                $('#slcTurmaJF').change();
            }
        });

    });

    $('#btnCadastrarJF').on('click',function(){
        let codigo_turma = $('#slcTurmaJF').val();
        let tamanho_equipe = $('#equipesCadastrarJF').val();
        let tempo_fato = $('#tempoCadastrarJF').val();

        $.ajax({
            url: "/professor/cadastrar_jf",
            type: "POST",
            data: {
                codigo_turma: codigo_turma,
                tamanho_equipe: tamanho_equipe,
                tempo_fato: tempo_fato,
            },
            success: function (result) {
                if (!result['success']) {
                    $('#modalError .modal-body').empty();
                    let tohtml = '';

                    for (var i in result['data']) {
                        tohtml += result['data'][i] + '<br>';
                    }

                    $('#modalError .modal-body').html(tohtml);
                    $('#modalError .modal-title').html('Erro ao Cadastrar');
                    $('#modalError').modal('show');
                }

                //$('.cadastrar-turma-form .form-control').val("");
                //$('.cadastrar-turma-form .form-control').blur();
            }
        })
    })

})