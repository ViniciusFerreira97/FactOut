$(document).ready(function () {
    document.title = 'Login - FactOut';

    $('#btnInscrever').on('click', function () {
        $('#containerLogar').hide();
        $('#containerCadastro').show();
    });

    $('#btnVoltarLogin').on('click', function () {
        $('#containerCadastro').hide();
        $('#containerLogar').show();
    });

    $('#checkProfessor').on('click', function () {
        $('#areaAluno').hide();
    });
    $('#checkAluno').on('click', function () {
        $('#areaAluno').show();
    });

    $('#btnLogar').on('click', function (e) {
        let login = $('#login').val();
        let senha = $('#password').val();
        $.ajax({
            url: "/usuario/login",
            type: "POST",
            data: {
                login: login,
                senha: senha,
            },
            success: function (result) {

                if (!result['success']) {
                    $('#modalError .modal-body').empty();
                    let tohtml = '';

                    for (var i in result['data']) {
                        tohtml += result['data'][i] + '<br>';
                    }

                    $('#modalError .modal-body').html(tohtml);
                    $('#modalError .modal-title').html('Login Incorreto');
                    $('#modalError').modal('show');
                } else {
                    location.href = "/home";
                }
            }
        });
    });

    function dump(obj) {
        var out = '';
        for (var i in obj) {
            out += i + ": " + obj[i] + "\n";
        }
        var pre = document.createElement('pre');
        pre.innerHTML = "<div style='background-color: white;'> " + out;
        document.body.appendChild(pre)
    }

    $("#btnCadastrar").on('click', function (e) {
        e.preventDefault();
        let login = $('#loginCadastro').val();
        let senha = $('#passwordCadastro').val();
        let re_senha = $('#passwordRepeat').val();
        let nome = $('#nomeCadastro').val();
        let email = $('#emailCadsatro').val();
        let curso = '';
        let rSenha = $('#passwordRepeat').val();
        if(senha != rSenha){
            $('#modalError .modal-body').html('Senha e repetição de senha não correspondem.');
            $('#modalError .modal-title').html('Login Incorreto');
            $('#modalError').modal('show');
            return;
        }
        if ($('#checkAluno').prop('checked'))
            curso = $('#cursoCadastro').val();
        let tipoUsuario = $("input[name='checkTipoUsuario']:checked").val();

        $.ajax({
            url: "/usuario/cadastrar",
            type: "POST",
            data: {
                login: login,
                senha: senha,
                re_senha: re_senha,
                nome: nome,
                email: email,
                curso: curso,
                tipo_usuario: tipoUsuario
            },
            success: function (result) {
                if (!result['success']) {
                    $('#modalError .modal-body').empty();
                    let tohtml = '';

                    for (var i in result['data']) {
                        tohtml += result['data'][i] + '<br>';
                    }

                    $('#modalError .modal-body').html(tohtml);
                    $('#modalError .modal-title').html('Impossivel Cadastrar');
                    $('#modalError').modal('show');
                } else {
                    location.href = "/home";
                }
            }
        });
    });

    $('#password').on('keypress',function (e) {
        var keycode = (e.keyCode ? e.keyCode : e.which);
        if(keycode == '13'){
           $('#btnLogar').click();
        }
    });

    $(document).click(function (e) {
        if ($(".modal").is(":visible") && !$(e.target).is('.modal')) {
            $('.modal').modal("hide");
        }
    });

    // Sizing
    var divWidth = $('#LoginBody > .col-7').width();
    var height = $(window).height();
    var width = $(window).width();
    if (width < 840) {
        $('img').attr('src', '/img/logos/fact_out_logo_preto.png');
        $('.loginMenu').removeClass('col-5').addClass('col-10');
        $('.loginItens').removeClass('col-7').addClass('col-10');

    } else {
        $('#imgLoginBody').css('height', height + 'px');
        $('#imgLoginBody').css('width', (divWidth + 100) + 'px');
    }
});