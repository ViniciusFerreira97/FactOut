$(document).ready(function () {

    $('#btnVisualizarFatoModal').on('click',function(){
        let jf = $('#slcVisualizarFatoModalJFExec').val();
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
                $('#ModalResponderFato .nomeFato').html(data['texto']);
                $('#ModalResponderFato .numFato').html(data['nome']);
                $('#ModalResponderFato .ordemFato').html(data['ordem'] + 1);
            }
        });
    }
});