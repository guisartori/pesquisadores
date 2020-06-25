var idUsuario = $('#id_user').val();

/* CARREGA INFORMACOES DE NOME E PROFISSAO DO USUARIO */

var getInfosPerfil = function () {
    $.ajax({
       url: '/perfil/getInformacoesPerfil',
       method: 'POST',
       data: {idUser: idUsuario},
       success: function (i) {
           setTimeout(function () {
               $('.nomeUser').text(i.titulo);
               $('#profissaoUser').text(i.profissao);
               $('#email').val(i.email);
               $('#dataNasc').val(i.dataNasc);
               $('#inicio-area').val(i.inicio);
               $('#cidade').val(i.cidade);
               $('#estado').val(i.estado);
               $('#salario').val(i.salario);
               $('#nivel-instrucao').val(i.instrucao);
           },100);
       }
    });
}

var getVisaoGeral = function() {
    $.ajax({
        url: '/perfil/getVisao',
        method: 'POST',
        data: {idUser: idUsuario},
        success: function (v) {
            $('#content-visao-geral').text(v.visao);
        }
    });
}

$(document).ready(function () {
    getInfosPerfil();
    getVisaoGeral();

    setTimeout(function () {
        $('li[data-tab="info-dd"]').trigger('click');
    },1500);

    setTimeout(function () {
        $('#upload-capa').on('change', function () {
            $('.btn-upload').removeClass('d-none');
            setTimeout(function () {
                Swal.fire({
                    title: 'Foto selecionada. Vamos ao próximo passo....',
                    animation: false,
                    customClass: {
                        popup: 'animated tada'
                    }
                });
            }, 1000);
        });


        setTimeout(function () {
            //obtem a lista de usuarios do bd e exibe em sugestoes
            $.ajax({
                url:"/perfil/getCapaPerfil/",
                method:"POST",
                data:{idUser: idUsuario},
                success:function(c){
                    var capa =c.src;
                    var trimCapa = $.trim(capa);
                    $('#img-capa').attr("src", "/public/uploads/capa/"+trimCapa+"");
                    setTimeout(function () {
                        $('.loader-capa').addClass('d-none');
                    }, 1500);
                }
            });
        },200);

        setTimeout(function () {
            //obtem a lista de usuarios do bd e exibe em sugestoes
            $.ajax({
                url:"/perfil/getFotoPerfil/",
                method:"POST",
                data:{idUser: idUsuario},
                success:function(f){
                    var capa =f.src;
                    var trimCapa = $.trim(capa);
                    $('#img-usuario-foto-perfil').attr("src", "/public/uploads/fotoPerfil/"+trimCapa+"");
                    $('.foto-perfil-navbar').attr('src', '/public/uploads/fotoPerfil/'+trimCapa+'');
                    setTimeout(function () {

                    }, 1500);
                }
            });
        },200);

        /* MODAL EDITAR NOME E PROFISSAO */
        $('.chama-modal-editar-nome').on('click', function () {
            //informacoes do nome e profissao atuais
            var nomeAtual = $('#nomeUser').text();
            var profissaoAtual = $('#profissaoUser').text();

            //informacoes do nome e profissao que serao atualizados
            var nomeSobrenome = $('#nome-sobrenome').val(nomeAtual);
            var profissao = $('#edit-profissao').val(profissaoAtual);

            $('#modal-edit-nome-profissao').modal('show');

            $('#btn-atualizarInformacoes').on('click', function () {
                nomeSobrenome = $('#nome-sobrenome').val();
                profissao = $('#edit-profissao').val();

                var email = $('#email').val();
                var dataNasc = $('#dataNasc').val();
                var inicio = $('#inicio-area').val();
                var cidade = $('#cidade').val();
                var estado = $('#estado').val();
                var instrucao = $('#nivel-instrucao').val();
                var salario = $('#salario').val();



                setTimeout(function () {
                    $.ajax({
                        url: '/perfil/atualizarInformacoes',
                        method: 'POST',
                        data: {idUser: idUsuario, nome: nomeSobrenome, profissao: profissao, email: email, dataNasc: dataNasc, inicio: inicio, cidade: cidade, estado: estado, instrucao: instrucao, salario: salario},
                        success: function (get) {
                            getInfosPerfil();
                            Swal.fire({
                                position: 'center',
                                type: 'success',
                                title: 'Informações atualizadas!',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            $('#modal-edit-nome-profissao').modal('hide');
                        }
                    });
                },300);
            });
        });
    },1000);

    /* EDITAR VISAO GERAL */
    $('.link-visao-geral').on('click', function () {
        var get = $('#content-visao-geral').text();
        var insertCampo = $('#edit-visao-geral').text($('#content-visao-geral').text());
        var idUs = $('#id_user').val();

        $('#btn-salvar-visao-geral').on('click', function () {
            var textAreaVisao = $('#edit-visao-geral').val();
            textAreaVisao = $('#edit-visao-geral').text(textAreaVisao);
            setTimeout(function () {
                $.ajax({
                    url: '/perfil/inserirVisaoGeral',
                    method: 'POST',
                    data: {idUser: idUsuario, textar: $('#edit-visao-geral').val()},
                    success: function (e) {
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: 'Informações atualizadas!',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        getVisaoGeral();
                        $('.close-box').trigger('click');
                    }
                });
            },100);
        });
    });

    //contagem de seguidores na tabela amizade
    $.ajax({
        url:"/principal/getTotalSeguidoresUsuarioLogado/",
        method:"POST",
        data:{perfil: 1},
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
        data:{perfil: 1},
        success:function(n){
            var qtdSeguidoresVolta = n.seguidoresVolta;

            if(qtdSeguidoresVolta > 0) {
                $('.seguindoVolta').text(qtdSeguidoresVolta);
            }
        }
    });
});