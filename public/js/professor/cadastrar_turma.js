$(document).ready(function () {

    function dump(obj) {
        document.body.innerHTML = '';
        var out = '';
        for (var i in obj) {
            out += i + ": " + obj[i] + "\n";
        }

        alert(out);

        // or, if you wanted to avoid alerts...

        var pre = document.createElement('pre');
        pre.innerHTML = out;
        document.body.appendChild(pre)
    }

    $('#btnCadastrarTurma').on('click',function(){
        let disciplina = $('#disciplinaCadastrarTurma').val();
        let curso = $('#cursoCadastrarTurma').val();
        let unidade = $('#unidadeCadastrarTurma').val();

        $.ajax({
            url: "/professor/cadastrar_turma",
            type: "POST",
            data: {
                disciplina: disciplina,
                curso: curso,
                unidade: unidade,
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
                else{
                    $('#modalSuccess .modal-title').html('Cadastro Turma');
                    $('#modalSuccess .modal-body').html('Turma cadastrada com sucesso');
                    $('#modalSuccess').modal('show');
                    $('.cadastrar-turma-form .form-control').val("");
                    $('.cadastrar-turma-form .form-control').blur();
                }
            }
        });
    })

    $('#ModalInserirAluno').on('shown.bs.modal',function(){
        $.ajax({
            url: "/turma/turmas_cadastradas",
            type: "POST",
            data: {

            },
            success: function (result) {
                $('#slcTurma').empty();
               for(var i = 0; i < result['data'].length; i++){
                   let option = '<option value="'+result['data'][i]['codigo']+'">'+result['data'][i]['codigo']+' - '+result['data'][i]['disciplina']+' - ' + result['data'][i]['curso']+' - '+result['data'][i]['unidade']+ '</option>';
                   $('#slcTurma').append(option);
               }
                $('#slcTurma').change();
            }
        });
        $.ajax({
            url: "/aluno/alunos_sem_turma",
            type: "POST",
            data: {

            },
            success: function (result) {
                $('#slcAluno').empty();
                $('#slcAluno').append('<option value="0" disabled> Alunos Sem Turma </option>');
                for(var i = 0; i < result.length; i++){
                    let option = '<option value="'+result[i]['id_usuario']+'">'+result[i]['login']+" - "+result[i]['nome']+' - '+result[i]['curso']+'</option>';
                    $('#slcAluno').append(option);
                }
            }
        });
    });

    $('#slcAluno').on('click',function () {
        var selectedOpts = $('#slcAluno option:selected');
        if(selectedOpts.length != 0 && selectedOpts.value != 0)
        $('#slcInserir').append(selectedOpts);
    });

    $('#slcInserir').on('click',function () {
        var selectedOpts = $('#slcInserir option:selected');
        if(selectedOpts.length != 0 && selectedOpts.value != 0)
            $('#slcAluno').append(selectedOpts);
    });

    $('#slcTurma').on('change',function(){
        let turma = $('#slcTurma').val();
        $.ajax({
            url: "/turma/alunos_da_turma",
            type: "POST",
            data: {
                id_turma: turma,
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
                $('#slcInserir').empty();
                $('#slcInserir').append('<option value="0" disabled> Alunos da Turma </option>');
                for(var i = 0; i < result['data'].length; i++){
                    let option = '<option value="'+result['data'][i]['id_usuario']+'">'+result['data'][i]['login']+' - '+result['data'][i]['nome']+' - ' + result['data'][i]['curso']+'</option>';
                    $('#slcInserir').append(option);
                }
            }
        });
    });

    $('#btnRemoverTodosTurma').on('click',function(){
        $('#slcInserir option').each(function(){
            if($(this).val() != 0)
            $('#slcAluno').append($(this));
        });
    });

    $('#btnSalvarTurma').on('click',function(){
       let alunos = [];
       $('#slcInserir option').each(function(){
           alunos.push($(this).val());
       });
       let turma = $('#slcTurma').val();
        $.ajax({
            url: "/turma/salvar_alunos",
            type: "POST",
            data: {
                id_turma: turma,
                alunos: alunos,
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

            }
        });
    });
});