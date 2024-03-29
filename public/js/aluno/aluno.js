$(document).ready(function () {
    $("#btnCriarEquipe").on("click", function () {
        $("#ModalVerEquipe").modal("hide");
    });

    $('#btnFixedFatos').on('click', function () {
        $('#modalJFExecucao').modal('show');
    })

    $("#modalBtnVerEquipe").on("click", function () {
        $("#modalJFExecucao").modal("hide");
    });

    $.ajax({
        url: "/turma/jf_exec_turma",
        type: "GET",
        success: function (data) {
            if (data > 0) {
                $('#btnFixedFatos').show('slide');
            }
        }
    });

    $('#ModalInserirAluno').on('shown.bs.modal', function () {

        var opcao = $('#slcJfDisponiveis option:selected').attr("value");
        $('#slcInserirEquipe').empty();
        $('#slcAlunoEquipe').empty();
        $.ajax({
            url: "/equipe/alunos_sem_equipe",
            type: "POST",
            data: {
                codigo_JF: opcao,
            },
            success: function (result) {
                //$('body').html(result);return; 
                $('#slcAlunoEquipe').append('<option value="0" disabled> Alunos Sem Equipe </option>');
                for (var i = 0; i < result['data'].length; i++) {
                    let option = '<option value="' + result['data'][i]['id_usuario'] + '">' + result['data'][i]['nome'] + '</option>';
                    $('#slcAlunoEquipe').append(option);
                }
            }
        });
    });

    $('#ModalVerEquipe').on('shown.bs.modal', function () {
        $.ajax({
            url: "/equipe/alunos_da_equipe",
            type: "POST",
            data: {
                id_jf: $('#slcJfDisponiveis').val(),
            },
            success: function (result) {
                //$('body').html(result);return;
                $('#slcEquipe').empty();

                if (result['data'].length < 1) {
                    $('#btnSairEquipe').hide();
                    $('#btnCriarEquipe').show();
                    return;
                }
                $('#btnSairEquipe').show();
                $('#btnCriarEquipe').hide();

                $('#slcEquipe').append('<option value="0" disabled> Minha Equipe </option>');
                for (var i = 0; i < result['data'].length; i++) {
                    let option = '<option value="">' + result['data'][i]['nome'] + '</option>';
                    $('#slcEquipe').append(option);
                }
            }
        });
    });

    $('#slcAlunoEquipe').on('click', function () {
        var selectedOpts = $('#slcAlunoEquipe option:selected');
        if (selectedOpts.length != 0 && selectedOpts.value != 0)
            $('#slcInserirEquipe').append(selectedOpts);
    });

    $('#slcInserirEquipe').on('click', function () {
        var selectedOpts = $('#slcInserirEquipe option:selected');
        if (selectedOpts.length != 0 && selectedOpts.value != 0)
            $('#slcAlunoEquipe').append(selectedOpts);
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

    $('#btnSairEquipe').on('click', function () {
        $.ajax({
            url: "/equipe/sair_equipe",
            type: "DELETE",
            data: {
                id_jf: $('#slcJfDisponiveis').val(),
            },
            success: function (result) {
                $("#ModalVerEquipe").modal("hide");
            }
        });
    });

    $('#btnSalvarEquipe').on('click', function () {
        let alunos = [];
        $('#slcInserir option').each(function () {
            if ($(this).val() != 0)
                alunos.push($(this).val());
        });
        $.ajax({
            url: "/equipe/criar_equipe",
            type: "POST",
            data: {
                alunos: alunos,
                id_jf: $('#slcJfDisponiveis').val(),
            },
            success: function (result) {
                if (!result['success']) {
                    $('#modalError .modal-body').empty();

                    $('#modalError .modal-body').html(result['data']);
                    $('#modalError .modal-title').html('Erro ao Criar Equipe');
                    $('#modalError').modal('show');
                }
                else {
                    $('#modalSuccess .modal-title').html('Criar Equipe');
                    $('#modalSuccess .modal-body').html('Equipe criada com sucesso');
                    $('#modalSuccess').modal('show');
                    $("#ModalInserirAluno").modal("hide");
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

    $("#nomeInserirAlunoEquipe").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#slcAlunoEquipe option").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});