$(document).ready(function (){

    $('#cadastrarJf').on('click',function(){
        $.ajax({
            url: "/turma/turmas_cadastradas",
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
    })

    $('#btnCadastrarJF').on('click',function(){
        let nome_JF = $('#nomeJF').val();
        let codigo_turma = $('#slcTurmaJF').val();
        let tamanho_equipe = $('#equipesCadastrarJF').val();
        let tempo_fato = $('#tempoCadastrarJF').val();

        $.ajax({
            url: "/professor/cadastrar_jf",
            type: "POST",
            data: {
                nome_JF: nome_JF,
                codigo_turma: codigo_turma,
                tamanho_equipe: tamanho_equipe,
                tempo_fato: tempo_fato,
            },
            success: function (result) {
                if (result['success']) {
                    $('#modalError .modal-body').empty();
                    let tohtml = '';

                    for (var i in result['data']) {
                        tohtml += result['data'][i] + '<br>';
                    }

                    $('#modalError .modal-body').html(tohtml);
                    $('#modalError .modal-title').html('Erro ao Cadastrar');
                    $('#modalError').modal('show');
                }
                else{
                    $('#modalSuccess .modal-title').html('Cadastro JF');
                    $('#modalSuccess .modal-body').html('Cadastro realizado com sucesso');
                    $('#modalSuccess').modal('show');
                }
                $('#cadastrarjfView input').val("");
                $('#cadastrarjfView input').blur();
            }
        })
    })

})