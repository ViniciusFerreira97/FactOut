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

    $('#btnVerEquipe').on('click',function () {
        var opcao = $('#slcJfDisponiveis option:selected');
        $('#nomeJF').html(opcao.html());
    });

    function listajfs()
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
    }

    $('#ModalInserirAluno').on('shown.bs.modal',function(){
        var opcao = $('#slcJfDisponiveis option:selected').attr("value");
        $.ajax({
            url: "/aluno/alunos_da_turma",
            type: "POST",
            data: {
                codigo_JF: opcao,
            },
            success: function (result) {
                $('#slcAluno').empty();
                $('#slcAluno').append('<option value="0" disabled> Alunos Sem Equipe </option>');
                for(var i = 0; i < result.length; i++){
                    let option = '<option value="'+result[i]['nome']+'</option>';
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
            },
            success: function (result) {
                //$('body').html(result);return;   
                $('#slcEquipe').empty();
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

    $('#listaDeJfs').on('click', function () {
        $.ajax({
            url: "/Jf/get_jf_exec_prep",
            type: "GET",
            success: function (data) {
                //$('body').html(data);return;
                $('#slcJfDisponiveis').empty();
                $('#slcJfDisponiveis').append('<option disabled> Selecione o JF </option>');
                for (var i = 0; i < data.length; i++) {
                    let append = '';
                    append += '<option value="' + data[i]['id'] + '">';
                    append += data[i]['turma'] + ' ' + data[i]['nome'];
                    append += ' ('+data[i]['status']+')';
                    append += '</option>';
                    $('#slcJfDisponiveis').append(append);
                }
            }
        });
    });

    $('#listaDeJfs').click();

    function dump(obj) {
        var out = '';
        for (var i in obj) {
            out += i + ": " + obj[i] + "\n";
        }
        document.body.innerHTML = out;
    }

    listajfs();
});