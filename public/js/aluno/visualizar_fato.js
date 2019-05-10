$(document).ready(function () {

    $('#btnVisualizarFatoModal').on('click', function () {
        let jf = $('#slcVisualizarFatoModalJFExec').val();
        visualizarFato(jf);
    });

    $('#btnVisualizarFato').on('click', function () {
        let jf = $('#slcJfDisponiveis').val();
        visualizarFato(jf);
    });

    function visualizarFato(jf) {
        $.ajax({
            url: "/JF/get_fato_atual",
            type: "POST",
            data: {
                id_jf: jf,
            },
            success: function (data) {
                $('#modalJFExecucao').modal('hide');
                $('#ModalResponderFato').modal("show");
                $('#ModalResponderFato .nomeFato').html('<span value="' + data['id'] + '">' + data['texto'] + '</span>');
                $('#ModalResponderFato .numFato').html(data['nome']);
                $('#ModalResponderFato .ordemFato').html(data['ordem']);
                let datainicio = data.inicio;
                let datafim = data.fim;
                chronometer(datafim);
                if (data['lider']) {
                    $('#btnVerdadeiro').show('slide');
                    $('#btnFalso').show('slide');
                } else {
                    $('#btnVerdadeiro').hide('slide');
                    $('#btnFalso').hide('slide');
                }
            }
        });
    }

    $('#btnVerdadeiro').on('click', function () {
        responderFato(1);
    });
    $('#btnFalso').on('click', function () {
        responderFato(0);
    });

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

    function responderFato(resposta) {
        let id = $('#ModalResponderFato .nomeFato > span').attr('value');
        $.ajax({
            url: "/aluno/responder_fato",
            type: "POST",
            data: {
                id_fato: id,
                resposta: resposta,
            },
            success: function (data) {
                clearInterval(xTiming);
                $('#modalSuccess .modal-title').html('Salvar Resposta');
                $('#modalSuccess .modal-body').html('Resposta salva com Sucesso !');
                $('#modalSuccess').modal('show');
            }
        });
    }

    var xTiming;

    function chronometer(fim) {
        // Set the date we're counting down to
        //let countDownDate = new Date("Jan 5, 2021 15:49:25").getTime();
        let countDownDate = new Date(fim).getTime();

        // Update the count down every 1 second
        xTiming = setInterval(function () {

            // Get todays date and time
            let now = new Date().getTime();

            // Find the distance between now and the count down date
            let distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);

            if (seconds == 0) {
                $.ajax({
                    url: "/JF/proximo_fato",
                    type: "POST",
                    data: {},
                    success: function (data) {
                    }
                });
            }
            
            // If the count down is finished, write some text
            //alert(distance);
            if (seconds == 0 && minutes == 0) {
                clearInterval(xTiming);
                document.getElementById("tempoFato").innerHTML = "EXPIRED";
            }
            // Display the result in the element with id="demo"
            document.getElementById("tempoFato").innerHTML = minutes + "m " + seconds + "s ";


        }, 1000);
    }
});