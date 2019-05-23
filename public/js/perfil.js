$(document).ready(function () {
   $('#ModalAlterarDados').on('shown.bs.modal',function(){
       $.ajax({
           url: "/usuario/get_user_data",
           type: "get",
           success: function (result) {
               $('#loginAlterarDados').focus();
               $('#loginAlterarDados').val(result['login']);
               $('#nomeAlterarDados').focus();
               $('#nomeAlterarDados').val(result['nome']);
               $('#emailAlterarDados').focus();
               $('#emailAlterarDados').val(result['email']);
               if(result['curso'] !== undefined){
                   $('#areaAluno').show();
                   $('#cursoAlterarDados').focus();
                   $('#cursoAlterarDados').val(result['curso']);
               }
               $('#loginAlterarDados').focus();
           }
       });
   });

   $('#btnSalvarAlteracaoUsuario').on('click',function(){
       if($('#passwordAlterarDados').val() != $('#passwordRepeatAlterarDados').val()){
           $('#modalError .modal-body').html('A senha e repetição não conferem.');
           $('#modalError .modal-title').html('Alterar Dados');
           $('#modalError').modal('show');
           return;
       }
       let senha = '';
       if($('#passwordAlterarDados').val() != "")
            senha = $('#passwordAlterarDados').val();
       $.ajax({
           url: "/usuario/set_user_data",
           type: "post",
           data: {
               nome: $('#nomeAlterarDados').val(),
               email: $('#emailAlterarDados').val(),
               curso: $('#cursoAlterarDados').val(),
               senha: senha,
           },
           success: function (result) {
                $('#modalSuccess .modal-body').html('Dados Alterados com sucesso !');
               $('#modalSuccess .modal-title').html('Alterar Dados');
                $('#modalSuccess').modal('show');
           }
       });
   });

});