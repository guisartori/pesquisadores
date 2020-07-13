$(document).ready(function () {

    var idLogado = $('#id-logado').val();

    $.ajax({
        url: "/principal/getDeveriaConhecer/",
        method: "POST",
        data: {
            idProprio: idLogado
        },
        success: function (v) {
            $('#content-voce-deveria').html(v);
        }
    });

    //obtem a lista de usuarios do bd e exibe em sugestoes
    $.ajax({
        url: "/principal/getSugestoes/",
        method: "POST",
        data: {
            idProprio: idLogado
        },
        success: function (s) {
            $('#content-sugestoes').html(s);
        }
    });

    //ao clicar em add amigo - SUGESTOES

    setTimeout(function () {
        var idSeguidor = $('#id-logado').val();
        $('.add-amigo').on('click', function () {

            var idSeguindo = $(this).attr('data-id-usuario');

            var item = $(this).parent().parent().addClass('animated zoomOut');

            setTimeout(function () {
                $.ajax({
                    url: "/seguidor/mudarSeguir/",
                    method: "POST",
                    data: {
                        id_seguidor: idSeguidor,
                        id_seguindo: idSeguindo
                    },
                    success: function (s) {
                        console.log(s)
                        setTimeout(function () {
                            $(item).remove();
                        }, 300);
                        setTimeout(function () {
                            window.location.reload()
                        }, 1500);
                        Swal.fire({
                            position: 'center',
                            type: 'success',
                            title: 'Agora você segue este usuário!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                });
            }, 100);
        });


    }, 2500);

    $('.add-amigo-perfil').on('click', function () {

        var idSeguidor = $('#id-logado').val();
        var idSeguindo = $(this).attr('data-id-usuario');
        var item = $(this).parent().parent().addClass('animated zoomOut');

        console.log('mudarSeguir')

        $.ajax({
            url: "/seguidor/mudarSeguir/",
            method: "POST",
            data: {
                id_seguidor: idSeguidor,
                id_seguindo: idSeguindo
            },
            success: function (s) {
                setTimeout(function () {
                    $(item).remove();
                }, 300);
                setTimeout(function () {
                    window.location.reload()
                }, 1500);
                Swal.fire({
                    position: 'center',
                    type: 'success',
                    title: 'Feito!',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });
    });
});