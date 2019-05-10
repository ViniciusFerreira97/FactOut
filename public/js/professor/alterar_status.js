$(document).ready(function () {

    $('#alterarJf').on('click', function () {
        $.ajax({
            url: "/professor/getJfs",
            type: "GET",
            success: function (result) {
                console.log(result);
                $('#slcJFStatus').empty();
                $('#slcJFStatus').append('<option value="0" disabled> Selecione o JF </option>');
                for (var i = 0; i < result['data'].length; i++) {
                    let option = '<option value="' + result['data'][i]['id_jf'] + '-' + result['data'][i]['status_jf'] + '">' + result['data'][i]['disciplina'] + " - " + result['data'][i]['nome'] + " (" + result['data'][i]['status_jf'] + ')</option>';
                    $('#slcJFStatus').append(option);
                }
                $('#slcJFStatus').change();
            }
        });
    });

    $('#slcJFStatus').on('change', function () {
        let value = $('#slcJFStatus').val();
        let status = value.split('-')[1];
        switch (status) {
            case 'Em preparação':
                $('.statusDiv > div').removeClass('text-success').removeClass('text-primary');
                $('.statusDiv > div:eq(0)').addClass('text-primary');
                break;
            case 'Em execução':
                $('.statusDiv > div').removeClass('text-success').removeClass('text-primary');
                $('.statusDiv > div:eq(0)').addClass('text-success');
                $('.statusDiv > div:eq(1)').addClass('text-success');
                $('.statusDiv > div:eq(2)').addClass('text-primary');
                break;
            default:
                $('.statusDiv > div').removeClass('text-success').removeClass('text-primary');
                $('.statusDiv > div:eq(0)').addClass('text-success');
                $('.statusDiv > div:eq(1)').addClass('text-success');
                $('.statusDiv > div:eq(2)').addClass('text-success');
                $('.statusDiv > div:eq(3)').addClass('text-success');
                $('.statusDiv > div:eq(4)').addClass('text-primary');
                break;
        }
    });

    $('#btnAvançarStatusAlterar').on('mouseenter', function () {
        let value = $('#slcJFStatus').val();
        let status = value.split('-')[1];
        switch (status) {
            case 'Em preparação':
                $('.statusDiv > div:eq(1)').addClass('amber-text');
                $('.statusDiv > div:eq(2)').addClass('amber-text');
                break;
            case 'Em execução':
                $('.statusDiv > div:eq(3)').addClass('amber-text');
                $('.statusDiv > div:eq(4)').addClass('amber-text');
                break;
        }
    }).on('mouseout', function () {
        $('.statusDiv > div').removeClass('amber-text');
    }).on('click', function () {
        let jf = $('#slcJFStatus').val();
        let idjf = jf.split('-')[0];


        $.ajax({
            url: "/professor/setStatusJF",
            type: "POST",
            data: {
                id_jf: idjf,
            },
            success: function (result) {
                if(result['success']){
                    $('#modalSuccess .modal-body').html(result['data'][0]);
                    $('#modalSuccess .modal-title').html('Alteração Status JF.');
                    $('#modalSuccess').modal('show');
                    $('#alterarJf').click();
                }else{
                    $('#modalError .modal-body').html(result['data'][0]);
                    $('#modalError .modal-title').html('Alteração Status JF.');
                    $('#modalError').modal('show');
                }
            }
        });
    })

    function dump(obj) {
        var out = '';
        for (var i in obj) {
            out += i + ": " + obj[i] + "\n";
        }
        var pre = document.createElement('pre');
        pre.innerHTML = "<div style='background-color: white;'> " + out;
        document.body.appendChild(pre)
    }
});