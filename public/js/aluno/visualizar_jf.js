$(document).ready(function () {

    $('#btnVerEquipe').on('click',function () {
        var opcao = $('#slcJfDisponiveis option:selected');
        $('#nomeJF').html(opcao.html());
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

    $('#slcJfDisponiveis').on('click',function(e){

    });
});