$(document).ready(function () {
    var idLogadoFoto = $('#id-logado').val();

    var excluirVaga = function(idVaga, idUsuario) {
        $.ajax({
           url: '/perfil/excluirVaga',
           method: 'POST',
           data: {idVaga: idVaga, idUser: idUsuario},
           success: function (d) {
               Swal.fire({
                   position: 'center',
                   icon: 'success',
                   title: 'Publicação excluída!',
                   showConfirmButton: false,
                   timer: 1500
               });
               setTimeout(function () {
                   window.location.href = "https://app-pesquisadores.herokuapp.com/principal/";
               },1600);
           }
        });
    };

    var editarVaga = function(idVaga, idUsuario, titulo, categoria, habilidade, preco, integral, descricao) {
        $.ajax({
            url: '/perfil/editarVaga',
            method: 'POST',
            data: {idVaga: idVaga, idUser: idUsuario, titulo: titulo, categoria: categoria, habilidade: habilidade, preco: preco, integral: integral, descricao: descricao},
            success: function (d) {
                Swal.fire({
                    icon: 'success',
                    title: 'Publicação Alterada!',
                    text: 'Sua publicação foi alterada com sucesso!',
                    showConfirmButton: false,
                    timer: 1500,
                })
                setTimeout(function () {
                    window.location.href = "https://app-pesquisadores.herokuapp.com/principal/";
                },1600);
            }
        });
    };

    $('.li-editar-vaga').on('click', function () {
       var idVaga = $(this).attr('data-id-vaga');
       var idUsuario = $(this).attr('data-id-usuario-vaga');
       var titulo = $(this).attr('data-titulo-vaga');
       var categoria = $(this).attr('data-categoria-vaga');
       var habilidade = $(this).attr('data-habilidade-vaga');
       var preco = $(this).attr('data-preco-vaga');
       var integral = $(this).attr('data-integral-vaga');
       var descricao = $(this).attr('data-descricao-vaga');

       $('#modal-editar-vaga').on('show.bs.modal', function (event) {
            $('#titulo-publicacao-editar').text(titulo);

            $('.titulo-editar-vaga').val(titulo);
            $('.categoria-editar-vaga').val(categoria);
            $('.habilidade-editar-vaga').val(habilidade);
            $('.preco-editar-vaga').val(preco);
            $('.integral-editar-vaga').val(integral);
            $('.descricao-editar-vaga').val(descricao);

            $('#btn-editar-vaga').on('click', function () {
                var tituloEdit = $('.titulo-editar-vaga').val();
                var categoriaEdit = $('.categoria-editar-vaga').val();
                var habilidadeEdit = $('.habilidade-editar-vaga').val();
                var precoEdit = $('.preco-editar-vaga').val();
                var integralEdit = $('.integral-editar-vaga').val();
                var descricaoEdit = $('.descricao-editar-vaga').val();

                setTimeout(function () {
                    editarVaga(idVaga, idUsuario, tituloEdit, categoriaEdit, habilidadeEdit, precoEdit, integralEdit, descricaoEdit);
                },150);
                $('#modal-editar-vaga').modal('hide');
            });
        });

        $('#modal-editar-vaga').modal('show');

    });

    $('.li-excluir-vaga').on('click', function () {
       var idVaga = $(this).attr('data-id-vaga');
       var idUsuario = $(this).attr('data-id-usuario-vaga');
       var titulo = $(this).attr('data-titulo-vaga');

        $('#modal-confirmacao-exluir-vaga').on('show.bs.modal', function (event) {
            $('#tituloPostagemVaga').text(titulo);

            $('#excluirPostagem').on('click', function () {
                excluirVaga(idVaga, idUsuario);
                $('#modal-confirmacao-exluir-vaga').modal('hide');
            });
        });

        $('#modal-confirmacao-exluir-vaga').modal('show');

    });

    //obtem a lista de usuarios do bd e exibe em sugestoes
    $.ajax({
        url:"/perfil/getFotoPerfil/",
        method:"POST",
        data:{idUser: idLogadoFoto},
        success:function(f){
            var capa =f.src;
            var trimFoto = $.trim(capa);
            $('.usr-pic').html('<img class="foto-perfil-user-logado" src="/public/uploads/fotoPerfil/'+trimFoto+'" alt="Foto do Perfil">');
            $('.user-picy').html('<img class="foto-perfil-user-logado" src="/public/uploads/fotoPerfil/'+trimFoto+'" alt="Foto do Perfil">');
            $('.foto-perfil-navbar').attr('src', '/public/uploads/fotoPerfil/'+trimFoto+'');
            setTimeout(function () {

            }, 1500);
        }
    });

    //Obtem a quantidade de solicitacoes de amizade para o usuario logado
    $.ajax({
        url:"/principal/getSolicitacoesAmizades/",
        method:"POST",
        data:{idUser: idLogadoFoto},
        success:function(n){
            var qtd = n.qtdSolicitacoesAmizade;

            if(qtd == '0') {
                $('.badge-notificacoes').addClass('invisivel');
            } else if(qtd > 0) {
                $('.badge-notificacoes-quantidade').text(qtd);
                $('.badge-notificacoes').removeClass('invisivel').addClass('animated bounceIn');

                setTimeout(function () {
                    $('.badge-notificacoes').removeClass('animated bounceIn').addClass('animated flash');
                },1000);
            }
        }
    });


    //contagem de seguidores na tabela amizade
    $.ajax({
        url:"/principal/getTotalSeguidoresUsuarioLogado/",
        method:"POST",
        data:{perfil: idLogadoFoto},
        success:function(n){
            var qtdSeguidores = n.seguidores;

            if(qtdSeguidores > 0) {
                $('.qtdSeguidoresUser').text(qtdSeguidores);
            }
        }
    });

    $.ajax({
        url:"/principal/getTotalSeguidoresVoltaUsuarioLogado/",
        method:"POST",
        data:{perfil: idLogadoFoto},
        success:function(n){
            var qtdSeguidoresVolta = n.seguidoresVolta;

            if(qtdSeguidoresVolta > 0) {
                $('.seguindoVolta').text(qtdSeguidoresVolta);
            }
        }
    });

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
});