$(document).ready(function(){
    $('#cadastrarFato').on('click',function(){
        $.ajax({
            url: "/professor/getJfs",
            type: "POST",
            data:{

            },
            success: function (result) {
                $('#slcJF').empty();
                for(var i = 0; i < result['data'].length; i++){
                    let option = '<option value="'+result['data'][i]['id_jf']+'">'+result['data'][i]['id_jf']+' - '+result['data'][i]['disciplina']+' - '+result['data'][i]['status_jf']+ '</option>';
                    $('#slcJF').append(option);
                }
                $('#slcJF').change();
            }
        });

    });

    $('#btnCadastrarFato').on('click',function(){
        let id_jf = $('#slcJF').val();
        let orderm_fato = $('#ordemCadastrarFato').val();
        let texto_fato = $('#form7').val();
        let resposta_fato;
        if($('#rbnVerdadeiro').checked){
            resposta_fato = 1;
        }else{
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

                //$('.cadastrar-turma-form .form-control').val("");
                //$('.cadastrar-turma-form .form-control').blur();
            }
        })
    })

})