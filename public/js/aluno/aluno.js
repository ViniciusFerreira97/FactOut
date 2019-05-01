$(document).ready(function () {
    $("#btnCriarEquipe").on("click", function () {
        $("#ModalVerEquipe").modal("hide");
    });

    $('#btnFixedFatos').on('click', function () {
        $('#modalJFExecucao').modal('show');
    })

    $.ajax({
        url: "/turma/jf_exec_turma",
        type: "GET",
        success: function (data) {
            if (data > 0) {
                $('#btnFixedFatos').show('slide');
            }
        }
    });

    /*function listajfs()
    {
        $.ajax({
            url: "/JF/get_jf_Aluno",
            type: "POST",
            data: {
            },
            success: function (result) {
                $('#slcJfDisponiveis').empty();
               for(var i = 0; i < result['data'].length; i++){
                   let option = '<option value="'+result['data'][i]['codigo']+'">'+result['data'][i]['nome']+' - '+result['data'][i]['disciplina']+' - ' + result['data'][i]['status_jf']+'</option>';
                   $('#slcJfDisponiveis').append(option);
               }
                $('#slcJfDisponiveis').change();
            }
        });
    }*/

    $('#ModalInserirAluno').on('shown.bs.modal',function(){
        var opcao = $('#slcJfDisponiveis option:selected').attr("value");
        $.ajax({
            url: "/equipe/alunos_sem_equipe",
            type: "POST",
            data: {
                codigo_JF: opcao,
            },
            success: function (result) {
                //$('body').html(result);return;
                $('#slcAluno').empty();
                $('#slcAluno').append('<option value="0" disabled> Alunos Sem Equipe </option>');
                for(var i = 0; i < result['data'].length; i++){
                    let option = '<option value="'+result['data'][i]['nome']+'">'+result['data'][i]['nome']+'</option>';
                    $('#slcAluno').append(option);
                }
            }
        });
    });

    $('#ModalVerEquipe').on('shown.bs.modal',function(){
        $.ajax({
            url: "/equipe/alunos_da_equipe",
            type: "POST",
            data: {
                id_jf: $('#slcJfDisponiveis').val(),
            },
            success: function (result) {
                //$('body').html(result);return;
                $('#slcEquipe').empty();

                if(result['data'].length < 1){
                    $('#btnSairEquipe').hide();
                    $('#btnCriarEquipe').show();
                    return;
                }
                $('#btnSairEquipe').show();
                $('#btnCriarEquipe').hide();

                $('#slcEquipe').append('<option value="0" disabled> Minha Equipe </option>');
                for(var i = 0; i < result['data'].length; i++){
                    let option = '<option value="">'+result['data'][i]['nome']+'</option>';
                    $('#slcEquipe').append(option);
                }
            }
        });
    });

    $('#btnFixedFatos').on('click', function () {
        $.ajax({
            url: "/Jf/get_jf_exec_aluno",
            type: "GET",
            success: function (data) {
                $('#slcVisualizarFatoModalJFExec').empty();
                if (data['success']) {
                    for (var i = 0; i < data['data'].length; i++) {
                        let append = '';
                        append += '<option value="' + data['data'][i]['id'] + '">';
                        append += data['data'][i]['turma'] + ' ' + data['data'][i]['nome'];
                        append += '</option>';
                        $('#slcVisualizarFatoModalJFExec').append(append);
                    }
                }
            }
        });
    });

    function dump(obj) {
        var out = '';
        for (var i in obj) {
            out += i + ": " + obj[i] + "\n";
        }
        document.body.innerHTML = out;
    }

    //listajfs();
});