$(document).ready(function () {
   $('#ModalAlterarDados').on('shown.bs.modal',function(){
       $.ajax({
           url: "/usuario/get_user_data",
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
   });

});