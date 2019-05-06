$(document).ready(function () {

    $('#ordemCadastrarFato').keyup(function(){
        this.value = this.value.replace(/[^0-9\.]/g,'');
    });

    $('#cadastrarFato').on('click', function () {
        $.ajax({
            url: "/professor/getJfsPreparacao",
            type: "POST",
            data: {

            },
            success: function (result) {
                $('#slcJF').empty();
                for (var i = 0; i < result['data'].length; i++) {
                    let option = '<option value="' + result['data'][i]['id_jf'] + '">' + result['data'][i]['id_jf'] + ' - ' + result['data'][i]['nome'] + ' - ' + result['data'][i]['disciplina'] + ' - ' + result['data'][i]['status_jf'] + '</option>';
                    $('#slcJF').append(option);
                }
                $('#slcJF').change();
            }
        });

    });

    $('#btnCadastrarFato').on('click', function () {
        let id_jf = $('#slcJF').val();
        let orderm_fato = $('#ordemCadastrarFato').val();
        let texto_fato = $('#form7').val();
        let resposta_fato;
        if ($('#rbnVerdadeiro').prop('checked')) {
            resposta_fato = 1;
        } else {
            resposta_fato = 0;
        }
        $.ajax({
            url: "/professor/cadastrar_fato",
            type: "POST",
            data: {
                id_jf: id_jf,
                orderm_fato: orderm_fato,
                texto_fato: texto_fato,
                resposta_fato: resposta_fato,
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
                else {
                    $('#modalSuccess .modal-title').html('Cadastro Fato');
                    $('#modalSuccess .modal-body').html('Fato cadastrado com sucesso');
                    $('#modalSuccess').modal('show');
                    $('#cadastrarfatoView textarea').val("");
                    $('#cadastrarfatoView textarea').blur();
                    $('#cadastrarfatoView input').val("");
                    $('#cadastrarfatoView input').blur();
                }

            }
        })
    })

})