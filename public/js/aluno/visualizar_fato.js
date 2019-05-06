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
            type: "POST",
            data: {
                id_jf: jf,
            },
            success: function (data) {
                $('#modalJFExecucao').modal('hide');
                $('#ModalResponderFato').modal("show");
                $('#ModalResponderFato .nomeFato').html('<span value="'+data['id']+'">'+data['texto']+'</span>');
                $('#ModalResponderFato .numFato').html(data['nome']);
                $('#ModalResponderFato .ordemFato').html(data['ordem']);
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
});