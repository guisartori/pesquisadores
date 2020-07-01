var idUsuario = $('#id_user').val();

/* CARREGA INFORMACOES DE NOME E PROFISSAO DO USUARIO */

// var getInfosPerfil = function () {
//     $.ajax({
//        url: '/perfil/getInformacoesPerfil',
//        method: 'POST',
//        data: {idUser: idUsuario},
//        success: function (i) {
//            setTimeout(function () {
//                $('.nomeUser').text(i.titulo);
//                $('#profissaoUser').text(i.profissao);
//                $('#email').val(i.email);
//                $('#dataNasc').val(i.dataNasc);
//                $('#inicio-area').val(i.inicio);
//                $('#cidade').val(i.cidade);
//                $('#estado').val(i.estado);
//                $('#salario').val(i.salario);
//                $('#nivel-instrucao').val(i.instrucao);
//            },100);
//        }
//     });
// }


$(document).ready(function () {
    // getInfosPerfil();

    setTimeout(function () {
        $('li[data-tab="info-dd"]').trigger('click');
    },1500);

    /* MODAL EDITAR NOME E PROFISSAO */
    $('.chama-modal-editar-nome').on('click', function () {
        //informacoes do nome e profissao atuais
        // var nomeAtual = $('#nomeUser').text();
        // var profissaoAtual = $('#profissaoUser').text();

        // //informacoes do nome e profissao que serao atualizados
        // var nomeSobrenome = $('#nome-sobrenome').val(nomeAtual);
        // var profissao = $('#edit-profissao').val(profissaoAtual);

        $('#modal-edit-nome-profissao').modal('show');

        // $('#btn-atualizarInformacoes').on('click', function () {
            // nomeSobrenome = $('#nome-sobrenome').val();
            // profissao = $('#edit-profissao').val();

            // var email = $('#email').val();
            // var dataNasc = $('#dataNasc').val();
            // var inicio = $('#inicio-area').val();
            // var cidade = $('#cidade').val();
            // var estado = $('#estado').val();
            // var instrucao = $('#nivel-instrucao').val();
            // var salario = $('#salario').val();



            // setTimeout(function () {
            //     $.ajax({
            //         url: '/perfil/atualizarInformacoes',
            //         method: 'POST',
            //         data: {idUser: idUsuario, nome: nomeSobrenome, profissao: profissao, email: email, dataNasc: dataNasc, inicio: inicio, cidade: cidade, estado: estado, instrucao: instrucao, salario: salario},
            //         success: function (get) {
            //             getInfosPerfil();
            //             Swal.fire({
            //                 position: 'center',
            //                 type: 'success',
            //                 title: 'Informações atualizadas!',
            //                 showConfirmButton: false,
            //                 timer: 2000
            //             });
            //             $('#modal-edit-nome-profissao').modal('hide');
            //         }
            //     });
            // },300);
        // });
    });

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
                    data: {idUser: idUs, textar: $('#edit-visao-geral').val()},
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

});