$(document).ready(function () {

    $('#btnVisualizarFatoModal').on('click',function(){
        let jf = $('#slcVisualizarFatoModalJFExec').val();
        visualizarFato(jf);
    });

    $('#btnVisualizarFato').on('click',function(){
        let jf = $('#slcJfDisponiveis').val();
        visualizarFato(jf);
    });

    function visualizarFato(jf){
        $.ajax({
            url: "/JF/get_fato_atual",
            //url: "/JF/proximo_fato",
            type: "POST",
            data: {
                id_jf: jf,
            },
            success: function (data) {
                //console.log(data);return;
                $('#modalJFExecucao').modal('hide');
                $('#ModalResponderFato').modal("show");
                $('#ModalResponderFato .nomeFato').html('<span value="'+data['id']+'">'+data['texto']+'</span>');
                $('#ModalResponderFato .numFato').html(data['nome']);
                $('#ModalResponderFato .ordemFato').html(data['ordem']);
                chronometer();
                if(data['lider']){
                    $('#btnVerdadeiro').show('slide');
                    $('#btnFalso').show('slide');
                }else{
                    $('#btnVerdadeiro').hide('slide');
                    $('#btnFalso').hide('slide');
                }
            }
        });
    }

    $('#btnVerdadeiro').on('click',function(){
        responderFato(1);
    });
    $('#btnFalso').on('click',function(){
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
                $('#modalSuccess .modal-title').html('Salvar Resposta');
                $('#modalSuccess .modal-body').html('Resposta salva com Sucesso !');
                $('#modalSuccess').modal('show');
            }
        });
    }

    function chronometer(){
        // Set the date we're counting down to
        let countDownDate = new Date("Jan 5, 2021 15:49:25").getTime();

        // Update the count down every 1 second
        let x = setInterval(function() {

            // Get todays date and time
            let now = new Date().getTime();

            // Find the distance between now and the count down date
            let distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);

            if(seconds == 0){
                $.ajax({
                    url: "/JF/proximo_fato",
                    type: "POST",
                    data: {
                    },
                    success: function (data) {
                        console.log(data);
                    }
                });
            }

            // Display the result in the element with id="demo"
            document.getElementById("tempoFato").innerHTML = minutes + "m " + seconds + "s ";

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("tempoFato").innerHTML = "EXPIRED";
            }
        }, 1000);
    }
});