$(document).ready(function () {
    document.title = 'Home - FactOut';
    $('#pageBody').css('height', '100vh')

    $('.main .subTitle a').on('click', function (e) {
        e.preventDefault();
        $('.main .menuOptions').toggle('slide');
        $('.main .subTitle i').toggleClass('fa-angle-right').toggleClass('fa-angle-down');
    });

    $('#btnSair').on('click', function () {
        $.ajax({
            url: "/usuario/sair",
            type: "GET",
            success: function () {
                location.href = "/";
            }
        });
    })

    $.ajax({
        url: "/usuario/getName",
        type: "GET",
        success: function (result) {
            $('#username').html(result);
        }
    });

    $("a.changeView").on('click', function (e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let traduzido = id.toLowerCase() + 'View';
        $('section.view').not('#' + traduzido).hide('slide');
        $("a.changeView").removeClass('active');
        $(this).addClass('active');
        $('#' + traduzido).show('slide');
    });

    function dump(obj) {
        var out = '';
        for (var i in obj) {
            out += i + ": " + obj[i] + "\n";
        }
        document.body.innerHTML = out;
    }

    $("#modalSuccess").on("show.bs.modal", function () {
        var myModal = $(this);
        clearTimeout(myModal.data("hideInterval"));
        myModal.data("hideInterval", setTimeout(function () {
            myModal.modal("toggle");
        }, 1000));
    });

    //QueryString
    getUrlVars();

    function getUrlVars() {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for (var i = 0; i < hashes.length; i++) {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        $('#' + vars['subpage']).click();
    }


    //Sockets

    var pusher = new Pusher('1b180fb416dacdca1743', {
        cluster: 'us2',
        forceTLS: true
    });
    var executarJF = pusher.subscribe('executarJF');
    executarJF.bind('App\\Events\\ExecutarJF', function (data) {
        $.ajax({
            url: "/turma/usuario_em_turma",
            type: "POST",
            data: {
                id_turma: data['turma'],
            },
            success: function (data) {
                if (data['success']) {
                    $('#btnFixedFatos').show('slide');
                }
            }
        });
    });

    var finalizarJF = pusher.subscribe('finalizarJF');
    finalizarJF.bind('App\\Events\\FinalizarJF', function (data) {
        $.ajax({
            url: "/turma/usuario_em_turma",
            type: "POST",
            data: {
                id_turma: data['turma'],
            },
            success: function (data) {
                if (data['success']) {
                    $('#ModalResponderFato').modal('hide');
                    $('#modalFimJfAluno').modal({
                        backdrop: 'static',
                        keyboard: false
                    });
                    setTimeout(function () {
                        location.reload();
                    }, 3000);
                }
            }
        });
    });

    var proximoFato = pusher.subscribe('proximoFato');
    proximoFato.bind('App\\Events\\ProximoFato', function (data) {
        $.ajax({
            url: "/turma/usuario_em_turma",
            type: "POST",
            data: {
                id_turma: data['turma'],
            },
            success: function (data) {
                $('#ModalResponderFato').modal('hide');
                setTimeout(function () {
                    $('#btnVisualizarFatoModal').click();
                }, 1000);

            }
        });
    });
});