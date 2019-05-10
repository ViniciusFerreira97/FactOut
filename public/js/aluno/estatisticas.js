$(document).ready(function () {

    $('#Estatisticas').on('click', function () {
        $('#estatisticasPosSelecao').hide();
        $.ajax({
            url: "/aluno/jfs_finalizado",
            type: "GET",
            data: {},
            success: function (result) {
                $('#estatisticaSlcJF').empty();
                let aux = "Selecione o JF";
                $('#estatisticaSlcJF').append('<option value="0">' + 'Selecione o JF' + '</option>');
                for (var i = 0; i < result.length; i++) {
                    let option = '<option value="' + result[i]['id_jf'] + '">' + result[i]['id_jf'] + ' - ' + result[i]['nome'] + ' - ' + result[i]['status_jf'] + '</option>';
                    $('#estatisticaSlcJF').append(option);
                }
                $('#estatisticaSlcJF').change();
            }
        });
    });

    $('#estatisticaSlcJF').on('change', function () {
        if ($(this).val() == 0)
            return;
        $('#estatisticasPosSelecao').show('slide');

        var id_jf = $('#estatisticaSlcJF option:selected').attr("value");
        $.ajax({
            url: "/aluno/jfs_corretos_errados",
            type: "POST",
            data: {
                id_jf: id_jf,
            },
            success: function (result) {
                console.log(result);
                $('#fatosCorretosJF').empty();
                $('#fatosCorretosJF').append('<option>' + 'Fatos Corretos' + '</option>');
                for (var i = 0; i < result['certos'].length; i++) {
                    let option = '<option value="' + result['certos'][i] + '">' + result['certos'][i] + '</option>';
                    $('#fatosCorretosJF').append(option);
                }
                $('#fatosCorretosJF').change();

                $('#fatosErradosJF').empty();
                $('#fatosErradosJF').append('<option>' + 'Fatos Errados' + '</option>');
                for (var i = 0; i < result['errados'].length; i++) {
                    let option = '<option value="' + result['errados'][i] + '">' + result['errados'][i] + '</option>';
                    $('#fatosErradosJF').append(option);
                }
                $('#fatosErradosJF').change();

                let certos = result['certos'].length;
                let erros = result['errados'].length;

                var ctxD = document.getElementById("acertos_erros").getContext('2d');
                var myLineChart = new Chart(ctxD, {
                    type: 'doughnut',
                    data: {
                        labels: ["Erros", "Acertos"],
                        datasets: [{
                            data: [erros, certos],
                            backgroundColor: ["#FF6961", "#77DD77"],
                            hoverBackgroundColor: ["#ff4444", "#00C851"]
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });

                let nominal = (certos / (certos + erros));
                let real = nominal / 2;
                $("#acertosTotais").html(" " + certos);
                $("#errosTotais").html(" " + erros);
                $("#acertosNominal").html(" " + (nominal.toFixed(1)) + "%");
                $("#acertosReal").html(" " + (real.toFixed(1)) + "%");
            }
        });
    });


});